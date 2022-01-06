<?php

    class DbCRUD {

        private $conn;

        function __construct(){

            require_once dirname(__FILE__).'/DbConnection.php';

            $db = new DbConnection();

            $this->conn = $db->connect();
        }
        
        public function createUser($username , $email, $passwordx){
            $password = md5($passwordx);
            $statement = $this->conn->prepare("INSERT INTO users (id , username , email , password ) 
                VALUES (NULL ,? ,? ,?);");
                $statement->bind_param("sss",$username,$email,$password);
                
            if($statement->execute()){
                return true;   
            }else {
                return false;
            }
        }

        public function loginUser($email , $password){
            $password = md5($password);
            $statement = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND password = ? ;");
            $statement->bind_param("ss",$email , $password);
            $statement->execute();

            $statement->store_result();

            if($statement->num_rows() > 0 ){
                return true;
            }else return false ;

        }

        public function getUserDetails($email){
            $statement = $this->conn->prepare("SELECT * FROM users WHERE email = ? ;");
            $statement->bind_param("s",$email);
            $statement->execute();
            $sql_result = $statement->get_result();
            return $sql_result->fetch_assoc();        
        }







        function isUserExists($username , $email){
            $statement = $this->conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? ;");
            $statement->bind_param("ss",$username , $email);
            $statement->execute();
            $statement->store_result(); 
            if($statement->num_rows() == 0 ) return false;
                else return true;
        }

        

    }
    /*$db = new DbCRUD();
    $db->createUser('oth derrar','oth@gmail.com', '123465' );*/

?>