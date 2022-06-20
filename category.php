<?php require_once 'config/init.php';
    
$no_cat = false;

if(isset($_GET['id']) && !empty($_GET['id'])){
    $cat_id = (int)$_GET['id'];
    if($cat_id <= 0){
        $no_cat = true;
    }

    $cat = new Category;
    $cat_info = $cat->getRowById($cat_id);
    if(!$cat_info){
        $no_cat = true;
    } else {
        $news = new News;
        $all_news = $news->getNewsByCatId($cat_id, 0, 20);

        /// no of pages => ceil(total/limit)

        // for($i=1; $i <= $pages; $i++) { echo $i; }
        // 1 => 0,20
        // 2 => 20, 20,
        // 3 => 40, 20
        // 4 => 60, 20
        // 5 => 80, 20
    }
}
$_meta = array(
    'keywords' => 'Hompage, newsportal, news, nepali, samachar'
);
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php';?>

<div class="container">
    <ul class="css-nav">
        <li><a href="javascript:;"><?php echo $cat_info[0]->title;?></a></li>
    </ul>

    <div class="row mt-5">

        <div class="col-12">
            <?php 
                if($no_cat){
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