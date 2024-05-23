<?php
include_once 'connectdb.php';
session_start();
include_once "header.php";

if (isset($_POST["btnDateFilter"])) {
    $fromdate = $_POST["datepicker_1"];
    $todate = $_POST["datepicker_2"];

    // Convert dates to the format required by SQL (YYYY-MM-DD)
    $fromdate = date("Y-m-d", strtotime($fromdate));
    $todate = date("Y-m-d", strtotime($todate));

    $sel_tbl_invoice_query = "SELECT * FROM `tbl_invoice` WHERE `order_date` BETWEEN :fromdate AND :todate";
    $sel_tbl_invoice = $pdo->prepare($sel_tbl_invoice_query);
    $sel_tbl_invoice->bindParam(":fromdate", $fromdate);
    $sel_tbl_invoice->bindParam(":todate", $todate);

    $get_box_query = "SELECT COUNT(invoice_id) AS `total_invoice`, SUM(total) AS `net_total`, SUM(subtotal) AS `sub_total` FROM `tbl_invoice` WHERE `order_date` BETWEEN :fromdate AND :todate";
    $get_box = $pdo->prepare($get_box_query);
    $get_box->bindParam(":fromdate", $fromdate);
    $get_box->bindParam(":todate", $todate);
} else {
    $sel_tbl_invoice_query = "SELECT * FROM `tbl_invoice`";
    $sel_tbl_invoice = $pdo->prepare($sel_tbl_invoice_query);

    $get_box_query = "SELECT COUNT(invoice_id) AS `total_invoice`, SUM(total) AS `net_total`, SUM(subtotal) AS `sub_total` FROM `tbl_invoice`";
    $get_box = $pdo->prepare($get_box_query);
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">       
                <div class="col-sm-6">
                    <h1 class="m-0">Sales report -> Table report</h1>
                </div>
                <a href="orderlist.php" class="btn btn-warning mr-4"><span class="report-count"> View Invoice</span></a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-warning card-outline">
                        <?php if (isset($_POST["btnDateFilter"])) { ?>
                            <h3 class="box-title"><?php echo "From " . $_POST["datepicker_1"] . " to " . $_POST["datepicker_2"] ?></h3>
                        <?php } else { ?>
                            <h3 class="box-title">All Sales Report</h3>
                        <?php } ?>
                        <div class="card-body">
                            <form action="" method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepicker pull-right" id="datepicker_1" name="datepicker_1" value="<?php if (isset($_POST["datepicker_1"])) { echo $_POST["datepicker_1"]; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepicker pull-right" id="datepicker_2" name="datepicker_2" value="<?php if (isset($_POST["datepicker_2"])) { echo $_POST["datepicker_2"]; } ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div align="center">
                                            <button type="submit" class="btn btn-success" name="btnDateFilter" value="Filter By Date">Filter By Date</button>
                                        </div>                  
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <br><br>
                        <div class="row">
                            <?php 
                            $get_box->execute();
                            $row_get_box = $get_box->fetch(PDO::FETCH_OBJ);
                            ?>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">TOTAL INVOICE</span>
                                        <span class="info-box-number"><?php echo number_format($row_get_box->total_invoice); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">SUB TOTAL</span>
                                        <span class="info-box-number"><?php echo number_format($row_get_box->sub_total); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-usd"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">GRAND TOTAL</span>
                                        <span class="info-box-number"><?php echo number_format($row_get_box->net_total); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div id="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="table_report" class="datatable table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order Date</th>
                                                <th>Customer</th>
                                                <th>Subtotal</th>
                                                <th>Discount</th>
                                                <th>SGST</th>
                                                <th>CGST</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Payment Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sel_tbl_invoice->execute();
                                            while ($row_tbl_invoice = $sel_tbl_invoice->fetch(PDO::FETCH_OBJ)) {
                                                echo "<tr>";
                                                echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-dark'>{$row_tbl_invoice->invoice_id}</td>";
                                                echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-success'>{$row_tbl_invoice->order_date}</td>";
                                                echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-info'>{$row_tbl_invoice->customer_name}</td>";
                                                echo "<td>{$row_tbl_invoice->subtotal}</td>";
                                                echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-warning'>{$row_tbl_invoice->discount}</td>";
                                                echo "<td>{$row_tbl_invoice->sgst}</td>";
                                                echo "<td>{$row_tbl_invoice->cgst}</td>";
                                                echo "<td style='text-align:left;vertical-align:middle; font-size:17px;'><span class='badge badge-danger'>{$row_tbl_invoice->total}</td>";
                                                echo "<td>{$row_tbl_invoice->paid}</td>";
                                                echo "<td>{$row_tbl_invoice->due}</td>";
                                                if ($row_tbl_invoice->payment_type == "Cash") {
                                                    echo '<td><span class="badge badge-warning">'.$row_tbl_invoice->payment_type.'</span></td>';
                                                } elseif ($row_tbl_invoice->payment_type == "Card") {
                                                    echo '<td><span class="badge badge-success">'.$row_tbl_invoice->payment_type.'</span></td>';
                                                } else {
                                                    echo '<td><span class="badge badge-danger">'.$row_tbl_invoice->payment_type.'</span></td>';
                                                }
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order Date</th>
                                                <th>Customer</th>
                                                <th>Subtotal</th>
                                                <th>Discount</th>
                                                <th>SGST</th>
                                                <th>CGST</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Payment Type</th>
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
</div>

<?php
include_once("footer.php");
?>

<script>
    $(document).ready(function() {
        $('#table_report').DataTable();
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
