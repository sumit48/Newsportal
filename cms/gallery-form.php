<?php require_once '../config/init.php'; ?>
<?php
$_title = "Gallery Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
$gallery = new Gallery;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./gallery.php','error',"Invalid Gallery Id.");
    }

    $gallery_info = $gallery->getRowById($id);

    if(!$gallery_info){
        redirect('./gallery.php','error',"Gallery has been already deleted or does not exists.");
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
                    Gallery <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/gallery.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Title: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$gallery_info[0]->title?>" name="title" required id="title" placeholder="Enter Gallery title..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Photographer: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$gallery_info[0]->photographer?>" name="photographer" id="photographer" placeholder="Enter Photographer Name..." class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Summary: </label>
                                <div class="col-sm-9">
                                    <textarea name="summary" id="summary" rows="5" style="resize: none" class="form-control form-control-sm" placeholder="Enter Gallery summary..."><?php echo @$gallery_info[0]->summary?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($gallery_info) && $gallery_info[0]->status == 'active') ? 'selected' : ''?>>Publish</option>
                                        <option value="inactive" <?php echo (isset($gallery_info) && $gallery_info[0]->status == 'inactive') ? 'selected' : ''?>>Un-Publish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Cover Image: </label>
                                <div class="col-sm-5">
                                    <input type="file" name="image" <?php echo (isset($gallery_info)) ? '' : 'required' ?> accept="image/*">
                                </div>
                                <div class="col-sm-4">
                                    <?php 
                                        if(isset($gallery_info, $gallery_info[0]->image) && $gallery_info[0]->image != null && file_exists(UPLOAD_DIR.'gallery/'.$gallery_info[0]->image)){
                                            ?>
                                            <img src="<?php echo UPLOAD_URL.'gallery/'.$gallery_info[0]->image;?>" alt="" class="img img-thumbnail img-fluid">
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="" class="col-sm-3">Related Image: </label>
                                <div class="col-sm-5">
                                    <input type="file" name="related_images[]" multiple accept="image/*">
                                </div>
                            </div>

                            <div class="form-group row">
                                <?php 
                                    if(isset($gallery_info) && !empty($gallery_info)){
                                        $gallery_img = new GalleryImage;
                                        $all_images = $gallery_img->getAllImageByGalleryId($gallery_info[0]->id);

                                        if($all_images){
                                            foreach($all_images as $gal_ind_image){
                                                ?>
                                                <div class="col-sm-12 col-md-3">
                                                    <img src="<?Php echo UPLOAD_URL.'/gallery/'.$gal_ind_image->image_name;?>" alt="" class="img img-fluid img-thumbnail">
                                                    <input type="checkbox" name="del_image[]" value="<?php echo $gal_ind_image->image_name?>"> Delete
                                                </div>
                                                
                                                <?php

                                            }
                                        }
                                    }
                                
                                ?>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$gallery_info[0]->id?>">
                                        <input type="hidden" name="old_image" value="<?php echo @$gallery_info[0]->image?>">
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