<?php 
    require_once '../../config/init.php';
    $user = new User;

    if(isset($_POST) && !empty($_POST)){
        $email = filter_var($_POST['email'],  FILTER_VALIDATE_EMAIL);   // 
        if(!$email){
            redirect('../','error','Invalid email format.');
        } 

        $enc_pwd = sha1($email.$_POST['password']);
    
        $user_info = $user->getUserByEmail($email);
        
        if($user_info){
            // user do exists
            if($user_info[0]->password == $enc_pwd){
                // success 
                setSession('user_id',$user_info[0]->id);
                setSession('name',$user_info[0]->full_name);
                setSession('email',$user_info[0]->email);
                setSession('role',$user_info[0]->role);

                $token = generateRandomString(100);
                
                setSession('token',$token);

                if(isset($_POST['remember_me']) && !empty($_POST['remember_me'])){
                    setcookie('_au',$token,(time()+86400000), '/');
                    $data = array(
                        'remember_token' => $token
                    );
                    $user->updateData($data, $user_info[0]->id);
                }

                redirect('../dashboard.php','success','Welcome to Admin dashboard.');
            } else {
                redirect('../','error','Credentials does not match.');
            }
        } else {
            redirect('../','error','Credentials does not match.');
        }
    } else {
        redirect('../','error','Please Login first');
    }