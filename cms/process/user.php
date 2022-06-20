<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $user = new User();

    if(isset($_POST) && !empty($_POST)){

        // where data is being received
        $data = array(
            'full_name' => sanitize($_POST['full_name']),
            'email'=> sanitize($_POST['email']),
            'status' =>  sanitize($_POST['status']),
            'role' => sanitize($_POST['role']),
            'password' => sha1($_POST['email'].$_POST['password'])
        );
        
        $user_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($user_id){
            $act = "updat";
            
            unset($data['email']);
            unset($data['password']);

            $user_id_value = $user->updateData($data,$user_id);
        } else {
            $act = "add";
            $user_id_value = $user->insertData($data);
        }
        if($user_id_value){
            redirect('../user.php','success','User '.$act.'ed successfully.');
        } else {
            redirect('../user.php','error','Sorry! There was problem while '.$act.'ing user.');
        }
    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../user.php','error','Invalid User Id');
        }

        $_token = $_GET['token'];
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../user.php','error','Invalid token.');
        }

        $cat_info = $user->getRowById($id); //
        $del = $user->deleteRowById($id);
        if($del){
            deleteImage($cat_info[0]->image, 'user');
            redirect('../user.php','success','User deleted successfully.');
        } else {
            redirect('../user.php','error','Sorry! User could not be deleted at this moment.');
        }
    } else {
        redirect('../user.php','error','Add user first.');
    }