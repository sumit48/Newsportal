<?php
    function debug($data, $is_exit=false){
        echo "<pre style='background: #ffffff'>";
        print_r($data);
        echo "</pre>";
        if($is_exit){
            exit;
        }
    }
    function setSession($key, $msg){
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION[$key] = $msg;
    }

    function redirect($path, $key=null, $msg=null){
        if($key != null){
            setSession($key, $msg);
        }
        header('location: '.$path);
        exit;
    }

    function flash(){
        if(isset($_SESSION, $_SESSION['success']) && !empty($_SESSION['success'])){
            echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }

        if(isset($_SESSION, $_SESSION['warning']) && !empty($_SESSION['warning'])){
            echo "<p class='alert alert-warning'>".$_SESSION['warning']."</p>";
            unset($_SESSION['warning']);
        }

        if(isset($_SESSION, $_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
    }

    function generateRandomString($length = 100){
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $strlen = strlen($chars);
        $random = "";
        
        for($i=0; $i< $length; $i++){
            $posn = rand(0, $strlen-1);
            $random .= $chars[$posn];
        }
        return $random;
    }

    function sanitize($str){
        // mysqli_real_escape_string($str);
        // addslashes($str);   // \'

        $str = strip_tags($str);    // <p>Test Test</p> =>    Test
        $str = rtrim($str);
        return $str;

    }

    function uploadImage($file, $dir){
        if($file['error'] == 0){
            if($file['size'] <= 5000000){
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
                    $path = UPLOAD_DIR.$dir;

                    if(!is_dir($path)){
                        mkdir($path, 0777, true);
                    }
                    // Category-2020119033730123.jpg
                    $file_name = ucfirst($dir)."-".date("Ymdhis").rand(0,999).".".$ext;
                    $success = move_uploaded_file($file['tmp_name'], $path.'/'.$file_name);
                    if($success){
                        return $file_name;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function deleteImage($image_name, $dir){
        if($image_name != null){
            $path = UPLOAD_DIR.$dir.'/'.$image_name;

            if(file_exists($path)){
                $status = unlink($path);
                return $status;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getVideoIdFromUrl($url){
        // #([/|?|&]vi?[/|=]|youtu.be/|embed/)([a-zA-Z0-9_-]+)#
        preg_match("#([\/|\?|&]vi?[\/|=]|youtu\.be\/|embed\/)([a-zA-Z0-9_-]+)#", $url, $matches);
        if(isset($matches[2])){
            return $matches[2];
        } else {
            return false;
        }
    }

    function getCurrentUrl(){
        // http://domain_name/script?get
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        return $url;
    }

    function getCurrentFileName(){
        $file_name = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME); // index.php
        return $file_name;

    }