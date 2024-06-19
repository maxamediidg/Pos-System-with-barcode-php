<?php

include_once'connectdb.php';
session_start();


include_once "header.php";



if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $order = $stmt->fetch(PDO::FETCH_OBJ);
}

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $created_at = $_POST['created_at'];
    
    $stmt = $pdo->prepare("UPDATE orders SET name = :name, lname = :lname, email = :email, country = :country, status = :status, price = :price, created_at = :created_at WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':lname' => $lname,
        ':email' => $email,
        ':country' => $country,
        ':status' => $status,
        ':price' => $price,
        ':created_at' => $created_at,
        ':id' => $id
    ]);
    header('Location:transaction.php'); // Redirect back to the dashboard
}
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
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">

            <div class="row">
                <div class="form-group">
                <form method="post">
        Name: <input type="text" name="name" value="<?php echo $order->name; ?>" required><br>
        Last Name: <input type="text" name="lname" value="<?php echo $order->lname; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $order->email; ?>" required><br>
        Country: <input type="text" name="country" value="<?php echo $order->country; ?>" required><br>
        Status: <input type="text" name="status" value="<?php echo $order->status; ?>" required><br>
        Price: <input type="number" name="price" value="<?php echo $order->price; ?>" required><br>
        Date Modify: <input type="datetime-local" name="created_at" value="<?php echo date('Y-m-d\TH:i', strtotime($order->created_at)); ?>" required><br>
        <input type="submit" name="update" value="Update">
    </form>
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
