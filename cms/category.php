<?php require_once '../config/init.php'; ?>
<?php
$_title = "Dashboard || " . CMS_SITE_TITLE;
require_once 'inc/header.php';
require_once 'inc/checklogin.php';
?>
<link rel="stylesheet" href="<?php echo CMS_CSS_URL.'/jquery-dataTables.min.css';?>">
<link rel="stylesheet" href="<?php echo CMS_CSS_URL.'/pace.css';?>">
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
                    Category List
                    <a href="category-form.php" class="btn btn-sm btn-success float-right">
                        <i class="fa fa-plus"></i> Add Category
                    </a>
                </h1>
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <table class="table table-sm table-hover">
                            <thead class="thead-dark">
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">
                                    </td>
                                </tr>
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

        $.ajax({
        url: "inc/api.php",
        type: "post",
        data: {
            'act': "get-cat-data"
        },
        success:function(response){
            if(typeof(response) != "object"){
                response = JSON.parse(response);
            }

            if(response.status){
                // data found
                var html_tbody = "";
                $.each(response.data, function(key, value){
                    html_tbody += "<tr>";
                    html_tbody += "<td>"+(key+1)+"</td>";
                    html_tbody += "<td>"+(value.title)+"</td>";
                    html_tbody += "<td>"+(value.summary)+"</td>";
                    html_tbody += "<td>";
                    html_tbody += "<span class='badge badge-"+(value.status == 'active' ?'success': 'danger')+"'>";
                    html_tbody += (value.status);
                    html_tbody += "</span></td>";
                    
                    html_tbody += "<td>";
                    html_tbody += "<a href='category-form.php?id="+value.id+"' class='btn btn-success' style='border-radius: 50%;'><i class='fa fa-edit'></i></a>";
                    html_tbody += "<a href='process/category.php?id="+value.id+"&token="+value.del_token+"' onclick='return confirm(\"Are you Sure you want to delete this category?\")' class='btn btn-danger' style='border-radius: 50%;'><i class='fa fa-trash'></i></a>";
                    html_tbody += "</td>";
                    html_tbody += "</tr>";
                });

                $('tbody').html(html_tbody);
                $('.table').DataTable();

            }
        }
    });

</script>

<script src="<?php echo CMS_JS_URL.'/pace.js'?>"></script>