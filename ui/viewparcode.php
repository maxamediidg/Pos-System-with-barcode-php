
<?php


include_once'connectdb.php';
session_start();

include_once "header.php";

include_once "barcode/barcode128.php";


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Admin Dashboard</h1> -->
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
          <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="m-0">View product</h5>
              </div>
              <div class="card-body">
              


  <?php
  $id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ)){

  echo '
  
  
 <div class="row">             
 <div class="col-md-6">
 
 <ul class="list-group">
 <center><p class="list-group-item list-group-item-info"><b>PRODUCT DETAILS</b></p></center>
 
   <li class="list-group-item"><b>Barcode</b> <span class="badge badge-light float-right ">'.bar128($row->barcode).'</span></li>
 

 </ul>
 
 </div>
 
 
  </div>

  
  ';
}

  
?>    




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