<?php require_once 'config/init.php';
    
$no_news = false;

if(isset($_GET['id']) && !empty($_GET['id'])){
    $news_id = (int)$_GET['id'];
    if($news_id <= 0){
        $no_news = true;
    }

    $news = new News;
    $news_info = $news->getRowById($news_id);
    if(!$news_info){
        $no_news = true;
    } else {
        $_meta = array(
            'keywords' => $news_info[0]->title,
            'description' => $news_info[0]->summary,
            'image' => UPLOAD_URL.'news/'.$news_info[0]->image
        );
        
    }
}
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php';?>

<div class="container">
    <div class="row mt-5">

        <div class="col-12">
            <?php 
                if($no_news){
                    echo "<p class='alert alert-danger'>Category Not found.</p>";
                } else {
                    ?>
                    <h1 class="text-center">
                        <strong>
                            <?php echo $news_info[0]->title;?>
                        </strong>
                    </h1>
                    <br>
                    <?php 
                        if($news_info[0]->image != null && file_exists(UPLOAD_DIR.'/news/'.$news_info[0]->image)){
                        ?>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="<?php echo UPLOAD_URL.'news/'.$news_info[0]->image;?>" alt="<?php echo $news_info[0]->title;?>" class="img img-thumbnail img-fluid">
                            </div>
                        </div>
                        <?php
                        }

                    ?>
                    <div class="row mt-5">
                        <div class="col-sm-12 col-md-6">
                            <p>
                                <small>
                                    <i class="fa fa-calendar"></i> 
                                    <em>
                                        <?php echo date('j, F Y',strtotime($news_info[0]->news_date))?>
                                    </em>
                                </small>, 
                                <small>
                                    <i class="fa fa-map-marker"></i> 
                                    <em>
                                        <?php echo $news_info[0]->location?>
                                    </em>
                                </small>
                            </p>
                        </div>
                        <div class="col-sm-12  col-md-6">
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="text-justify">
                            <?php 
                                echo html_entity_decode($news_info[0]->description);
                                // echo $news_info[0]->description;
                            ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <small>
                                <em>
                                    Source: <?php echo $news_info[0]->source;?>
                                </em>, 
                                <em>
                                    Reporter: 
                                    <?php 
                                        $user = new User;
                                        $user_info = $user->getRowById($news_info[0]->reporter_id);

                                        echo $user_info[0]->full_name;
                                    ?>
                                </em>
                            </small>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <ul class="css-nav">
                                <li><a href="javascript:;">Comments</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="fb-comments" 
                                data-href="<?php echo getCurrentUrl();?>" data-width="100%" data-numposts="10"></div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <ul class="css-nav">
                                <li><a href="javascript:;">Related News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <?php 
                            $related_news = $news->getRelatedNews($news_info[0]->cat_id, $news_info[0]->id);
                            if($related_news){
                                foreach($related_news as $key => $news_related){
                                    ?>
                                    <div class="col-sm-12 col-md-3 mt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="news.php?id=<?php echo $news_related->id?>">
                                                <?php 
                                                    if($news_related->image != null && file_exists(UPLOAD_DIR.'/news/'.$news_related->image)){
                                                    ?>
                                                            <img src="<?php echo UPLOAD_URL.'news/'.$news_related->image;?>" alt="<?php echo $news_related->title;?>" class="img img-thumbnail img-fluid">
                                                    <?php
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo IMAGES_URL.'/logo.png';?>" alt="<?php echo $news_related->title;?>" class="img img-thumbnail img-fluid">
                                                    <?php
                                                
                                                    }
                                                ?>
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <a href="news.php?id=<?php echo $news_related->id;?>">
                                                    <h4>
                                                        <?php echo $news_related->title;?>
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        
                        ?>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php';?>