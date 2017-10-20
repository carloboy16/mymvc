<?php 
namespace controller;
use Library\Main as Main;
use model\user as  user;
class indexController extends Main
{
	function index(){
		$userdb = user::create();
		$userdb->delete()->where('username = ?','lucky')->run();

		$a['user'] = $userdb->fetchQuery($userdb->select('email'));

		$a['test'] = $this->fetchQuery($this->select('user')->where('user_id = ?','1'));
		// var_dump($a);
		$this->render('tpl/header');
		$this->render('Welcome',$a);
		$this->render('tpl/footer');
	}
	public function s($id = null,$ew = null){
		var_dump($id);
		var_dump($ew);
	}
	public function create(){
		return new self();
	}

}

 ?>