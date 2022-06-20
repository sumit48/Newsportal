<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $video = new Video();

    if(isset($_POST) && !empty($_POST)){
        // where data is being received
        $data = array(
            'title' => sanitize($_POST['title']),
            'summary'=> sanitize($_POST['summary']),
            'video_link'=> sanitize($_POST['video_link']),
            'video_id'=> getVideoIdFromUrl($_POST['video_link']),
            'status' =>  sanitize($_POST['status']),
            'created_by' => $_SESSION['user_id']
        );
        if($data['video_id'] == false){
            redirect('../video-form.php','error','Invalid YouTube url. Copy from url bar to get the valid Url.');
        }        

    
        $video_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($video_id){
            $act = "updat";
            $video_id_value = $video->updateData($data,$video_id);
        } else {
            $act = "add";
            $video_id_value = $video->insertData($data);
        }
        if($video_id_value){
            redirect('../video.php','success','Video '.$act.'ed successfully.');
        } else {
            redirect('../video.php','error','Sorry! There was problem while '.$act.'ing video.');
        }  
    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../video.php','error','Invalid Video Id');
        }

        $_token = $_GET['token'];  
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../video.php','error','Invalid token.');
        }

        $cat_info = $video->getRowById($id); //
        $del = $video->deleteRowById($id);
        if($del){
            redirect('../video.php','success','Video deleted successfully.');
        } else {
            redirect('../video.php','error','Sorry! Video could not be deleted at this moment.');
        }  
    } else {
        redirect('../video.php','error','Add video first.' );
    }