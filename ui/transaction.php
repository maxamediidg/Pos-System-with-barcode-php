<?php

include_once'connectdb.php';
session_start();


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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<hr />

            <div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h2>Transaction  With Payments</h2>
      <p class="card-description"> Star-mall <code>by Online 💵💴</code>
      </p>
      <div class="table-responsive">
        <table id="table_payments" class="table table-striped table-hover">
          <thead class="bg-primary text-white">
            <tr>
              <th> # </th>
              <th> Username </th>
              <th> Number by Credit Card </th>
              <th> Amount </th>
              <th> Date Modify </th>
            </tr>
          </thead>
          <tbody>
            <?php

            $select = $pdo->prepare("select * from payments order by id ASC");
            $select->execute();

            while ($row = $select->fetch(PDO::FETCH_OBJ)) {
              echo '
<tr>
<td> ' . $row->id . '</td>
<td> ' . $row->username . '</td> 
<td> ' . $row->card_number . '</td>
<td> ' . $row->price . '</td>
<td> ' . $row->timestamp . '</td>

</tr>';
            }

            ?>
          </tbody>
          <tfoot class="table-info">
                    <tr>
                      <td>ID</td>
                      <td>Username</td>
                      <td>card_number</td>
                      <td>price</td>
                      <td>Date of Admission</td>
                    </tr>

                  </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="col-lg-12 stretch-card">
  <div class="card">
    <div class="card-body">
      <h2 >Transaction  With Orders</h2>
      <p class="card-description"> Star-mall <code>by Online 💴💵</code>
      </p>
      <div class="table-responsive">
        <table  id="table_order" class="table table-bordered table-contextual table-hover">
          <thead class="bg-info text-dark">
          <tr>
              <th> #ID</th>
              <th>name</th>
              <th>l.name</th>
              <th>email</th>
              <th>country</th>
              <th>Status</th>
              <th>price In USD  </th>
              <th>Date_Modify</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
          <?php

$select = $pdo->prepare("select * from orders order by id ASC");
$select->execute();

while ($row = $select->fetch(PDO::FETCH_OBJ)) {
  echo '
<tr>
<td> ' . $row->id . '</td>
<td> ' . $row->name . '</td>
<td> ' . $row->lname . '</td>
<td> ' . $row->email . '</td>
<td> ' . $row->country . '</td>
<td> ' . $row->status . '</td>
<td> ' . $row->price . '</td>
<td> ' . $row->created_at . '</td>
<td>
  <a href="employeeDetails.php?id='.$row->id.'" class="btn btn-warning mx-2">
 <i class="bi-bi-pencil-square"></i>Update</a>
</td>
</tr>';
}

?>

          </tbody>
          <tfoot class="table-info">
                    <tr>
                      <td>ID</td>
                      <td>name</td>
                      <td>l.name</td>
                      <td>email</td>
                      <td>country</td>
                      <td>address</td>
                      <td>price</td>
                      <td>Date of Admission</td>
                      <td>Actions</td>

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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php

include_once("footer.php");

?>

<script>
    $(document).ready(function() {
        $('#table_payments').DataTable();
    });
</script>


<script>
    $(document).ready(function() {
        $('#table_order').DataTable();
    });
</script>