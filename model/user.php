<?php 
namespace model;
use Library\Model as Model;
class user extends Model
{
	protected $dbused = 'user';
	function __construct()
	{
		parent::__construct();
	}
	function create(){
		return new self();
	}
	function getalluser(){
		return $this->fetchQuery($this->select());
	}
	function addUser($user = null){
		$a = $this->insert($user);
	}
	function resetUser(){
		$this->truncate()->run();
	}
}
 ?>