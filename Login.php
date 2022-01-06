<?php
    require_once dirname(__FILE__).'/DbCRUD.php';

    $response = array();
    $email =null ;
    $password =null;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['email'])
            and isset($_POST['password'])  )
        {
            $email = $_POST['email'] ;
            $password = $_POST['password'];

            $db = new DbCRUD();

            if($db->loginUser($email,$password)){
                $user = $db->getUserDetails($email);

                $response['error'] = false ;
                $response['message'] =  'User successfully registred';

                $response['id'] = $user['id'];
                $response['email'] = $user['email'];
                $response['username'] = $user['username'];

            }else{
                $response['error'] = true ;
                $response['message'] =  'Invalid informations';
            }

        }else{
            $response['error'] = true ;
            $response['message'] =  'Required information is missing';
         } 
    }else{
        $response['error'] = true ;
        $response['message'] =  'Invalid request';
    }


    echo json_encode($response);





?>