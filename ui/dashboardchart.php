<?php

include_once 'connectdb.php';
session_start();



include_once("header.php");
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
              <h5 class="m-0">charts</h5>
            </div>
            <div class="card-body">


              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">BEST CUSTOMER HIGHEST RATE</h5>
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
                    $result = $pdo->query("SELECT customer_name,total FROM tbl_invoice ");

                    // Convert data to JSON format
                    $data = [];
                    while ($row = $result->fetch_assoc()) {
                      $data[] = $row;
                    }

                    $pdo->close();
                    ?>


                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <div class="col-lg-12">
                      <div style="width: 75%; margin: auto;">
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
                            labels: data.map(item => item.customer_name),
                            datasets: [{
                              data: data.map(item => item.total),
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
                  <div class="col-lg-6">
                    <?php
                    // Connect to the database
                    $db_host = 'localhost';
                    $db_user = 'root';
                    $db_pass = '';
                    $db_name = 'pos_barcode_db';

                    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

                    if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                    }


                    // Fetch data from the database
                    $result = $conn->query("SELECT product,saleprice FROM tbl_product");

                    // Convert data to JSON format
                    $data = [];
                    while ($row = $result->fetch_assoc()) {
                      $data[] = $row;
                    }

                    $conn->close();
                    ?>
                    <div class="card-header">
                      <h5 class="m-0">HIGHEST Product SalePrice $$</h5>
                    </div>


                    <div style="width: 70%; margin: auto;">
                      <canvas id="donutChart"></canvas>
                    </div>

                    <script>
                      // Pass PHP data to JavaScript
                      var data = <?php echo json_encode($data); ?>;

                      // Create a donut chart using Chart.js
                      var ctx = document.getElementById('donutChart').getContext('2d');
                      var donutChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                          labels: data.map(item => item.product),
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
                        options: {
                          cutout: '80%', // Adjust the cutout percentage to create a donut chart
                        },
                      });
                    </script>


                  </div>
                </div>

              </div>
              <?php
              // Connect to the database
              $db_host = 'localhost';
              $db_user = 'root';
              $db_pass = '';
              $db_name = 'pos_barcode_db';

              $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }


              // Fetch data from the database
              $result = $conn->query("SELECT product,stock FROM tbl_product");

              // Convert data to JSON format
              $data = [];
              while ($row = $result->fetch_assoc()) {
                $data[] = $row;
              }

              $conn->close();
              ?>
              <div class="card-header">
                <h5 class="m-0">Highest and Lowest Product Quantity RATE</h5>
              </div>

              <!DOCTYPE html>
              <html lang="en">

              <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              </head>

              <body>
                <div style="width: 75%;  margin: auto;">
                  <canvas id="barChart"></canvas>
                </div>

                <script>
                  // Pass PHP data to JavaScript
                  var data = <?php echo json_encode($data); ?>;

                  // Create a bar chart using Chart.js
                  var ctx = document.getElementById('barChart').getContext('2d');
                  var barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: data.map(item => item.product),
                      datasets: [{
                        label: 'stock',
                        data: data.map(item => item.stock),
                        backgroundColor: ['rgba(255, 206, 86, 0.8)',
                          'rgba(75, 192, 192, 0.8)',
                          'rgba(240 50 50 / 75%)',

                        ],
                        borderWidth: 1,
                      }],
                    },
                    options: {
                      scales: {
                        x: {
                          title: {
                            display: true,
                            text: 'product Name',
                          },
                        },
                        y: {
                          title: {
                            display: true,
                            text: 'Value',
                          },
                        },
                      },
                    },
                  });
                </script>

                
              </body>

              </html>

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