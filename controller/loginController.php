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
	$this->render('header',$a);
	$this->render('test',$a);
	}
	function create(){

		return new self();
	}
	function test(){
		var_dump($this);
		echo "yahoo!";

	}
}



 ?>