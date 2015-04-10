<?php


   class mysql{


     private $host;
     private $name;
     private $pass;
     //private $table;
     private $db;
     //private $ut;



     function __construct($host,$name,$pass,$db){
     	$this->host=$host;
     	$this->name=$name;
     	$this->pass=$pass;
     	$this->db=$db;
     	//$this->ut=$ut;
     	$this->connect();

     }


     function connect(){
      $link=mysql_connect($this->host,$this->name,$this->pass) or die ($this->error());
      mysql_select_db($this->db,$link) or die("�޸����ݿ⣺".$this->table);
      mysql_query("set character set 'utf8'");//读库 
      mysql_query("set names utf8");//写库
     }

	function query($sql, $type = '') {
		$query=mysql_query($sql);
	    //if(!($query = mysql_query($sql))) $this->show('Say:', $sql);
	    return $query;
	}

    function show($message = '', $sql = '') {
		if(!$sql) echo $message;
		else echo $message.'<br>'.$sql;
	}

    function affected_rows() {
		return mysql_affected_rows();
	}

	function result($query, $row) {
		return mysql_result($query, $row);
	}

	function num_rows($query) {
		return @mysql_num_rows($query);
	}

	function num_fields($query) {
		return mysql_num_fields($query);
	}

	function free_result($query) {
		return mysql_free_result($query);
	}

	function insert_id() {
		return mysql_insert_id();
	}

	function fetch_row($query) {
		return mysql_fetch_row($query);
	}

	function version() {
		return mysql_get_server_info();
	}

	function close() {
		return mysql_close();
	}


   //==============

    function fn_insert($table,$name,$value){

    	$this->query("insert into $table ($name) value ($value)");

    }


   }


  //$db =  new mysql.class('localhost','root','','php100job_db',"GBK");

  //$db->fn_insert('test','id,title,dates',"'','�Ҳ������Ϣ',now()");



?>
