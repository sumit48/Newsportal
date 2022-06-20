<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $user = new User();

    if(isset($_POST) && !empty($_POST)){
        
        if($_POST['password'] !== $_POST['re_password']){
            redirect('../password-change.php','error','Password and confirm password does not match.');
        }

        $user_info = $user->getRowById($_POST['id']);

        if(!$user_info){
            redirect('../user.php','error','User does not exists.');
        }

        // where data is being received
        $data = array(
            'password' => sha1($user_info[0]->email.$_POST['password'])
        );
        
        $act = "updat";
        $user_id_value = $user->updateData($data,$user_info[0]->id);

        if($user_id_value){
            if($_SESSION['user_id'] == $user_id_value){
                redirect('../logout.php');
            }
    
            redirect('../user.php','success','Password changed Successfully.');
        } else {
            redirect('../user.php','error','Sorry! There was problem while changing password.');
        }
    }else {
        redirect('../user.php','error','Please select the user.');
    }