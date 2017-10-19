<?php 
namespace controller;
use Library\Main as Main;
use model\user as  user;
class indexController extends Main
{
	function index(){
		$userdb = user::create();
		$a['user'] = $userdb->fetchQuery($userdb->select('email'));

		$a['test'] = $this->fetchQuery($this->select('user')->where('user_id = ?','1'));
		// var_dump($a);
		$this->render('tpl/header');
		$this->render('Welcome',$a);
		$this->render('tpl/footer');
	}

	function create(){
		return new self();
	}
}

 ?>