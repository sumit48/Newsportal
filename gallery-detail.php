<?php require_once 'config/init.php';

$no_gal = false;
$gal = new Gallery;
$gal_info = $gal->getGalleryList();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $gal_id = (int) $_GET['id'];
    if ($gal_id <= 0) {
        $no_gal = true;
    }


    //debug($all_image,true);
    if (!$gal_info) {
        $no_gal = true;
    } else {
        $_meta = array(
            'keywords' => $gal_info[0]->title,
            'description' => $gal_info[0]->summary,
            'image' => UPLOAD_URL . 'gallery/' . $gal_info[0]->image
        );
    }
    $gallery_image = new GalleryImage();
    $all_images = $gallery_image->getAllImageByGalleryId($_GET['id']);
    //debug($all_images,true);
}
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php'; ?>
<div class="container-fluid">
    <div class="row-mt-5">
        <div class="col-sm-12">
            <?php
            if ($all_images) {
                foreach ($all_images as $image_data) {
            ?>
                    <br>
                    <div class="row-mt-5">
                        <img src="<?php echo UPLOAD_URL . '/gallery/' . $image_data->image_name ?>" style="width: 100%; height: auto;">
                    </div>

            <?php
                }
            } else {
                echo "Images not found !!!!!!!!";
            }
            ?>
        </div>
    </div>
</div>


<?php require_once 'inc/footer.php'; ?>