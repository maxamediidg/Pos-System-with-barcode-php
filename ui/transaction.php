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
      <h4 class="card-title">Transaction  With Payments</h4>
      <p class="card-description"> Add class <code>.table-striped</code>
      </p>
      <div class="table-responsive">
        <table class="table table-striped">
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
        </table>
      </div>
    </div>
  </div>
</div>


<div class="col-lg-12 stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Transaction  With Orders</h4>
      <p class="card-description"> Add class <code>.table-{color}</code>
      </p>
      <div class="table-responsive">
        <table class="table table-bordered table-contextual">
          <thead>
          <tr class="table-danger">
              <th> # ID </th>
              <th>name </th>
              <th>l.Name </th>
              <th>email </th>
              <th>country </th>
              <th>city </th>
              <th>address </th>
              <th>phone_number </th>
              <th>price  </th>
              <th>Date Created at </th>

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
<td> ' . $row->city . '</td>
<td> ' . $row->address . '</td>
<td> ' . $row->phone_number . '</td>
<td> ' . $row->price . '</td>
<td> ' . $row->created_at . '</td>

</tr>';
}

?>

          </tbody>
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
