<?php 
/*
Created By: John Carlo Salazar
*/
namespace Library;
class DB 
{
	protected $_connection;
	protected $_query = '';
	protected $_param = array();
	function __construct()
	{	
		global $DB_C;
		$this->_connection =new \mysqli($DB_C['HOST'],$DB_C['USER'],$DB_C['PASSWORD'],$DB_C['DB']);
		
	}
	public function truncate($table){
		$this->_query.="TRUNCATE TABLE {$table}";
		return $this;
	}
	public function run(){

		
		$q =  $this->_query;
		$s = $this->_connection->prepare($q);
	   if(count($this->_param)!=0){
		foreach ($this->_param as $val) {
			$type[] = $this->GetType($val);
		}
		
		$input = array();
		$input[] = &implode($type);
		for($i=0;$i<count($this->_param);$i++){
			$input[]= &$this->_param[$i];
		}
		call_user_func_array(array($s,'bind_param'), $input);
		}
		else{
			// $s->bind_param('s','');
		}
		
		if($s->execute()){
			$this->clear();
			return $s->affected_rows == 1 ? !0: !1;
		}else{
			return 'failed to query';
		}



	}
	public function update($table){
		$this->_query = "UPDATE {$table}";
		return $this;
	}
	function set($option,$param){
		if( !is_array($param)){
			 array_push($this->_param,$param);
		}
		 if(strpos($this->_query,'SET')){
		 	$this->_query.= ", {$option} ";
		 }else{
		 	 $this->_query.= " SET {$option}";
		 }
		
		 return $this;
	}
	public function delete($table){
		$this->_query = "DELETE  FROM {$table}";
		return $this;
	}

	
	public function fetchQuery($q){
			$q = $q->_query	;

			$type=array();
			$wherebind = "";
			$st = $this->_connection->prepare($q);
			
			if($this->_param != null || count($this->_param) != 0){
			foreach ($this->_param as $par) {
			 $type[]=$this->GetType($par);
			}
			$input = array();
			$input[] = &implode($type);
			
			for($i=0;$i<count($this->_param);$i++) {
			$input[]= &$this->_param[$i] ;
			}
			
			call_user_func_array(array($st,'bind_param'),$input);
			}
			
			$st->execute();
			$res = $st->get_result();
			$d = array();
			while($i = $res->fetch_assoc()){
				$d[] = (object) $i;
			}
			$this->clear();
			
			return (object) ($d);

	}
	protected function clear(){
		$this->_query = '';
		$this->_param = array();
	}
	public function insert($table,$data){
		if($data === null || $data===""){
			return false;
		}
		$col = array();
		$val = array();
		$input = array();
		foreach ($data as $c => $v) {
			array_push($col, $c);
			array_push($val, $v);
		}
		$col = &implode($col,",");
		$data_type = array();
		foreach ($val as $d) {
			$data_type[] = $this->GetType($d); 
		}
		$value = implode($data_type);
		$question_mark = array();
		foreach ($data_type as $dt) {
			$question_mark[] = '?';
		}
		$question_mark = implode($question_mark,',');

		$q="INSERT INTO {$table}({$col}) VALUES({$question_mark})";
		
		$st = $this->_connection->prepare($q);

		$input[]=&$value;

		for($i = 0;$i<count($val);$i++){
			$input[]= &$val[$i];
		}
		
		
		call_user_func_array(array($st,'bind_param'),$input);

		if($st->execute()){

		}
		return $st->insert_id;
	}
	public function select($table,$option = ""){
		$option = $option== null ||$option=="" ? "*":$option;
		if($table==null){
			return false;
		}
		 $this->_query = "SELECT {$option} FROM {$table}";
		 return $this;
	}
	function where($option,$param){
		if( !is_array($param)){
			 array_push($this->_param,$param);
		}
		 if(strpos($this->_query,'WHERE')){
		 	$this->_query.= " AND {$option} ";
		 }else{
		 	 $this->_query.= " WHERE {$option} ";
		 }
		
		 return $this;
	}
	function whereOR($option,$param){
		if( !is_array($param)){
			 array_push($this->_param,$param);
		}
		 if(strpos($this->_query,'WHERE')){
		 	$this->_query.= " OR {$option} ";
		 }
		
		 return $this;
	}
	public function order($option){
		 $this->_query.= " Order by {$option} ";
		return $this;
	}
	public function leftJoin($table,$option){
		$this->_query.=" LEFT JOIN {$table} ON {$option}";
		
		return $this;
	}
	public function innerJoin($table,$option){
		$this->_query.=" INNER JOIN {$table} ON {$option}";
		
		return $this;
	}
	public function rightJoin($table,$option){
		$this->_query.=" RIGHT JOIN {$table} ON {$option}";
		
		return $this;
	}
	public function having($option,$param){
		if( !is_array($param)){
			 array_push($this->_param,$param);
		}
	   if(strpos($this->_query,'HAVING')){
		 	$this->_query.= " AND {$option} ";
		 }else{
		 	 $this->_query.= " HAVING {$option} ";
		 }
		 return $this;

		 
	}
	public function query($q){
		$st = $this->_connection->prepare($q);
		$st->execute();
		$res = $st->get_result();
		$ress= array();
		while ($a = $res->fetch_assoc()) {
			$ress[] = $a;
		}
		return (object) ($ress);
	}
	
	Private function GetType($Item)
	{
    switch (gettype($Item)) {
        case 'NULL':
        case 'string':
            return 's';
            break;

        case 'integer':
            return 'i';
            break;

        case 'blob':
            return 'b';
            break;

        case 'double':
            return 'd';
            break;
    }
    return '';
	}
	public function create(){
		return new self();
	}

}
 ?>