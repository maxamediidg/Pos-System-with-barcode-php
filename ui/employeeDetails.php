
<?php

include "connectdb.php";
session_start();

include_once"header.php";

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
              
              <?php
  $id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_employee where id=$id");
$select->execute();

while($row=$select->fetch(PDO::FETCH_OBJ)){

  echo '
  
  
 <div class="row">              
 <div class="col-md-6">
 <ul class="list-group">
 <center><p class="list-group-item list-group-item-info"><b>Employee IMAGE</b></p></center>
 <image src="uploads/'.$row->photo.'" class="img-thumbnail"/>
 </ul>
 </div>

 <div class="col-md-6">
 
 <ul class="list-group">
 <center><p class="list-group-item list-group-item-info"><b>Employee DETAILS</b></p></center>
 
 <li class="list-group-item"><b>Employee ID</b> <span class="badge badge-warning float-right">'.$row->id.'</span></li>
 <li class="list-group-item"><b>Full Name</b> <span class="badge badge-warning float-right">'.$row->name.'</span></li>
   <li class="list-group-item"><b>Gmail</b> <span class="badge badge-success float-right">'.$row->email.'</span></li>
   <li class="list-group-item"><b>Contact Number</b> <span class="badge badge-primary float-right">'.$row->phone.'</span></li>
   <li class="list-group-item"><b>Date of Admission</b> <span class="badge badge-danger float-right">'.$row->joining_date.'</span></li>




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