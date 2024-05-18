<?php

include_once 'connectdb.php';
session_start();


if ($_SESSION['useremail'] == "" or $_SESSION['role'] == "user") {
  header('location:../index.php');
}

if ($_SESSION['role'] == "Admin") {
  include_once "header.php";
} else {
  include_once "headeruser.php";
}


error_reporting(0);

$id = $_GET['id'];

if (isset($id)) {

  $delete = $pdo->prepare("delete from tbl_user where userid=" . $id);
  if ($delete->execute()) {

    $_SESSION['status'] = "Account deleted successfully";
    $_SESSION['status_code'] = "warning";
  } else {

    $_SESSION['status'] = "Account Is Not Deletd";
    $_SESSION['status_code'] = "warning";
  }
}



if (isset($_POST['btnsave'])) {

  $username = $_POST['txtname'];
  $useremail = $_POST['txtemail'];
  $userpassword = $_POST['txtpassword'];
  $userrole = $_POST['txtselect_option'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $zip_code = $_POST['zip_code'];
  $phone_number = $_POST['phone_number'];

  if (isset($_POST['txtemail'])) {
    $select = $pdo->prepare("select * from tbl_user where useremail='$useremail'");
    $select->execute();

    if ($select->rowCount() > 0) {

      $_SESSION['status'] = "Email already exists. Create Account from New Email";
      $_SESSION['status_code'] = "warning";
    } else {


      $insert = $pdo->prepare("insert into tbl_user(username,useremail,address,city,country,zip_code,phone_number,userpassword,role) 
      values(:name,:email,:address,:city,:country,:zip_code,:phone_number,:password,:role)");

      $insert->bindParam(':name', $username);
      $insert->bindParam(':email', $useremail);
      $insert->bindParam(':password', $userpassword);
      $insert->bindParam(':address', $address);
      $insert->bindParam(':city', $city);
      $insert->bindParam(':country', $country);
      $insert->bindParam(':zip_code', $zip_code);
      $insert->bindParam(':phone_number', $phone_number);
      $insert->bindParam(':role', $userrole);

      if ($insert->execute()) {

        $_SESSION['status'] = "insert successfully the user into database";
        $_SESSION['status_code'] = "success";
      } else {


        $_SESSION['status'] = "error inserting the user into the database";
        $_SESSION['status_code'] = "error";
      }
    }
  }
}






?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registration</h1>
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


      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="m-0">Registration</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <form action="" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter Name" name="txtname" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">email address</label>
                  <input type="email" class="form-control" placeholder="Enter email" name="txtemail" required>
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="txtpassword" required>
                </div>

                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control" name="txtselect_option" required>
                    <option value="" disabled selected>select Role</option>
                    <option>Admin</option>
                    <option>User</option>
                  </select>
                </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">
                <textarea class="form-control" name="address" placeholder="Address"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control" name="city" placeholder="Town / City" type="text">
              </div>
              <div class="form-group">
                <input class="form-control" name="country" placeholder="State / Country" type="text">
              </div>
              <div class="form-group">
                <input class="form-control" name="zip_code" placeholder="Postcode / Zip" type="text">
              </div>

              <div class="col">
                <input class="form-control" name="phone_number" placeholder="Phone Number" type="tel">
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary col-md-6" name="btnsave">Save</button>
                </div>
              </form>
            </div>
          </div>
          

<br />
          <div class="col-md-12">
            <table class="table table-striped table-hover">
              <thead class="bg-info text-white">
                <tr>
                  <td>#</td>
                  <td>Name</td>
                  <td>Email</td>
                  <td>password</td>
                  <th>address</th>
                  <td>City</td>
                  <td>Country</td>
                  <td>Zip Code</td>
                  <td>Phone Number</td>
                  <td>Role</td>
                  <td>Delete</td>
                </tr>
              </thead>

              <tbody>
                <?php

                $select = $pdo->prepare("select * from tbl_user order by userid ASC");
                $select->execute();

                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                  echo '
<tr>
<td> ' . $row->userid . '</td>
<td> ' . $row->username . '</td>
<td> ' . $row->useremail . '</td>
<td> ' . $row->userpassword . '</td>
<td> ' . $row->address . '</td>
<td> ' . $row->city . '</td>
<td> ' . $row->country . '</td>
<td> ' . $row->zip_code . '</td>
<td> ' . $row->phone_number . '</td>
<td> ' . $row->role . '</td>
<td>

<a href="registration.php?id=' . $row->userid . '" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>

</td>

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



</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php

include_once("footer.php");

?>


<?php
if (isset($_SESSION['status']) && $_SESSION['status'] !== '') {

?>
  <script>
    Swal.fire({
      icon: '<?php echo $_SESSION['status_code']; ?>',
      title: '<?php echo $_SESSION['status']; ?>'
    })
  </script>



<?php
  unset($_SESSION['status']);
}

?>