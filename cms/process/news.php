<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $news = new News();

    if(isset($_POST) && !empty($_POST)){
        // debug($_POST);
        // debug($_FILES, true);
        // where data is being received
        $data = array(
            'title' => sanitize($_POST['title']),
            'cat_id' => (int)($_POST['cat_id']),
            'summary'=> sanitize($_POST['summary']),
            'description'=> htmlentities($_POST['description']),
            'reporter_id'=> (isset($_POST['reporter_id']) && !empty($_POST['reporter_id'])) ? (int)($_POST['reporter_id']) : '',
            'news_date'=> sanitize($_POST['news_date']),
            'location'=> sanitize($_POST['location']),
            'source'=> sanitize($_POST['source']),
            'state'=> (isset($_POST['state']) && !empty($_POST['state'])) ? sanitize($_POST['state']) : '',
            'is_featured'=> (isset($_POST['is_featured']) && !empty($_POST['is_featured'])) ? 1 : 0,
            'is_trending'=> (isset($_POST['is_trending']) && !empty($_POST['is_trending'])) ? 1 : 0,
            'status' =>  sanitize($_POST['status'])
        );
        if(empty($data['state'])){
            unset($data['state']);
        }

        if(empty($data['cat_id'])){
            unset($data['cat_id']);
        }
        
        if(isset($_POST['del_image']) && !empty($_POST['del_image'])){
            $status = deleteImage($_POST['del_image'],'news');
            if($status){
                $data['image'] = '';
            }
        }


        if(isset($_FILES['image']) && $_FILES['image']['error']==0){
            // image Upload
            $image_name = uploadImage($_FILES['image'], "news");
            if($image_name){
                $data['image'] = $image_name;
                
                if(isset($_POST['old_image']) && !empty($_POST['old_image'])){
                    deleteImage($_POST['old_image'],'news');
                }

            } else {
                setSession('warning','File could not be uploaded.');
            }
        }

    
        $news_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($news_id){
            $act = "updat";
            $news_id_value = $news->updateData($data,$news_id);
        } else {
            $data['created_by'] = $_SESSION['user_id'];
            $act = "add";
            $news_id_value = $news->insertData($data);
        }
        if($news_id_value){
            redirect('../news.php','success','News '.$act.'ed successfully.');
        } else {
            redirect('../news.php','error','Sorry! There was problem while '.$act.'ing news.');
        }

    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../news.php','error','Invalid News Id');
        }

        $_token = $_GET['token'];
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../news.php','error','Invalid token.');
        }

        $cat_info = $news->getRowById($id); //
        $del = $news->deleteRowById($id);
        if($del){
            deleteImage($cat_info[0]->image, 'news');
            redirect('../news.php','success','News deleted successfully.');
        } else {
            redirect('../news.php','error','Sorry! News could not be deleted at this moment.');
        }
    } else {
        redirect('../news.php','error','Add news first.');
    }