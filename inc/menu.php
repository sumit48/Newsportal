<!--Top_Head-->
<div class="top_head">
    <div class="container">
        <div class="row">
        <div class="col-12">
        <?php 
                $ads = new Advertisement;
                $top_1 = $ads->getAdsByPosition('home6');
                if($top_1){
                    ?>
                        <div class="info">
                            <a target="_ads" href="<?php echo $top_1[0]->link;?>">
                                <img src="<?php echo UPLOAD_URL.'/ads/'.$top_1[0]->image?>" style="width: 100%;" alt="gif">
                            </a>
                        </div>
                    
                    <?php
                }
            
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="logo_holder">
                    <a href="./">
                        <img src="<?php echo IMAGES_URL.'/newslogo2.png'?>">
                    </a>
                </div>
                <div class="date_note">
                    
                <?php 
                    $nep = new NepaliCalendar;
                    $today = date("Y-m-d"); // 2020-02-07
                    list($year, $month, $day) = explode("-", $today);
                    $nepl_date = $nep->eng_to_nep($year,$month,$day);
                    echo $nepl_date['date']." ".$nepl_date['nmonth']." ".$nepl_date['year'].", ".$nepl_date['day'];
                ?>
                </div>
            </div>
            
            <?php 
                $ads = new Advertisement;
                $top_1 = $ads->getAdsByPosition('home2');
                if($top_1){
                    ?>
                    <div class="col-md-6">
                        <div class="info">
                            <img src="<?php echo UPLOAD_URL.'/ads/'.$top_1[0]->image?>" style="width: 100%;" alt="gif">
                        </div>
                    </div>

                    <?php
                }
            
            ?>
        </div>
    </div>
</div>
<!--Top_head end-->



<!-- NavBar-Open -->

<nav class="navbar navbar-expand-lg navbar-light bg-primary menu sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="./">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                
                <?php 
                    $category = new Category;
                    $all_cats = $category->getMenuItems();

                    if($all_cats){
                        foreach($all_cats as $cats_individual){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="category.php?id=<?php echo $cats_individual->id ?>">
                                    <?php echo $cats_individual->title?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                
                ?>
                
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="search.php" class="form">
                    <input type="search" placeholder="Search..." name="q" value="<?php echo @$_GET['q'];?>" class="form-control form-control-sm">
                </form>
            </div>
        </div>
    </div>
   
    

</nav>
<!-- NavBar-closed -->
