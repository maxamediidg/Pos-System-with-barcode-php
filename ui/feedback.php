<?php

include_once 'connectdb.php';
session_start();

include_once 'header.php';
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Featured</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">some clients feedback</h6>

                            <div class="col-lg-12">

                                <h3 class="text-center text-info">Our Client Saying!</h3>



                                <table id="#table_client" class="table  table-hover">
                                    <thead class="bg-info text-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>fullname</th>
                                            <th>description</th>
                                            <th>profession/role</th>
                                            <th>Date of Admission</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $select = $pdo->prepare("select * from tbl_client order by id ASC");
                                        $select->execute();

                                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                                            echo '
<tr>
<td> ' . $row->id . '</td>
<td> ' . $row->fullname . '</td>
<td> ' . $row->description . '</td>
<td> ' . $row->role . '</td>
<td> ' . $row->created_at . '</td>
<td> <image src="../Design/UX/Feedback/' . $row->image . '" class="img-rounded" width="70px" height="45px/"></td>



</tr>';
                                        }

                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                </div>


            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php

include_once("footer.php");

?>
<script>
    $(document).ready(function() {
        $('#table_client').DataTable();
    });
</script>