<?php require_once '../config/init.php'; ?>
<?php
$_title = "Video Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
$video = new Video;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./video.php','error',"Invalid Video Id.");
    }

    $video_info = $video->getRowById($id);

    if(!$video_info){
        redirect('./video.php','error',"Video has been already deleted or does not exists.");
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
                    Video <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/video.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$video_info[0]->title?>" name="title" required id="title" placeholder="Enter Video title..." class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Video Url(YouTube): </label>
                                <div class="col-sm-9">
                                    <input type="url" value="<?php echo @$video_info[0]->video_link?>" name="video_link" required id="video_link" placeholder="Enter YouTube Video url..." class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Summary: </label>
                                <div class="col-sm-9">
                                    <textarea name="summary" id="summary" rows="5" style="resize: none" class="form-control form-control-sm" placeholder="Enter Video summary..."><?php echo @$video_info[0]->summary?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($video_info) && $video_info[0]->status == 'active') ? 'selected' : ''?>>Publish</option>
                                        <option value="inactive" <?php echo (isset($video_info) && $video_info[0]->status == 'inactive') ? 'selected' : ''?>>Un-Publish</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$video_info[0]->id?>">
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