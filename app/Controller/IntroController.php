<?php
App::uses('AppController', 'Controller');

class IntroController extends AppController {
	public $uses = array('Match','Matchevent');
	public function index($week=0) { //here $week is the week we want to display: 0 for curent week, 1 for next week, -1 for previous week and so on
		$this->pageTitle='Anusca Bogdan for Be Bound';		
		// constrains for week.
			$week=(int)$week;
			if ($week<-100) $week=0;
			if ($week>100) $week=0;
			$week=round($week); //now we are sure that $week is in integer betwin -100 and 100
		//compute the start day and end day for the desired week
			$dOffsets = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
			$prevMonday = mktime(0,0,0, date("m"), date("d")-array_search(date("l"),$dOffsets), date("Y"));
			$oneWeek = 3600*24*7;$toSunday = 3600*24*6;
			$startDay=$prevMonday+ $oneWeek*$week;
			$endDay=$prevMonday + $oneWeek*$week + $toSunday;
			$textForWeeks="This Week matches";
			if ($week!=0)
				$textForWeeks=date("d M",$startDay)." - ".date('d M',$endDay)." matches";
		$this->set('textForWeeks',$textForWeeks);
		$this->set('week',$week);
		//update the matches in that week
		$this->updateMatches($startDay,$endDay);
		// display the matches in that week
		$this->set('matches',$this->Match->find('all',array('conditions' => array('match_formatted_date >=' => date('Y-m-d',$startDay),'match_formatted_date <=' => date('Y-m-d',$endDay)))));
		// see all mysql log for moder Match
		//print "<br><br><br>";debug( $this->Match->getDataSource()->getLog(false, false));
		$this->set('events',$this->Matchevent->find('all',array('order' => array('Matchevent.id' => 'desc') ,'limit' => 10)));
	}
}