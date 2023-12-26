
<?php

include_once'connectdb.php';
session_start();

if($_SESSION['useremail']==""){
    header('location:../index.php');
}

include_once "header.php";

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
                <h5 class="m-0">REPORT SUMMERY</h5>
              </div>
              <div class="card-body">


              <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php 
                        $sql1 ="SELECT * from  tbl_category";
$query1 = $pdo -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totclass=$query1->rowCount();
?>
                          <span class="report-title">Total Category</span>
                          <h4><?php echo htmlentities($totclass);?></h4>
                          <a href="category.php" class="btn btn-light"><span class="report-count"> View Category</span></a>
              </div>
              
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
  
              <?php 
                        $sql1 ="SELECT * from  tbl_product";
$query1 = $pdo -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totclass=$query1->rowCount();
?>
                          <span class="report-title">Total Products</span>
                          <h4><?php echo htmlentities($totclass);?></h4>
                          <a href="productlist.php" class="btn btn-light"><span class="report-count"> View Product</span></a>


              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              
              <?php 
                        $sql1 ="SELECT * from  tbl_invoice";
$query1 = $pdo -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totclass=$query1->rowCount();
?>
                          <span class="report-title">Total Orders</span>
                          <h4><?php echo htmlentities($totclass);?></h4>
                          <a href="orderlist.php" class="btn btn-light"><span class="report-count"> View Invoice</span></a>
              

              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                        $sql1 ="SELECT * from  tbl_invoice_details";
$query1 = $pdo -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totclass=$query1->rowCount();
?>
                          <span class="report-title">Total Invoice</span>
                          <h4><?php echo htmlentities($totclass);?></h4>
                          <a href="" class="btn btn-light"><span class="report-count"> View Invoice</span></a>
              
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
              <?php 
                        $sql1 ="SELECT * from  tbl_employee";
$query1 = $pdo -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totclass=$query1->rowCount();
?>
                          <span class="report-title">Total Employee</span>
                          <h4><?php echo htmlentities($totclass);?></h4>
                          <a href="employee.php" class="btn btn-info"><span class="report-count"> View Employee</span></a>
              
              </div>
              <!-- /.info-box-content -->
            </div>
            
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
        </div>

        
          
          <!-- ./col -->
        </div>
      
        <!-- /.row -->
        <!-- Main row -->
    


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