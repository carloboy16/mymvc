<?php 
namespace Library;
/**
* By Carlo
*/
class Json 
{
	
	function __construct()
	{
		
	}
	function jprint($d){
		header('Content-Type: application/json');
		return json_encode($d);
	}
	function create(){
		return new self();
	}
}
 ?>