<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $category = new Category();

    if(isset($_POST) && !empty($_POST)){
        
        // where data is being received
        $data = array(
            'title' => sanitize($_POST['title']),
            'summary'=> sanitize($_POST['summary']),
            'status' =>  sanitize($_POST['status']),
            'created_by' => $_SESSION['user_id']
        );
        
        if(isset($_POST['del_image']) && !empty($_POST['del_image'])){
            $status = deleteImage($_POST['del_image'],'category');
            if($status){
                $data['image'] = '';
            }
        }


        if(isset($_FILES['image']) && $_FILES['image']['error']==0){
            // image Upload
            $image_name = uploadImage($_FILES['image'], "category");
            if($image_name){
                $data['image'] = $image_name;
                
                if(isset($_POST['old_image']) && !empty($_POST['old_image'])){
                    deleteImage($_POST['old_image'],'category');
                }

            } else {
                setSession('warning','File could not be uploaded.');
            }
        }

    
        $cat_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($cat_id){
            $act = "updat";
            $cat_id_value = $category->updateData($data,$cat_id);
        } else {
            $act = "add";
            $cat_id_value = $category->insertData($data);
        }
        if($cat_id_value){
            redirect('../category.php','success','Category '.$act.'ed successfully.');
        } else {
            redirect('../category.php','error','Sorry! There was problem while '.$act.'ing category.');
        }
    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../category.php','error','Invalid Category Id');
        }

        $_token = $_GET['token'];
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../category.php','error','Invalid token.');
        }

        $cat_info = $category->getRowById($id); //
        $del = $category->deleteRowById($id);
        if($del){
            deleteImage($cat_info[0]->image, 'category');
            redirect('../category.php','success','Category deleted successfully.');
        } else {
            redirect('../category.php','error','Sorry! Category could not be deleted at this moment.');
        }
    } else {
        redirect('../category.php','error','Add category first.');
    }