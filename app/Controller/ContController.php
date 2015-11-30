<?php
App::uses('AppController', 'Controller');

class ContController extends AppController {
	public $uses = array('User','Bet');
	
	public function index() {
		$this->checkLogin();
		$this->Bet->recursive=1; // set low recursive so it will bring me only the match not the match events and so on
		$this->set('bets',$this->Bet->find('all',array('conditions' => array('Bet.user_id' => $this->user['id']))));	
	}	
	
	public function login(){
		$this->pageTitle='Be Bound test page Login';
		if(isset($this->user))
			$this->redirect('/cont');
		if(isset($_POST['login'])){
			$user=$this->User->findByEmail($_POST['email']);
			if(isset($user['User']['pass']))
				if(md5($_POST['pass'])==$user['User']['pass']){
					$this->Session->write('user',$user['User']);
					$this->redirect('/cont');
				}else
					$this->set('msg','E-mail/Pass Error!');
			else
				$this->set('msg','E-mail/Pass Error!');
		}
		$this->redirect('/intro');
	}
	
	public function logout(){
		$this->Session->destroy();
		$this->redirect(Webroot);
	}
}