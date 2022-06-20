<?php
$user = new User();

    if(!isset($_SESSION, $_SESSION['token']) || empty($_SESSION['token'])){
        if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
            // logged in might b
            $cookie_token = $_COOKIE['_au'];
            $user_info = $user->getUserByToken($cookie_token);
            if(!$user_info){
                setcookie('_au','',time()-60, '/');
                redirect('./','error','Please login first.');
            }

            setSession('user_id',$user_info[0]->id);
            setSession('name',$user_info[0]->full_name);
            setSession('email',$user_info[0]->email);
            setSession('role',$user_info[0]->role);

            $token = generateRandomString(100);
                
            setSession('token',$token);

            setcookie('_au',$token,(time()+86400000), '/');
            $data = array(
                'remember_token' => $token
            );
            $user->updateData($data, $user_info[0]->id);
            
        } else {
            redirect('./','error','Please login first.');
        }
    }