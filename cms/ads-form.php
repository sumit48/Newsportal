<?php require_once '../config/init.php'; ?>
<?php
$_title = "Advertisement Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
$ads = new Advertisement;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./ads.php','error',"Invalid Advertisement Id.");
    }

    $ads_info = $ads->getRowById($id);

    if(!$ads_info){
        redirect('./ads.php','error',"Advertisement has been already deleted or does not exists.");
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
                    Advertisement <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/ads.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$ads_info[0]->title?>" name="title" required id="title" placeholder="Enter Advertisement title..." class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Link: </label>
                                <div class="col-sm-9">
                                    <input type="url" value="<?php echo @$ads_info[0]->link?>" name="link" required id="link" placeholder="Enter Advertisement url..." class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($ads_info) && $ads_info[0]->status == 'active') ? 'selected' : ''?>>Publish</option>
                                        <option value="inactive" <?php echo (isset($ads_info) && $ads_info[0]->status == 'inactive') ? 'selected' : ''?>>Un-Publish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Position: </label>
                                <div class="col-sm-9">
                                    <select name="position" id="position" required class="form-control form-control-sm">
                                    <?php 
                                        foreach($ads_posn as $db_key => $value){
                                            ?>
                                            <option value="<?php echo $db_key?>" <?php echo (isset($ads_info) && $ads_info[0]->position == $db_key) ? 'selected' : ''?>>
                                                <?php echo $value?>
                                            </option>
                                            <?php
                                        }
                                    
                                    ?>
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
                                        if(isset($ads_info, $ads_info[0]->image) && $ads_info[0]->image != null && file_exists(UPLOAD_DIR.'ads/'.$ads_info[0]->image)){
                                            ?>
                                            <img src="<?php echo UPLOAD_URL.'ads/'.$ads_info[0]->image;?>" alt="" class="img img-thumbnail img-fluid">
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$ads_info[0]->id?>">
                                        <input type="hidden" name="old_image" value="<?php echo @$ads_info[0]->image?>">
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