<?php require_once 'config/init.php';

    $gal = new Gallery;

    $gal_info = $gal->getGalleryList();
    //debug($gal_info,true);
    
   
   
    if(!$gal_info){
        $no_gal = true;
    } else {
        //$news = new News;
       // $all_news = $news->getNewsBygalId($gal_id, 0, 20);

        /// no of pages => ceil(total/limit)

        // for($i=1; $i <= $pages; $i++) { echo $i; }
        // 1 => 0,20
        // 2 => 20, 20,
        // 3 => 40, 20
        // 4 => 60, 20
        // 5 => 80, 20
    }

$_meta = array(
    'keywords' => 'Hompage, newsportal, news, nepali, samachar'
);
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php';?>

<div class="container">
    
    <div class="row mt-5">

        <div class="col-12">
            <?php 
                if(!$gal_info){
                    echo "<p class='alert alert-danger'>Gallery Not found.</p>";
                } else {
                    foreach($gal_info as $gal_list){
                        
                    ?>
                        <div class="row list-view">
                            <div class="col-md-4">
                            <a href="gallery-detail.php?id=<?php echo $gal_list->id;?>">   
                            <?php
                                if ($gal_list->image != null && file_exists(UPLOAD_DIR . '/gallery/' . $gal_list->image)) {
                                ?>
                                    <img src="<?php echo UPLOAD_URL . '/gallery/' . $gal_list->image ?>" style="width: 100%; height: auto;">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo IMAGES_URL . '/logo.png' ?>" style="width: 100%; height: auto;">
                                <?php
                                }
                            ?>
                            </a>
                            </div>
                            <div class="col-md-8">
                                <h4 class="text-justify">
                                    <a href="gallery-detail.php?id=<?php echo $gal_list->id;?>">
                                        <?php echo $gal_list->title?>
                                    </a>
                                </h4>
                                <p>
                                    <?php echo $gal_list->summary; ?>
                                </p>
                                <div class="row">
                                        <label for="" class="col-md-3"><strong>Photographer:</strong></label>
                                        <div class="col-md-5 text-left"><?php echo $gal_list->photographer ?></div>
                                    </div>
                                <h6 class="text-justify">
                                    <?php 
                                       
                                        $id = $gal_list->created_by;                                       
                                        $user = new User;
                                        $all_user = $user->getUserById($gal_list->created_by);
                                        //debug($all_user,true);
                                      
                                    ?>
                                    <div class="row">
                                        <label for="" class="col-md-3"><strong>Created By:</strong></label>
                                        <div class="col-md-5 text-left"><?php echo $all_user[0]->full_name ?></div>
                                    </div>
                                    
                                    
                                </h6>
                            </div>
                        </div>
                    <?php
                        }
                    
                }
            ?>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php';?>