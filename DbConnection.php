<?php
class DbConnection{
    private $connection;

    function __construct(){     
        //$this->conncet();
    }
  
    function connect(){
        
        include_once dirname(__FILE__).'/dbConfig.php';
        $this->connection =new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if(mysqli_connect_errno()){
            echo'Failed to connect to database '.mysqli_connect_error();
        }
        //echo'connected to database -   ';
        return $this->connection;
    }

}
//echo'hello';
$a = new DbConnection ();
$a->connect();

?>