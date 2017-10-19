<?php 
namespace controller;
use Library\Main as Main;
class indexController extends Main
{
	function index(){
		$this->render('Welcome');
	}
	function create(){
		return new self();
	}
}

 ?>