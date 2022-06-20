<?php require_once 'config/init.php';

    $video = new Video;

    $video_info = $video->getVideoList();
    //debug($video_info,true);
    if(!$video_info){
        $no_video = true;
    } else {
        //$news = new News;
       // $all_news = $news->getNewsByvideoId($video_id, 0, 20);

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
                if(!$video_info){
                    echo "<p class='alert alert-danger'>Video Not found.</p>";
                } else {
                    foreach($video_info as $video_list){
                    ?>
                        <div class="row list-view">
                            <div class="col-md-4">
                                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/<?php echo $video_list->video_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="col-md-8">
                                <h4 class="text-justify">
                                    <a href="video.php?id=<?php echo $video_list->id;?>">
                                        <?php echo $video_list->title?>
                                    </a>
                                </h4>
                                <p>
                                    <?php echo $video_list->summary; ?>
                                </p>
                            </div>
                        </div>
                    <?php
                        }
                    
                }
            ?>
        </div>
    </div>
</div>


<!-- Video Closed -->


<?php require_once 'inc/footer.php';?>