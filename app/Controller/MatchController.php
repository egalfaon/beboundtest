<?php
App::uses('AppController', 'Controller');

class MatchController extends AppController {
	public $uses = array('Match','Bet');
	
	public function index($matchId) {
		$this->pageTitle='Anusca Bogdan for Be Bound';
		$match=$this->Match->findByMatchId($matchId);
		if(isset($match['Match']['id'])){
			$this->set('match',$match);
			// find if there is a bet for the curent user and match
			if (isset($this->user)){
				$findBet=$this->Bet->find('first',array('conditions' => array('Bet.match_id'=>$match['Match']['id'],'user_id'=>$this->user['id'])));
				$this->set('bet',$findBet);
			}
			// place or update bet if form submit
			if (isset($_POST['placeBet']))
			  if (date("Y-m-d h:i:s")<$match['Match']['match_bet_close_time']){
				$tmpBet['user_id']=$this->user['id'];
				$tmpBet['match_id']=$match['Match']['id'];
				$tmpBet['localteam_score']=(int)$_POST['localteam_score'];
				$tmpBet['visitorteam_score']=(int)$_POST['visitorteam_score'];
				if (isset($findBet['Bet']['id']))
					$this->Bet->id=$findBet['Bet']['id'];
				else
					$this->Bet->id=-1;
				$this->Bet->save($tmpBet);
				$this->set('bet',$this->Bet->findById($this->Bet->id));
			}	
		}
	}	
}