<?php require_once '../config/init.php'; ?>
<?php
$_title = "Category Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
$category = new Category;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./category.php','error',"Invalid Category Id.");
    }

    $cat_info = $category->getRowById($id);

    if(!$cat_info){
        redirect('./category.php','error',"Category has been already deleted or does not exists.");
    }
    $act = "Update";
}
?>
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
                    Category <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/category.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$cat_info[0]->title?>" name="title" required id="title" placeholder="Enter Category title..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Summary: </label>
                                <div class="col-sm-9">
                                    <textarea name="summary" id="summary" rows="5" style="resize: none" class="form-control form-control-sm" placeholder="Enter Category summary..."><?php echo @$cat_info[0]->summary?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($cat_info) && $cat_info[0]->status == 'active') ? 'selected' : ''?>>Publish</option>
                                        <option value="inactive" <?php echo (isset($cat_info) && $cat_info[0]->status == 'inactive') ? 'selected' : ''?>>Un-Publish</option>
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
                                        if(isset($cat_info, $cat_info[0]->image) && $cat_info[0]->image != null && file_exists(UPLOAD_DIR.'category/'.$cat_info[0]->image)){
                                            ?>
                                            <img src="<?php echo UPLOAD_URL.'category/'.$cat_info[0]->image;?>" alt="" class="img img-thumbnail img-fluid">
                                            <input type="checkbox" name="del_image" value="<?php echo $cat_info[0]->image;?>"> Delete
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$cat_info[0]->id?>">
                                        <input type="hidden" name="old_image" value="<?php echo @$cat_info[0]->image?>">
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