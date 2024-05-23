<?php
include_once 'connectdb.php'; // Assuming this file contains the database connection code
session_start();
include_once "header.php";

// Fetch data from database based on date filter
if (isset($_POST["btnDateFilter"])) {
    $fromdate = $_POST["datepicker_1"];
    $todate = $_POST["datepicker_2"];
    $fromdate_timestamp = strtotime($fromdate);
    $todate_timestamp = strtotime($todate);

    $fromdate = date("Y-m-d", $fromdate_timestamp);
    $todate = date("Y-m-d", $todate_timestamp);

    $sel_tbl_invoice_query = "SELECT `order_date`, SUM(`total`) as `total` FROM `tbl_invoice` WHERE `order_date` BETWEEN :fromdate AND :todate GROUP BY `order_date`"; 
    $sel_tbl_invoice = $pdo->prepare($sel_tbl_invoice_query);
    $sel_tbl_invoice->bindParam(":fromdate", $fromdate);
    $sel_tbl_invoice->bindParam(":todate", $todate);
} else {
    $sel_tbl_invoice_query = "SELECT `order_date`, SUM(`total`) as `total` FROM `tbl_invoice` GROUP BY `order_date`"; 
    $sel_tbl_invoice = $pdo->prepare($sel_tbl_invoice_query);
}

// Check if the connection is successful
if (!$pdo) {
    die("Database connection failed.");
}

// Check if the query is executed successfully
if (!$sel_tbl_invoice) {
    die("Query execution failed.");
}

$sel_tbl_invoice->execute();
$data = [];
while ($row = $sel_tbl_invoice->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// // Debugging: Echo out the fetched data
// echo "<pre>";
// print_r($data);
// echo "</pre>";
// ?>

<!-- Remaining HTML code with Chart.js initialization -->



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
                <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-warning card-outline">
                                <div class="card-body">
                                    <form action="" method="POST" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control datepicker pull-right" id="datepicker_1" name="datepicker_1" value="<?php if(isset($_POST["datepicker_1"])){ echo $_POST["datepicker_1"]; } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control datepicker pull-right" id="datepicker_2" name="datepicker_2" value="<?php if(isset($_POST["datepicker_2"])){ echo $_POST["datepicker_2"]; } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div align="center">
                                                    <button type="submit" class="btn btn-success" name="btnDateFilter" value="Filter By Date">Filter By Date</button>
                                                </div>                  
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Canvas for Chart.js -->
                                    <canvas id="salesChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#datepicker_1").datepicker({
                format: 'mm/dd/yyyy'
            });
            $("#datepicker_2").datepicker({
                format: 'mm/dd/yyyy'
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('salesChart').getContext('2d');
            var chartData = <?php echo json_encode($data); ?>;
            var chartLabels = chartData.map(function(item) { return item.order_date; });
            var chartTotals = chartData.map(function(item) { return item.total; });

            var salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Sales Total',
                        data: chartTotals,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'll'
                            },
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Sales'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
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
