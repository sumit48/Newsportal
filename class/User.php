<?php 
    final class User extends Database{
        use DataTraits;

        public function __construct()
        {
            parent::__construct();
            $this->table = "users";
        }

        public function getUserByType($role){
            $param = array(
                'where' => array(
                    'role' =>  $role
                )
            );
            return $this->select($param);
            
        }
        public function getUserById($id){
            $param = array(
                'where' => ' id ='.$id
            );
            return $this->select($param);
            
        }

        public function getAllUser(){
            $param = array(
                'where' => " id != ".$_SESSION['user_id']
            );
            return $this->select($param);
        }
        
        public function getUserByEmail($email){
            // SELECT * FROM users WHERE email = '".$email."'
            // SELECT * FROM users WHERE remmeber_token = ''
            // SELECT * FROM users 
            // SELECT * FROM users WHERE role = 'admin',
            $param = array(
                // 'fields' => ["id", "name", 'email', "password"]
                // 'fields' => "id, name, email, password"
                // 'where' => " email = '".$email."'"
                'where' => array(
                    'email' =>  $email,
                    'status' => 'active'
                )
            );
            return $this->select($param);
            
        }

        public function getUserByToken($cookie_token){
            $param = array(
                'where' => array(
                    'remember_token' =>  $cookie_token,
                    'status' => 'active'
                )
            );
            return $this->select($param);
            
        }
    }