<?php require_once '../config/init.php';?>
<?php
$_title = "Dashboard || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';

require 'inc/admin.php';

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
                    User List
                    <a href="user-form.php" class="btn btn-sm btn-success float-right">
                        <i class="fa fa-plus"></i> Add User
                    </a>
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-hover">
                            <thead class="thead-dark">
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $user = new User;
                                    $all_users = $user->getAllUser();
                                    if($all_users){
                                        foreach($all_users as $key => $user_data){
                                            ?>
                                            <tr>
                                                <td><?php echo $key+1?></td>
                                                <td><?php echo $user_data->full_name?></td>
                                                <td>
                                                    <?php echo $user_data->email;?>
                                                </td>
                                                <td><?php echo $user_data->role; ?></td>
                                                <td>
                                                    <span class="badge badge-<?php echo ($user_data->status == 'active' ? 'success' : 'danger')?>">
                                                    <?php echo $user_data->status == 'active' ? 'Publish' : 'Unpublish'?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="user-form.php?id=<?php echo $user_data->id;?>" class="btn btn-sm btn-success" style="border-radius: 50%">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <?php 
                                                        $_token = substr(md5("del-cat-".$user_data->id."-".$_SESSION['token']), 3, 15);
                                                    ?>
                                                    <a href="process/user.php?id=<?php echo $user_data->id?>&amp;token=<?php echo $_token;?>" onclick="return confirm('Are you sure you want to delete this User?')" class="btn btn-sm btn-danger" style="border-radius: 50%">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                    <a href="password-change.php?id=<?php echo $user_data->id?>" class="btn btn-primary btn-sm" style="border-radius: 50%">
                                                        <i class="fa fa-key"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5">No user found in the database.</td>
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