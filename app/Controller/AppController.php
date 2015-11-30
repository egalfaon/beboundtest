<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
define("Webroot",     "https://localhost/bebound/");
define("comp_id",     "1204");
define("comp_name",     "Premier League");
define("comp_region",     "England");
define("footbalApiKey",     "");
define("timeDiff",     "-3 hours"); // used to determin if bets are closed. Here we have a server in Romania +2h time zone. so one houre before game is a -3 houre difference
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $pageTitle;
	public $user;

	public function updateMatches($startDay,$endDay){
		// Get the settings for this app
		$this->loadModel('Setting');
		$settings=$this->Setting->findById(1);
		// Load the Match model so we can use it
		$this->loadModel('Match');
		//Count the number of matches for that week
		$countMatches=$this->Match->find('count',array('conditions' => array('match_formatted_date >=' => date('Y-m-d',$startDay),'match_formatted_date <=' => date('Y-m-d',$endDay))));
		if(($countMatches==0)||(date("Y-m-d H:i:s")>$settings['Setting']['next_update'])){
			$this->getWeekMatches($startDay,$endDay);
			$this->Setting->id=1;
			$tmpSettings["last_update"]=date("Y-m-d H:i:s", time());
			$tmpSettings["next_update"]=date("Y-m-d H:i:s", time() + $settings['Setting']['time_interval']);
			$this->Setting->save($tmpSettings);
		}
	}

	function getWeekMatches($startDay,$endDay){ //get the mathces in the week. 0=this week, 1=next week so on
		
		//Here we get the Matches for the slected week.
		$undecodedThisWeekMatches = file_get_contents('http://football-api.com/api/?Action=fixtures&APIKey='.footbalApiKey.'&comp_id='.comp_id.'&from_date='.date("d.m.Y",$startDay).'&to_date='.date("d.m.Y",$endDay));
		
		//decode the string into an array
		$thisWeekMatches =  json_decode($undecodedThisWeekMatches);
		
		// Load the database model
		$this->loadModel('Matchevent');
		$this->loadModel('Bet');
		
		if (isset($thisWeekMatches->matches))
		foreach($thisWeekMatches->matches as $match){
			$tmpMatch['match_date'] = $match->match_date;
			$tmpMatch['match_formatted_date'] = date('Y-m-d',strtotime($match->match_formatted_date));
			$tmpMatch['match_bet_close_time'] = date('Y-m-d h:i:s',strtotime($match->match_formatted_date." ".$match->match_time." ".timeDiff));
			$tmpMatch['match_time'] = $match->match_time;
			$tmpMatch['match_status'] = $match->match_status;
			$tmpMatch['match_localteam_name'] = $match->match_localteam_name;
			$tmpMatch['match_visitorteam_name'] = $match->match_visitorteam_name;
			$tmpMatch['match_localteam_score'] = $match->match_localteam_score;
			$tmpMatch['match_visitorteam_score'] = $match->match_visitorteam_score;
			
			//test if match is already in our database
			$found=$this->Match->findByMatchId($match->match_id);
			if (isset($found['Match']['id'])){
				// Match already in our database... updating info
				$this->Match->id = $found['Match']['id'];
				$this->Match->save($tmpMatch);
				
				// updating events for this Match
				if (isset($match->match_events))
					foreach ($match->match_events as $matchEvent){
						$tmpMatchevent['event_type'] = $matchEvent->event_type;
						$tmpMatchevent['event_minute'] = $matchEvent->event_minute;
						$tmpMatchevent['event_team'] = $matchEvent->event_team;
						$tmpMatchevent['event_player'] = $matchEvent->event_player;
						$tmpMatchevent['event_result'] = $matchEvent->event_result;
						// test if event is already in database
						$foundEvent=$this->Matchevent->findByEventId($matchEvent->event_id);
						if (isset($foundEvent['Matchevent']['id'])){
							// Event already in our database... updating just in case
							$this->Matchevent->id = $foundEvent['Matchevent']['id'];
							$this->Matchevent->save($tmpMatchevent);
						}
						else{
							// New event... Must be added
							$this->Matchevent->id =-1;
							$tmpMatchevent['event_id'] = $matchEvent->event_id;
							$tmpMatchevent['match_id'] = $this->Match->id;
							$this->Matchevent->save($tmpMatchevent);
						}
					} // End foreach match events
			}
			else{
				// Match was not found in database... must be added
				$this->Match->id = -1;
				$tmpMatch['match_id'] = $match->match_id;
				$this->Match->save($tmpMatch);
				
				// insert events for this Match
				if (isset($match->match_events))
					foreach ($match->match_events as $matchEvent){
						$tmpMatchevent['event_type'] = $matchEvent->event_type;
						$tmpMatchevent['event_minute'] = $matchEvent->event_minute;
						$tmpMatchevent['event_team'] = $matchEvent->event_team;
						$tmpMatchevent['event_player'] = $matchEvent->event_player;
						$tmpMatchevent['event_result'] = $matchEvent->event_result;
						$tmpMatchevent['event_id'] = $matchEvent->event_id;
						$tmpMatchevent['match_id'] = $this->Match->id;
						
						$this->Matchevent->id =-1;
						$this->Matchevent->save($tmpMatchevent);
					} // End foreach match events				
			}
			// Update bets for this match if there are any;
			if ($match->match_status=="FT"){ // The match is over
				$bets=$this->Bet->find('all',array('conditions' => array('Bet.match_id' => $this->Match->id)));
				foreach($bets as $bet){
					// determin the bet result
					$winningTeamm=0; // set it to localteam
					if ($match->match_localteam_score < $match->match_visitorteam_score)
						$winningTeamm=2; // set it to visitorteam
					if ($match->match_localteam_score == $match->match_visitorteam_score)
						$winningTeamm=1; // set it to equal score;
						
					// determin bet result
					$betWinningTeam=0;
					if ($bet['Bet']['localteam_score'] < $bet['Bet']['visitorteam_score'])
						$betWinningTeam=2;
					if ($bet['Bet']['localteam_score'] == $bet['Bet']['visitorteam_score'])
						$betWinningTeam=1;
					
					$betResult=0;
					if ($winningTeamm==$betWinningTeam)
						$betResult=1;
					
					if (($match->match_localteam_score==$bet['Bet']['localteam_score'])&&($match->match_visitorteam_score==$bet['Bet']['visitorteam_score']))
						$betResult=3;
					
					$tmpBet['result']=$betResult;
					$this->Bet->id=$bet['Bet']['id'];
					$this->Bet->save($tmpBet);
				}
			}
		}
	}  // END of getThisWeekMatches

	public function checkLogin(){
		$this->user=$this->Session->read('user');
		if (!isset($this->user))
			$this->redirect('/cont/login');	
	}
	
	public function beforeFilter() {
		$this->user=$this->Session->read('user');
		if (isset($this->user))
			$this->set('user',$this->user);
	}
	
	public function beforeRender(){
		$this->set('title_for_layout', $this->pageTitle);
	}
}
