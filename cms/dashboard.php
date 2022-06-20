<?php require_once '../config/init.php'; ?>
<?php 
    $_title = "Dashboard || ".CMS_SITE_TITLE;
    require_once 'inc/header.php'; 
    require_once 'inc/checklogin.php';
?>  
  <!-- Page Wrapper -->
  <div id="wrapper">

   <?php require_once 'inc/sidebar.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php require_once 'inc/topnav.php';?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php flash(); ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard Page</h1>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php require_once 'inc/copy.php';?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
<?php require_once 'inc/logout-modal.php';?>
<?php require_once 'inc/footer.php';?>