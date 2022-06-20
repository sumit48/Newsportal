<?php require_once 'config/init.php';
$_meta = array(
    'keywords' => 'Hompage, newsportal, news, nepali, samachar'
);
?>
<?php require_once 'inc/header.php'; ?>

<?php require_once 'inc/menu.php';

$news = new News;
$top_news = $news->getFeaturedNews(3, 0);
if ($top_news) {
    foreach ($top_news as $featured_news) {
?>
        <div class="newsfeed">
            <div class="container">
                <h3 class="header1">
                    <a href="news.php?id=<?php echo $featured_news->id ?>">
                        <?php echo $featured_news->title ?>
                    </a>
                </h3>

                <?php
                if ($featured_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $featured_news->image)) {
                ?>
                    <div class="img_hastag">
                        <img src="<?php echo UPLOAD_URL . '/news/' . $featured_news->image ?>" alt="<?php echo $featured_news->title ?>">
                    </div>
                <?php
                }
                ?>
                <p class="img_content">
                    <?php echo $featured_news->summary; ?>
                    <a href="news.php?id=<?php echo $featured_news->id ?>">
                        Read More...
                    </a>
                </p>
            </div>
        </div>
        <hr class="first">

    <?php
    }
}

$remaining_featured = $news->getFeaturedNews(5, 3);
if ($remaining_featured) {
    $first_elem = array_shift($remaining_featured);

    ?>
    <div class="listing">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card" style="width: 100%; height: auto; border:1px solid #e8edf4;  box-shadow: 5px 5px 10px 10px #888888;">
                        <img src="<?php echo UPLOAD_URL . '/news/' . $first_elem->image ?>" class="card-img-top" alt="..." style="width: 100%;height: 450px;object-fit: cover;transition: all .4s ease;">
                        <div class="card-body">
                            <p class="card-text1">
                                <a href="news.php?id=<?php echo $first_elem->id; ?>">
                                    <?php echo $first_elem->title; ?>
                                </a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">

                    <?php
                    if ($remaining_featured) {
                        foreach ($remaining_featured as $left_news) {
                    ?>
                            <div class="row mt-3">
                                <?php
                                if ($left_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $left_news->image)) {
                                ?>
                                    <div class="col-md-5">
                                        <img class="img img-fluid img-thumbnail" src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" alt="<?php echo $featured_news->title ?>" style="max-width: 200px;">
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-md-5">
                                        <img class="img img-fluid img-thumbnail" src="<?php echo IMAGES_URL . '/logo1.png' ?>" alt="<?php echo $featured_news->title ?>">
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-md-5">
                                    <p style="font-weight: 600; font-size: 1em;" class="list11">
                                        <a href="news.php?id=<?php echo $left_news->id; ?>"><?php echo $left_news->title; ?></a></p>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
<?php
}
?>



<!-- Content Closed -->
<?php
$news_cat_news = $news->getNewsByCatId(1, 0, 1);
if ($news_cat_news) {
?>
    <!-- Listing_paage -->
    <div class="title_news">
        <div class="container">
            <ul class="css-nav">
                <li><a href="category.php?id=1">समाचार</a></li>
            </ul>
            <div class="row">
                <div class="col-12">
                    <h1 class="title_news1">
                        <a href="news.php?id=<?php echo $news_cat_news[0]->id; ?>"><?php echo $news_cat_news[0]->title; ?></a>
                    </h1>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="news.php?id=<?php echo $news_cat_news[0]->id ?>">
                                <img src="<?php echo UPLOAD_URL . '/news/' . $news_cat_news[0]->image; ?>" style="height: auto; width: 100%;">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <p style="font-size: 1.2em; font-weight: 450;"><?php echo $news_cat_news[0]->summary ?></p>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $top_1 = $ads->getAdsByPosition('home3');
                            if ($top_1) {
                            ?>
                                <div class="info">
                                    <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                        <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                    </a>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-3">
                <?php
                $news_row = $news->getNewsByCatId(1, 1, 3);
                if ($news_row) {
                    foreach ($news_row as $row_news) {
                ?>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $row_news->image; ?>" alt="" style="width: 100%; height: 150px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="three_nepali">
                                        <a href="news.php?id=<?php echo $row_news->id; ?>">
                                            <?php echo $row_news->title; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <div class="col-md-3">
                    <div class="row">
                        <?php
                        $top_1 = $ads->getAdsByPosition('home4');
                        if ($top_1) {
                        ?>
                            <div class="info">
                                <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                    <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                </a>
                            </div>

                        <?php
                        }

                        ?>
                    </div>
                </div>


            </div>

            <div class="row mt-3">
                <div class="row mt-3">
                    <div class="col-md-5">
                        <?php
                        $left_side = $news->getNewsByCatId(1, 4, 5);
                        if ($left_side) {
                            foreach ($left_side as $left_news) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $left_news->id; ?>">
                                                <?php echo $left_news->title; ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="col-md-5">
                        <?php
                        $right_side = $news->getNewsByCatId(1, 9, 5);
                        if ($right_side) {
                            foreach ($right_side as $news_right) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $news_right->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $news_right->id ?>">
                                                <?php echo $news_right->title ?>
                                            </a>
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
        </div>
    </div>
    <!-- ListingPage closed -->

<?php
}
?>


<!-- देश -->
<div class="country">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9">
                <nav class="navbar navbar-light bg-light" style="border-radius: 20px;">
                    <a class="navbar-brand" href="#">देश</a>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php
                        foreach ($_states as $key => $state) {

                        ?>
                            <a class="nav-item nav-link <?php echo $key == 'state1' ? 'active' : ''; ?>" id="nav-<?php echo $key ?>-tab" data-toggle="tab" href="#nav-<?php echo $key; ?>" role="tab" aria-controls="nav-<?php echo $key; ?>" aria-selected="<?php echo $key == 'state1' ? true : false; ?>"><?php echo $state ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <?php
                        foreach ($_states as $key => $state) {
                            $state_wise_news = $news->getStateWiseNews($key);
                        ?>
                            <div class="tab-pane fade <?php echo $key == 'state1' ? 'show active' : '' ?>" id="nav-<?php echo $key; ?>" role="tabpanel" aria-labelledby="nav-<?php echo $key ?>-tab">
                                <?php
                                if ($state_wise_news) {
                                    $first_news = array_shift($state_wise_news);
                                ?>
                                    <div class="row mt-3">

                                        <div class="col-md-6">
                                            <a href="news.php?id=<?php echo $first_news->id ?>">
                                                <?php
                                                if ($first_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $first_news->image)) {
                                                ?>
                                                    <img src="<?php echo UPLOAD_URL . '/news/' . $first_news->image ?>" style="width: 100%; height: auto;">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="<?php echo IMAGES_URL . '/logo.png' ?>" style="width: 100%; height: auto;">
                                                <?php
                                                }
                                                ?>
                                                <h1 class="nagdunga"><?php echo $first_news->title; ?></h1>
                                            </a>
                                            <p><?php echo date('j F') ?>, <?php echo $first_news->location; ?> । <?php echo $first_news->summary ?>...</p>
                                        </div>





                                        <div class="col-md-6">
                                            <div class="row">
                                                <?php
                                                if ($state_wise_news) {
                                                    foreach ($state_wise_news as $news_state) {
                                                ?>
                                                        <div class="col-6">
                                                            <a href="news.php?id=<?php echo $news_state->id; ?>">
                                                                <?php
                                                                if ($news_state->image != null && file_exists(UPLOAD_DIR . '/news/' . $news_state->image)) {
                                                                ?>
                                                                    <img src="<?php echo UPLOAD_URL . '/news/' . $news_state->image ?>" style="width: 100%; height: auto;">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo IMAGES_URL . '/logo.png' ?>" style="width: 100%; height: auto;">
                                                                <?php
                                                                }
                                                                ?>

                                                                <p style="padding-top: 20px; font-weight: 400; font-size: 16px;">
                                                                    <?php echo $news_state->title; ?>
                                                                </p>
                                                            </a>

                                                        </div>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                <?php
                                } else {
                                    echo "No news found.";
                                }

                                ?>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </nav>


            </div>

            <div class="col-md-3">
                <nav class="navbar navbar-light bg-primary" style="border-radius: 20px;">
                    <a class="navbar-brand" href="#">Trending</a>
                </nav>

                <?php
                $trending = $news->getTrendingNews();
                if ($trending) {
                    foreach ($trending as $key => $trends) {
                ?>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <span style="text-align: center; font-weight: bold;"><?php echo $key + 1 ?>.</span>
                            </div>
                            <div class="col-md-10">
                                <p class="trends"><a href="news.php?id=<?php echo $trends->id ?>"><?php echo $trends->title ?></a></p>
                            </div>
                        </div>
                        <hr>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>
<!-- देश Closed -->

<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="css-nav">
                <li><a href="category.php?id=2">राजनीति</a></li>
            </ul>
            <?php
            $remaining_featured = $news->getNewsByCatId(2, 0, 5);
            if ($remaining_featured) {
                $first_elem = array_shift($remaining_featured);

            ?>
                <div class="listing">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card" style="width: 100%; height: auto; border:1px solid #e8edf4;  box-shadow: 5px 5px 10px 10px #888888;">
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $first_elem->image ?>" class="card-img-top" alt="..." style="width: 100%;height: 450px;object-fit: cover;transition: all .4s ease;">
                                    <div class="card-body">
                                        <p class="card-text1">
                                            <a href="news.php?id=<?php echo $first_elem->id; ?>">
                                                <?php echo $first_elem->title; ?>
                                            </a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">

                                <?php
                                if ($remaining_featured) {
                                    foreach ($remaining_featured as $left_news) {
                                ?>
                                        <div class="row mt-3">
                                            <?php
                                            if ($left_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $left_news->image)) {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" alt="<?php echo $featured_news->title ?>" style="max-width: 200px;">
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo IMAGES_URL . '/logo.png' ?>" alt="<?php echo $featured_news->title ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-5">
                                                <p style="font-weight: 600; font-size: 1em;" class="list11">
                                                    <a href="news.php?id=<?php echo $left_news->id; ?>"><?php echo $left_news->title; ?></a></p>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <?php
        $news_cat_news = $news->getNewsByCatId(7, 0, 1);
        if ($news_cat_news) {
        ?>
            <!-- Listing_paage -->
            <div class="title_news">
                <div class="container">
                    <ul class="css-nav">
                        <li><a href="category.php?id=7">अन्तरास्ट्रिय</a></li>
                    </ul>

                    <div class="row">
                        <div class="col-12">
                            <h1 class="title_news1">
                                <a href="news.php?id=<?php echo $news_cat_news[0]->id; ?>"><?php echo $news_cat_news[0]->title; ?></a>
                            </h1>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <a href="news.php?id=<?php echo $news_cat_news[0]->id ?>">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $news_cat_news[0]->image; ?>" style="height: auto; width: 100%;">
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <p style="font-size: 1.2em; font-weight: 450;"><?php echo $news_cat_news[0]->summary ?></p>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    $top_1 = $ads->getAdsByPosition('home3');
                                    if ($top_1) {
                                    ?>
                                        <div class="info">
                                            <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                                <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                            </a>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <?php
                        $news_row = $news->getNewsByCatId(7, 1, 4);
                        if ($news_row) {
                            foreach ($news_row as $row_news) {
                        ?>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="<?php echo UPLOAD_URL . '/news/' . $row_news->image; ?>" alt="" style="width: 100%; height: 150px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="three_nepali">
                                                <a href="news.php?id=<?php echo $row_news->id; ?>">
                                                    <?php echo $row_news->title; ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>



                    </div>
                <?php } ?>
                </div>
            </div>

    </div>


</div>

<?php
$news_cat_news = $news->getNewsByCatId(5, 0, 1);
if ($news_cat_news) {
?>
    <!-- Listing_paage -->
    <div class="title_news">
        <div class="container">
            <ul class="css-nav">
                <li><a href="category.php?id=5">सूचना-प्रविधि</a></li>
            </ul>
            <div class="row">
                <div class="col-12">
                    <h1 class="title_news1">
                        <a href="news.php?id=<?php echo $news_cat_news[0]->id; ?>"><?php echo $news_cat_news[0]->title; ?></a>
                    </h1>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="news.php?id=<?php echo $news_cat_news[0]->id ?>">
                                <img src="<?php echo UPLOAD_URL . '/news/' . $news_cat_news[0]->image; ?>" style="height: auto; width: 100%;">
                            </a>
                        </div>
                        <div class="col-md-3">
                            <p style="font-size: 1.2em; font-weight: 450;"><?php echo $news_cat_news[0]->summary ?></p>
                        </div>
                        <div class="col-md-3">
                            <?php
                            $top_1 = $ads->getAdsByPosition('home3');
                            if ($top_1) {
                            ?>
                                <div class="info">
                                    <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                        <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                    </a>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-3">
                <?php
                $news_row = $news->getNewsByCatId(5, 1, 3);
                if ($news_row) {
                    foreach ($news_row as $row_news) {
                ?>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $row_news->image; ?>" alt="" style="width: 100%; height: 150px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="three_nepali">
                                        <a href="news.php?id=<?php echo $row_news->id; ?>">
                                            <?php echo $row_news->title; ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <div class="col-md-3">
                    <div class="row">
                        <?php
                        $top_1 = $ads->getAdsByPosition('home4');
                        if ($top_1) {
                        ?>
                            <div class="info">
                                <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                    <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                </a>
                            </div>

                        <?php
                        }

                        ?>
                    </div>
                </div>


            </div>

            <div class="row mt-3">
                <div class="row mt-3">
                    <div class="col-md-5">
                        <?php
                        $left_side = $news->getNewsByCatId(5, 4, 5);
                        if ($left_side) {
                            foreach ($left_side as $left_news) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $left_news->id; ?>">
                                                <?php echo $left_news->title; ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="col-md-5">
                        <?php
                        $right_side = $news->getNewsByCatId(5, 9, 5);
                        if ($right_side) {
                            foreach ($right_side as $news_right) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $news_right->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $news_right->id ?>">
                                                <?php echo $news_right->title ?>
                                            </a>
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
        </div>
    </div>
    <!-- ListingPage closed -->

<?php
}
?>

<!-- Listing_paage -->

<!-- ListingPage closed -->

<!-- Video Open -->
<?php
$video = new Video;
$all_videos = $video->getAllVideos(1, 0);
//debug($all_videos);


?>
<div class="Video">
    <div class="container">
        <nav class="navbar navbar-light bg-dark" style="border-radius: 20px; margin-top: 10px;">
            <a class="navbar-brand" href="video.php">भिडियो</a>
        </nav>
        <div class="row mt-3 pt-2" style="padding-bottom: 10px;">
            <div class="col-md-9 col-sm-12">
                <iframe width="100%;" height="550px" src="https://www.youtube.com/embed/<?php echo $all_videos[0]->video_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-3 col-sm-12">
                <?php
                $remaining_video = $video->getAllVideos(3, 1);

                // debug($remaining_video,true);
                if ($remaining_video) {
                    foreach ($remaining_video as $side_videos) {
                ?>
                        <div class="row">
                            <div class="col-md-12"><iframe width="100%" height="auto" src="https://www.youtube.com/embed/<?php echo $side_videos->video_id ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                        </div>
                <?php
                    }
                }
                ?>


            </div>
        </div>
    </div>
</div>
<!-- Video Closed -->



<div class="container">
    <div class="row">
        <ul class="css-nav">
            <li><a href="category.php?id=9">अन्तरबार्ता</a></li>
        </ul>
        <div class="col-12">
            <div class="row mt-3">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <?php
                        $left_side = $news->getNewsByCatId(9, 0, 5);
                        if ($left_side) {
                            foreach ($left_side as $left_news) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $left_news->id; ?>">
                                                <?php echo $left_news->title; ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="col-md-4">
                        <?php
                        $right_side = $news->getNewsByCatId(9, 4, 5);
                        if ($right_side) {
                            foreach ($right_side as $news_right) {
                        ?>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <img src="<?php echo UPLOAD_URL . '/news/' . $news_right->image ?>" style="width: 100%; height: auto;  border:1px solid #e8edf4;">
                                    </div>
                                    <div class="col-md-5">
                                        <p style="font-weight: 600; font-size: 1em;" class="list11">
                                            <a href="news.php?id=<?php echo $news_right->id ?>">
                                                <?php echo $news_right->title ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-4">
                        <div class="row-mt-5">

                            <?php
                            $top_1 = $ads->getAdsByPosition('home3');
                            if ($top_1) {
                            ?>
                                <div class="info">
                                    <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                        <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                    </a>
                                </div>

                            <?php
                            }

                            ?>
                        </div>

                        <div class="row-mt-5">

                            <?php
                            $top_1 = $ads->getAdsByPosition('home1');
                            if ($top_1) {
                            ?>
                                <div class="info">
                                    <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                        <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                    </a>
                                </div>

                            <?php
                            }

                            ?>
                        </div>
                    </div>

                </div>
                <div class="row-mt-5">
                    <div class="col-md-12">
                        <?php
                        $top_1 = $ads->getAdsByPosition('detail1');
                        if ($top_1) {
                        ?>
                            <div class="info">
                                <a target="_ads" href="<?php echo $top_1[0]->link; ?>">
                                    <img src="<?php echo UPLOAD_URL . '/ads/' . $top_1[0]->image ?>" style="width: 100%;" alt="gif">
                                </a>
                            </div>

                        <?php
                        }

                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="css-nav">
                <li><a href="category.php?id=8">खेलकुद</a></li>
            </ul>
            <?php
            $remaining_featured = $news->getNewsByCatId(8, 0, 5);
            if ($remaining_featured) {
                $first_elem = array_shift($remaining_featured);

            ?>
                <div class="listing">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card" style="width: 100%; height: auto; border:1px solid #e8edf4;  box-shadow: 5px 5px 10px 10px #888888;">
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $first_elem->image ?>" class="card-img-top" alt="..." style="width: 100%;height: 450px;object-fit: cover;transition: all .4s ease;">
                                    <div class="card-body">
                                        <p class="card-text1">
                                            <a href="news.php?id=<?php echo $first_elem->id; ?>">
                                                <?php echo $first_elem->title; ?>
                                            </a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">

                                <?php
                                if ($remaining_featured) {
                                    foreach ($remaining_featured as $left_news) {
                                ?>
                                        <div class="row mt-3">
                                            <?php
                                            if ($left_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $left_news->image)) {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" alt="<?php echo $featured_news->title ?>" style="max-width: 200px;">
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo IMAGES_URL . '/logo.png' ?>" alt="<?php echo $featured_news->title ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-5">
                                                <p style="font-weight: 600; font-size: 1em;" class="list11">
                                                    <a href="news.php?id=<?php echo $left_news->id; ?>"><?php echo $left_news->title; ?></a></p>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Listing_paage -->
            <div class="title_news">
                <div class="container">
                    <ul class="css-nav">
                        <li><a href="gallery.php">Image Gallery</a></li>
                    </ul>

                    <div class="row">
                        <?php
                            $gallery =new Gallery();
                            $all_gallery = $gallery->getAllGallery(5,0);
                            //debug($all_gallery,true);
                            if ($all_gallery) {
                                foreach ($all_gallery as $gallery_data) {
                        ?>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="gallery-detail.php?id=<?php echo $gallery_data->id; ?>">
                                            <?php
                                                    if ($gallery_data->image != null && file_exists(UPLOAD_DIR . '/gallery/' . $gallery_data->image)) {
                                                    ?>
                                                        <img src="<?php echo UPLOAD_URL . '/gallery/' . $gallery_data->image ?>" style="width: 100%; height: auto;">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="<?php echo IMAGES_URL . '/logo.png' ?>" style="width: 100%; height: auto;">
                                                    <?php
                                                    }
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="three_nepali">
                                                <a href="gallery-detail.php?id=<?php echo $gallery_data->id; ?>">
                                                    <?php echo $gallery_data->title; ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        
                        ?>



                    </div>
                <?php } ?>
                </div>
            </div>

    </div>


</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="css-nav">
                <li><a href="category.php?id=8">पर्यटन</a></li>
            </ul>
            <?php
            $remaining_featured = $news->getNewsByCatId(10, 0, 5);
            if ($remaining_featured) {
                $first_elem = array_shift($remaining_featured);

            ?>
                <div class="listing">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="card" style="width: 100%; height: auto; border:1px solid #e8edf4;  box-shadow: 5px 5px 10px 10px #888888;">
                                    <img src="<?php echo UPLOAD_URL . '/news/' . $first_elem->image ?>" class="card-img-top" alt="..." style="width: 100%;height: 450px;object-fit: cover;transition: all .4s ease;">
                                    <div class="card-body">
                                        <p class="card-text1">
                                            <a href="news.php?id=<?php echo $first_elem->id; ?>">
                                                <?php echo $first_elem->title; ?>
                                            </a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">

                                <?php
                                if ($remaining_featured) {
                                    foreach ($remaining_featured as $left_news) {
                                ?>
                                        <div class="row mt-3">
                                            <?php
                                            if ($left_news->image != null && file_exists(UPLOAD_DIR . '/news/' . $left_news->image)) {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo UPLOAD_URL . '/news/' . $left_news->image ?>" alt="<?php echo $featured_news->title ?>" style="max-width: 200px;">
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-5">
                                                    <img class="img img-fluid img-thumbnail" src="<?php echo IMAGES_URL . '/logo.png' ?>" alt="<?php echo $featured_news->title ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-5">
                                                <p style="font-weight: 600; font-size: 1em;" class="list11">
                                                    <a href="news.php?id=<?php echo $left_news->id; ?>"><?php echo $left_news->title; ?></a></p>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>