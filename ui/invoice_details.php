
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
     <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="m-0">Invoice Details product and qty Earning</h5>
        </div>
        <div class="row">
          <div class="col-lg-6">
                        
          <?php
// Connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'pos_barcode_db';

$pdo = new mysqli($db_host, $db_user, $db_pass, $db_name);


// Fetch data from the database
$result = $pdo->query("SELECT product_name,saleprice FROM tbl_invoice_details ");

// Convert data to JSON format
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$pdo->close();
?>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="col-lg-12">
    <div style="width: 65%; margin: auto;">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        // Pass PHP data to JavaScript
        var data = <?php echo json_encode($data); ?>;

        // Create a pie chart using Chart.js
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.map(item => item.product_name),
                datasets: [{
                    data: data.map(item => item.saleprice),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                    ],
                }],
            },
        });
    </script>


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
