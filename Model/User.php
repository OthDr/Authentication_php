<?php

    class User {
        private $username, $user_email , $user_passwd;

        public function __construct($usernamex, $user_emailx , $user_passwdx){
            $this->username = $usernamex;
            $this->user_email = $user_emailx;
            $this->user_passwd = $user_passwdx;
        }

    }

?>