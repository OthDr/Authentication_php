<?php 
    
require_once dirname(__FILE__).'/DbCRUD.php';
//requested user
    $req_password;
    $req_email;
    $req_usrname;

    $response = array();

    if($_SERVER['REQUEST_METHOD']=='POST')
    {    
        if(isset($_POST['username']) and
            isset($_POST['email'])   and
             isset($_POST['password'])      )  
        {
            $req_usrname = $_POST['username'];
            $req_email = $_POST['email'];
            $req_password = $_POST['password'];

            $db = new DbCRUD();
            
            if($db->isUserExists($req_usrname , $req_email , $req_password)){
                $response['error'] = true;
                $response['message'] = "This user already exists";
            }else{
                if($db->createUser($req_usrname , $req_email , $req_password)){
                    $response['error'] = false;
                    $response['message'] = "User successfully registred";
        
                }else{
                    $response['error'] = true;
                    $response['message'] = "Database Error!";
                }
            }
        }else{
            $response['error'] = true;
            $response['message'] = "Oops! Make sure you entered all the informations";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "Invalid request";
    }

    echo json_encode($response);//print the response as a JSON Object
    
    
        



?>