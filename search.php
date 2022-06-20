<?php require_once 'config/init.php';
    
$no_result = false;
if(isset($_GET['q']) && !empty($_GET['q'])){
    $news = new News;

    $all_news = $news->getSearchResult($_GET['q']);
}
$_meta = array(
    'keywords' => 'Hompage, newsportal, news, nepali, samachar'
);
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php';?>

<div class="container">
    <ul class="css-nav">
        <li><a href="javascript:;">Search Result</a></li>
    </ul>

    <div class="row mt-5">

        <div class="col-12">
            <?php 
                if($no_result){
                    echo "<p class='alert alert-danger'>Category Not found.</p>";
                } else {
                    if($all_news){
                        foreach($all_news as $news_list){
                    ?>
                        <div class="row list-view">
                            <div class="col-md-4">
                            <?php
                                if ($news_list->image != null && file_exists(UPLOAD_DIR . '/news/' . $news_list->image)) {
                                ?>
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $news_list->image ?>" style="width: 100%; height: auto;">
                                <?php
                                } else {
                                ?>
                                    <img src="<?php echo IMAGES_URL . '/logo.png' ?>" style="width: 100%; height: auto;">
                                <?php
                                }
                            ?>
                            </div>
                            <div class="col-md-8">
                                <h4 class="text-justify">
                                    <a href="news.php?id=<?php echo $news_list->id;?>">
                                        <?php echo $news_list->title?>
                                    </a>
                                </h4>
                                <p>
                                    <?php echo $news_list->summary; ?>
                                </p>
                            </div>
                        </div>
                    <?php
                        }
                    } else {
                        echo "<p class='alert alert-danger'>No news in this category</a>";
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php';?>