<?php require_once '../config/init.php'; ?>
<?php
$_title = "User Add Page || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
require_once 'inc/admin.php';
$user = new User;

$act = "add";

if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        redirect('./user.php','error',"Invalid User Id.");
    }

    $user_info = $user->getRowById($id);

    if(!$user_info){
        redirect('./user.php','error',"User has been already deleted or does not exists.");
    }
    $act = "Update";
}
?>
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
                    User <?php echo ucfirst($act);?> Form
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <form action="process/user.php" method="post" enctype="multipart/form-data" class="form">
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Full Name: </label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo @$user_info[0]->full_name?>" name="full_name" required id="full_name" placeholder="Enter User full_name..." class="form-control form-control-sm">
                                </div>
                            </div>


                            <?php 
                                if(!isset($user_info)){
                            ?>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Email: </label>
                                <div class="col-sm-9">
                                    <input type="email" value="<?php echo @$user_info[0]->email?>" name="email" required id="email" placeholder="Enter user email..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3">Password: </label>
                                <div class="col-sm-9">
                                    <input type="password"  name="password" required id="password" placeholder="Enter Password..." class="form-control form-control-sm">
                                </div>
                            </div>
                            <?php
                                }
                            ?>



                            <div class="form-group row">
                                <label for="" class="col-sm-3">Role: </label>
                                <div class="col-sm-9">
                                    <select name="role" id="role" required class="form-control form-control-sm">
                                        <option value="admin" <?php echo (isset($user_info) && $user_info[0]->role == 'admin') ? 'selected' : ''?>>Admin</option>
                                        <option value="reporter" <?php echo (isset($user_info) && $user_info[0]->role == 'reporter') ? 'selected' : ''?>>Reporter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-sm-3">Status: </label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" required class="form-control form-control-sm">
                                        <option value="active" <?php echo (isset($user_info) && $user_info[0]->status == 'active') ? 'selected' : ''?>>Active</option>
                                        <option value="inactive" <?php echo (isset($user_info) && $user_info[0]->status == 'inactive') ? 'selected' : ''?>>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                        <input type="hidden" name="id" value="<?php echo @$user_info[0]->id?>">
                                    <button class="btn btn-sm btn-danger" type="reset">
                                        <i class="fa fa-trash"></i> Reset
                                    </button>
                                    <button class="btn btn-sm btn-success" type="submit">
                                        <i class="fa fa-paper-plane"></i> Submit
                                    </button>
                                    
                                </div>
                            </div>
                        </form>
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