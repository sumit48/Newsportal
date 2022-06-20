<?php
    require_once "../../config/init.php";
    require_once "../inc/checklogin.php";

    $gallery = new Gallery();

    if(isset($_POST) && !empty($_POST)){
        
        // where data is being received
        $data = array(
            'title' => sanitize($_POST['title']),
            'photographer' => sanitize($_POST['photographer']),
            'summary'=> sanitize($_POST['summary']),
            'status' =>  sanitize($_POST['status']),
            'created_by' => $_SESSION['user_id']
        );
        
        

        // cover Image upload
        if(isset($_FILES['image']) && $_FILES['image']['error']==0){
            // image Upload
            $image_name = uploadImage($_FILES['image'], "gallery");
            if($image_name){
                $data['image'] = $image_name;
                
                if(isset($_POST['old_image']) && !empty($_POST['old_image'])){
                    deleteImage($_POST['old_image'],'gallery');
                }

            } else {
                setSession('warning','File could not be uploaded.');
            }
        }

    
        $gallery_id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if($gallery_id){
            $act = "updat";
            $gallery_id_value = $gallery->updateData($data,$gallery_id); // 3
        } else {
            $act = "add";
            $gallery_id_value = $gallery->insertData($data);//2
        }
        if($gallery_id_value){



            // Related Images Entry
            if(isset($_FILES['related_images']) && !empty($_FILES['related_images'])){
                // file has been uploaded
                $files = $_FILES['related_images'];
                $size = count($files['name']);

                for($i=0; $i<$size; $i++){
                    $temp_image = array(
                        'name' => $files['name'][$i],
                        'type' => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'size' => $files['size'][$i],
                        'error' => $files['error'][$i]
                    );

                    $ind_image = uploadImage($temp_image, 'gallery');
                    if($ind_image){
                        $temp_data = array(
                            'gallery_id' => $gallery_id_value,
                            'image_name' => $ind_image
                        );
                        $gallery_image = new GalleryImage;
                        $gallery_image->insertData($temp_data);
                    }
                }

            }


            if(isset($_POST['del_image']) && !empty($_POST['del_image'])){
                foreach($_POST['del_image'] as $del_image_name){
                    $gallery_image = new GalleryImage;

                    $del = $gallery_image->deleteImageByName($del_image_name);
                    if($del){
                        deleteImage($del_image_name,'gallery');
                    }
                }
            }



            redirect('../gallery.php','success','Gallery '.$act.'ed successfully.');
        } else {
            redirect('../gallery.php','error','Sorry! There was problem while '.$act.'ing gallery.');
        }
    } else if(isset($_GET, $_GET['id'], $_GET['token']) && !empty($_GET['id'])){
        $id = (int)$_GET['id'];        
        if($id <= 0){
            redirect('../gallery.php','error','Invalid Gallery Id');
        }

        $_token = $_GET['token'];
        if($_token != substr(md5("del-cat-".$id."-".$_SESSION['token']),3,15) ){
            redirect('../gallery.php','error','Invalid token.');
        }

        $gallery_info = $gallery->getRowById($id); //
        $gallery_image = new GalleryImage;
        $all_images = $gallery_image->getAllImageByGalleryId($id);

        $del = $gallery->deleteRowById($id);
        if($del){
            deleteImage($gallery_info[0]->image, 'gallery');


            if($all_images){
                foreach($all_images as $del_image_name){
                    deleteImage($del_image_name->image_name,'gallery');
                }    
            }


            redirect('../gallery.php','success','Gallery deleted successfully.');
        } else {
            redirect('../gallery.php','error','Sorry! Gallery could not be deleted at this moment.');
        }
    } else {
        redirect('../gallery.php','error','Add gallery first.');
    }