<?php require_once '../config/init.php'; ?>
<?php
$_title = "News Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
$news = new News;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./news.php','error',"Invalid News Id.");
    }

    $news_info = $news->getNewsById($id);

    if(!$news_info){
        redirect('./news.php','error',"News has been already deleted or does not exists.");
    }
    $act = "Update";
}
?>
<link rel="stylesheet" href="<?php echo CMS_CSS_URL.'/summernote-bs4.css'?>">
<!-- Page Wrapper -->
<div id="wrapper">

    <?php require_once 'inc/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php require_once 'inc/topnav.php'; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php flash(); ?>
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">
                    News <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/news.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$news_info[0]->title?>" name="title" required id="title" placeholder="Enter News title..." class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Summary: </label>
                                <div class="col-sm-9">
                                    <textarea name="summary" id="summary" rows="5" style="resize: none" class="form-control form-control-sm" placeholder="Enter News summary..."><?php echo @$news_info[0]->summary?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Description: </label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" rows="5" style="resize: none" class="form-control form-control-sm" placeholder="Enter News description..."><?php echo @$news_info[0]->description?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Category: </label>
                                <div class="col-sm-9">
                                    <select name="cat_id" id="cat_id" required class="form-control form-control-sm">
                                        <option value="" selected disabled>-- Select Any One --</option>
                                        <?php 
                                            $category = new Category;
                                            $all_cats = $category->getAllRows();
                                            
                                            if($all_cats){
                                                foreach($all_cats as $cat_list){
                                                    ?>
                                                    <option value="<?php echo $cat_list->id?>" <?php echo isset($news_info) && $news_info[0]->cat_id == $cat_list->id ? 'selected' : ''?>>
                                                        <?php echo $cat_list->title?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">States: </label>
                                <div class="col-sm-9">
                                    <select name="state" id="state" class="form-control form-control-sm">
                                        <option value="" selected>-- All State --</option>
                                        <?php 
                                            foreach($_states as $db_key => $name){
                                            ?>
                                                <option value="<?php echo $db_key?>" <?php echo (isset($news_info) && $news_info[0]->state == $db_key) ? 'selected' : ''?>>
                                                    <?php echo $name?> 
                                                </option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Location: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$news_info[0]->location; ?>" name="location" id="location" placeholder="Enter News location..." class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">News Date: </label>
                                <div class="col-sm-9">
                                    <input type="date" value="<?php echo @$news_info[0]->news_date; ?>" name="news_date" id="news_date" placeholder="Enter News Date..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Source: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$news_info[0]->source; ?>" name="source" id="source" placeholder="Enter News source..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Is Featured? </label>
                                <div class="col-sm-9">
                                <input type="checkbox" name="is_featured" value="1" <?php echo (isset($news_info, $news_info[0]->is_featured) && $news_info[0]->is_featured == 1) ? 'checked' : ''?>> Yes
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Is Trending? </label>
                                <div class="col-sm-9">
                                <input type="checkbox" name="is_trending" value="1" <?php echo (isset($news_info, $news_info[0]->is_trending) && $news_info[0]->is_trending == 1) ? 'checked' : ''?>> Yes
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="" class="col-sm-3">Reporter: </label>
                                <div class="col-sm-9">
                                    <select name="reporter_id" id="reporter_id" class="form-control form-control-sm">
                                        <option value="" selected disabled>-- Select Any One --</option>
                                        <?php 
                                            $user = new User;
                                            $reporters = $user->getUserByType('reporter');
                                            if($reporters){
                                                foreach($reporters as $reporter_info){
                                                    ?>
                                                    <option value="<?php echo $reporter_info->id?>" <?php echo isset($news_info) && $news_info[0]->reporter_id == $reporter_info->id ? 'selected' : ''?>>
                                                        <?php echo $reporter_info->full_name?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($news_info) && $news_info[0]->status == 'active') ? 'selected' : ''?>>Publish</option>
                                        <option value="inactive" <?php echo (isset($news_info) && $news_info[0]->status == 'inactive') ? 'selected' : ''?>>Un-Publish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Image: </label>
                                <div class="col-sm-5">
                                    <input type="file" name="image" accept="image/*">
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                        if(isset($news_info, $news_info[0]->image) && $news_info[0]->image != null && file_exists(UPLOAD_DIR.'news/'.$news_info[0]->image)){
                                            ?>
                                            <img src="<?php echo UPLOAD_URL.'news/'.$news_info[0]->image;?>" alt="" class="img img-thumbnail img-fluid">
                                            <input type="checkbox" name="del_image" value="<?php echo $news_info[0]->image;?>"> Delete
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$news_info[0]->id?>">
                                        <input type="hidden" name="old_image" value="<?php echo @$news_info[0]->image?>">
                                    <button class="btn btn-sm btn-danger" type="reset">
                                        <i class="fa fa-trash"></i> Reset
                                    </button>
                                    <button class="btn btn-sm btn-success" type="submit">
                                        <i class="fa fa-paper-plane"></i> Submit
                                    </button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php require_once 'inc/copy.php'; ?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php require_once 'inc/logout-modal.php'; ?>
<?php require_once 'inc/footer.php'; ?>
<script src="<?php echo CMS_JS_URL.'/summernote-bs4.min.js'?>"></script>
<script>
    $('#description').summernote({
        height: 250
    });
</script>