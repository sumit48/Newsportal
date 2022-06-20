<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $ads = new Advertisement();

    if(isset($_POST) && !empty($_POST)){
        
        // where data is being received
        $data = array(
            'title' => sanitize($_POST['title']),
            'link'=> sanitize($_POST['link']),
            'position'=> sanitize($_POST['position']),
            // 'start_date'=> sanitize($_POST['start_date']),
            // 'end_date'=> sanitize($_POST['end_date']),
            'status' =>  sanitize($_POST['status']),
            'created_by' => $_SESSION['user_id']
        );
    

        if(isset($_FILES['image']) && $_FILES['image']['error']==0){
            // image Upload
            $image_name = uploadImage($_FILES['image'], "ads");
            if($image_name){
                $data['image'] = $image_name;
                
                if(isset($_POST['old_image']) && !empty($_POST['old_image'])){
                    deleteImage($_POST['old_image'],'ads');
                }

            } else {
                setSession('warning','File could not be uploaded.');
            }
        }
        
    
        $ads_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($ads_id){
            $act = "updat";
            $ads_id_value = $ads->updateData($data,$ads_id);
        } else {
            $act = "add";
            $ads_id_value = $ads->insertData($data);
        }
        if($ads_id_value){
            redirect('../ads.php','success','Advertisement '.$act.'ed successfully.');
        } else {
            redirect('../ads.php','error','Sorry! There was problem while '.$act.'ing ads.');
        }
    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../ads.php','error','Invalid Advertisement Id');
        }

        $_token = $_GET['token'];
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../ads.php','error','Invalid token.');
        }

        $cat_info = $ads->getRowById($id); //
        $del = $ads->deleteRowById($id);
        if($del){
            deleteImage($cat_info[0]->image, 'ads');
            redirect('../ads.php','success','Advertisement deleted successfully.');
        } else {
            redirect('../ads.php','error','Sorry! Advertisement could not be deleted at this moment.');
        }
    } else {
        redirect('../ads.php','error','Add ads first.');
    }