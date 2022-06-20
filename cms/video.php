<?php require_once '../config/init.php'; ?>
<?php
$_title = "Dashboard || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
?>
<link rel="stylesheet" href="<?php echo CMS_CSS_URL.'/jquery-dataTables.min.css';?>">
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
                    Video List
                    <a href="video-form.php" class="btn btn-sm btn-success float-right">
                        <i class="fa fa-plus"></i> Add Video
                    </a>
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-hover">
                            <thead class="thead-dark">
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Thumbnail</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $video = new Video;
                                    $all_videos = $video->selectAllrows();
                                    if($all_videos){
                                        foreach($all_videos as $key => $video_data){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1?></td>
                                                <td><?php echo $video_data->title?></td>
                                                <td>
                                                    <iframe width="200" height="150" src="https://www.youtube.com/embed/<?php echo $video_data->video_id;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                
                                                </td>
                                                <td>
                                                    <span class="badge badge-<?php echo ($video_data->status == 'active' ? 'success' : 'danger')?>">
                                                    <?php echo $video_data->status == 'active' ? 'Publish' : 'Unpublish'?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="video-form.php?id=<?php echo $video_data->id;?>" class="btn btn-sm btn-success" style="border-radius: 50%">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <?php 
                                                        $_token = substr(md5("del-cat-".$video_data->id."-".$_SESSION['token']), 3, 15);
                                                    ?>
                                                    <a href="process/video.php?id=<?php echo $video_data->id?>&amp;token=<?php echo $_token;?>" onclick="return confirm('Are you sure you want to delete this Video?')" class="btn btn-sm btn-danger" style="border-radius: 50%">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">No video found in the database.</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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
<script src="<?php echo CMS_JS_URL.'/jquery.dataTables.min.js'?>"></script>
<script>
    $('.table').DataTable();
</script>