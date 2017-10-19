<?php 
namespace Library;
class Request extends DB
{
	protected $Request;
	function __construct()
	{
	 $this->Request = $_REQUEST;
	}
	public function create(){
		return new self();
	}
	
}
 ?>