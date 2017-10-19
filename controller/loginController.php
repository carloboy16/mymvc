<?php 	
namespace controller;
use Library\Main as Main;
class loginController extends Main
{

	protected $db;
	function index()
	{
	
	$a = $this->fetchQuery($this->select('user'));
	$a = array('user_data'=>$a);
	$this->render('tpl/header',$a);
	$this->render('test',$a);
	}
	function create(){

		return new self();
	}
	function test(){
			$a = $this->fetchQuery($this->select('user'));
			echo $this->Json->jprint($a);

	}
	function boo($r = null){
			echo $this->Json->jprint($r);
		echo "boo";
	}
}



 ?>