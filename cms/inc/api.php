<?php 
    require_once '../../config/init.php';
    require_once "../inc/checklogin.php";
    $category = new Category;

    if(isset($_POST, $_POST['act']) && $_POST['act'] == 'get-cat-data'){
        // 
        $all_data = $category->getAllRows();
        foreach($all_data as $key => $value){
            $all_data[$key]->del_token = substr(md5("del-cat-".$value->id."-".$_SESSION['token']), 3, 15);
        }


        if($all_data){
            echo json_encode(['status'=>true,'data'=>$all_data, 'msg'=>""]);
        } else {
            echo json_encode(['status'=>false,'data'=>null, 'msg'=>"No data found."]);
        }
        exit;
    } else {
        echo json_encode(['status'=>false,'data'=>null, 'msg'=>"Inavalid Action."]);
    }