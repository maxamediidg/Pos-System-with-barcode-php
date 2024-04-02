
<?php
include "connectdb.php";
session_start();
include_once("header.php");
include_once "barcode/barcode128.php";

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barcode128 Dashboard</h1>
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
              <a href="productlist.php" class="btn btn-warning"><span class="report-count"> View Product</span></a>
              </div>
              <div class="card-body">


                <?php

$select = $pdo->prepare("select * from tbl_product order by pid ASC");
$select->execute();

while ($row = $select->fetch(PDO::FETCH_OBJ)) {
  echo '
<tr>




<td>
<td> ' . $row->barcode . '</td>
<td> ' . $row->product . '</td>



<li  class="list-group-item d-flex justify-content-between align-items-start"><b></b> <span class="badge badge-warning  ">'.bar128($row->barcode).'</span></li>


</td>



</tr>';
}

?>

</tbody>
</table>
</div>
   </             </div>
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