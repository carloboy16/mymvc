<?php 
namespace controller;
use Library\Main as Main;
use Library\DB as db;
use model\user as  user;
class indexController extends Main
{
	function index(){
		$this->render('tpl/header');
		$this->render('Welcome');
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