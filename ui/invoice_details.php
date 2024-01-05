
<?php
include "connectdb.php";
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
            <h1 class="m-0">INVOICE DETAILS</h1>
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
              <a href="dashboard.php" class="btn btn-info"><span class="report-count">Back Dashboard</span></a>
              </div>
              <div class="card-body">
              
              <div class="row">
                
      <div class="col-lg-12">
      <table  id="table_invoice"  class="datatable table table-bordered table-striped">
                <thead class="bg-secondary text-white">
                    <tr>
                       <th> Id</th>
                       <th>incoice id</th>
                       <th>Barcode</th>
                       <th>product ID</th>
                       <th>Product Name</th>
                       <th>Qty</th>
                       <th>Rate</th>
                       <th>Total</th>
                       <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>

                  <?php 
                    

                    $select = $pdo->prepare("select * from tbl_invoice_details order by invoice_id ASC");
                    $select->execute();;
                    while($row_tbl_invoice = $select->fetch(PDO::FETCH_OBJ)){
                      echo "<tr>";
                        echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-dark'>{$row_tbl_invoice->id}</td>";
                        echo "<td>{$row_tbl_invoice->invoice_id}</td>";
                        echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-primary'>{$row_tbl_invoice->barcode}</td>";
                        echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-warning'>{$row_tbl_invoice->product_id}</td>";
                        echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-success'>{$row_tbl_invoice->product_name}</td>";
                        echo "<td>{$row_tbl_invoice->qty}</td>";
                        echo "<td  style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-danger'>{$row_tbl_invoice->rate}</td>";
                        echo "<td>{$row_tbl_invoice->saleprice}</td>";
                        echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-info'>{$row_tbl_invoice->order_date}</td>";
                      echo "</tr>";
                    }
                  ?>
                   

                </tbody>
                <tfoot>
                    <tr>
                       <th> Id</th>
                       <th>Invoice ID</th>
                       <th>Barcode</th>
                       <th>product ID</th>
                       <th>Product Name</th>
                       <th>Qty</th>
                       <th>Rate</th>
                       <th>Saleprice</th>
                       <th>Order Date</th>
                    </tr>
                </tfoot>
            </table>
      </div>
      </div>
    </div>
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
 
  <!-- /.content-wrapper -->

  
  <?php

include_once("footer.php");


?>

<script>
  $(document).ready(function() {
    $('#table_invoice').DataTable();
  });
</script>
