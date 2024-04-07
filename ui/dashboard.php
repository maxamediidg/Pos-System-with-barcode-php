<?php

include_once 'connectdb.php';
session_start();

if ($_SESSION['useremail'] == "") {
  header('location: index.php');
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
                          $sql1 = "SELECT * from  tbl_category";
                          $query1 = $pdo->prepare($sql1);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $totclass = $query1->rowCount();
                          ?>
                          <span class="report-title">Total Category</span>
                          <h4><?php echo htmlentities($totclass); ?></h4>
                          <a href="category.php" class="btn btn-warning"><span class="report-count"> View Category</span></a>
                        </div>

                        <div class="icon">
                          <i class="ion ion-bag"></i>
                        </div>
                        <a href="category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">

                          <?php
                          $sql1 = "SELECT * from  tbl_product";
                          $query1 = $pdo->prepare($sql1);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $totclass = $query1->rowCount();
                          ?>
                          <span class="report-title">Total Products</span>
                          <h4><?php echo htmlentities($totclass); ?></h4>
                          <a href="productlist.php" class="btn btn-outline-warning"><span class="report-count"> View Product</span></a>


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
                          $sql1 = "SELECT * from  tbl_invoice";
                          $query1 = $pdo->prepare($sql1);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $totclass = $query1->rowCount();
                          ?>
                          <span class="report-title">Total Invoice</span>
                          <h4><?php echo htmlentities($totclass); ?></h4>
                          <a href="orderlist.php" class="btn btn-success"><span class="report-count"> View Invoice</span></a>


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
                      <div class="small-box bg-danger">
                        <div class="inner">
                          <?php
                          $sql1 = "SELECT * from  tbl_invoice_details";
                          $query1 = $pdo->prepare($sql1);
                          $query1->execute();
                          $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                          $totclass = $query1->rowCount();
                          ?>
                          <span class="report-title">Total Invoice Detail</span>
                          <h4><?php echo htmlentities($totclass); ?></h4>
                          <a href="invoice_details.php" class="btn btn-warning"><span class="report-count"> View Invoice</span></a>

                        </div>
                        <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>

                  <!-- /.info-box -->
                </div>

                <!-- /.col -->
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

        </div>
      </div>



      <br />
      <br />
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="m-0">Best Selling Product</h5>
        </div>

        <div class="row">

          <div class="col-md-5">
            <table class="datatable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Product Id</th>
                  <th>Product Name</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>

                <?php


                $select = $pdo->prepare("select * from tbl_invoice_details order by invoice_id DESC limit 10");
                $select->execute();;
                while ($row_tbl_invoice = $select->fetch(PDO::FETCH_OBJ)) {
                  echo "<tr>";
                  echo "<td>{$row_tbl_invoice->product_id}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-secondary'>{$row_tbl_invoice->product_name}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-success'>{$row_tbl_invoice->qty}</td>";
                  echo "<td  style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-primary'>{$row_tbl_invoice->rate}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-danger'>{$row_tbl_invoice->saleprice}</td>";
                  echo "</tr>";
                }
                ?>


              </tbody>
              <tfoot>
                <tr>
                  <th>product ID</th>
                  <th>product Name</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Total</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="col-lg-7">
            <div class="card-header">
              <h5 class="m-0">Earning by Date</h5>
            </div>
            <table id="table_invoice_list" class="datatable table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>Customer</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>Paymenty Type</th>
                </tr>
              </thead>
              <tbody>

                <?php


                $select = $pdo->prepare("select * from tbl_invoice order by invoice_id ASC");
                $select->execute();
                while ($row_tbl_invoice = $select->fetch(PDO::FETCH_OBJ)) {
                  echo "<tr>";
                  echo "<td>{$row_tbl_invoice->invoice_id}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-warning'>{$row_tbl_invoice->customer_name}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-secondary'>{$row_tbl_invoice->order_date}</td>";
                  echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-info'>{$row_tbl_invoice->total}</td>";
                  if ($row_tbl_invoice->payment_type == "Cash") {
                    echo '<td><span class="badge badge-warning">' . $row_tbl_invoice->payment_type . '</span></td>';
                  } else if ($row_tbl_invoice->payment_type == "Card") {
                    echo '<td><span class="badge badge-success">' . $row_tbl_invoice->payment_type . '</span></td>';
                  } else {
                    echo '<td><span class="badge badge-danger">' . $row_tbl_invoice->payment_type . '</span></td>';
                  }
                  echo "</tr>";
                }
                ?>


              </tbody>
              <tfoot>
                <tr>
                  <th>Invoice ID</th>
                  <th>Order Date</th>
                  <th>Total</th>
                  <th>Paymenty TYpe</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <br />
 
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
    $('#table_invoice_list').DataTable();
  });
</script>