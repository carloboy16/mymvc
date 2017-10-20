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
	
}
 ?>