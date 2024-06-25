
<?php

include_once'connectdb.php';
session_start();

include_once'header.php';

if(isset($_POST['btnsave'])){

  $date = $_POST['date'];
  $name= $_POST['name'];
  $email= $_POST['email'];
  $phone= $_POST['phone'];
  $address= $_POST['address'];


  

  $f_name = $_FILES['image']['name'];
$f_tmp = $_FILES['image']['tmp_name'];

$f_size = $_FILES['image']['size'];

$f_extension = explode('.', $f_name);
$f_extension = strtolower(end($f_extension));

$f_newfile = uniqid(). '.'. $f_extension;

$store = "uploads/".$f_newfile;

if($f_extension == 'jpg' || $f_extension= 'jpeg' || $f_extension == 'png' || $f_extension == 'gif'){

if($f_size>=1000000){


    $_SESSION['status']= "max file should be 1MB";
    $_SESSION['status_code']="warning";
}
}

if(isset($_POST['email'])){
  $select=$pdo->prepare("select * from tbl_employee where email='$email'");
$select->execute();
  
if($select->rowCount()>0){

$_SESSION['status']= "Email already exists. Create Account from New Email";
$_SESSION['status_code']="warning";

}


else{
  if(move_uploaded_file($f_tmp, $store)){

$photo = $f_newfile;



$insert=$pdo->prepare("insert into tbl_employee(name, email,phone,address,photo,joining_date)
values(:name,:email,:phone,:address,:photo,:join)");

$insert->bindParam(':name', $name);
$insert->bindParam(':email',$email);
$insert->bindParam(':phone',$phone);
$insert->bindParam(':address',$address);
$insert->bindParam(':photo',$photo);
$insert->bindParam(':join', $date);

if($insert->execute()){
  
  $_SESSION['status']= "employee inserted successfully";
  $_SESSION['status_code']="success";
}
  
}}}

else{
    
  $_SESSION['status']= "only jpg, jpeg, png and gif can be uploaded";
  $_SESSION['status_code']="warning";
  
}

}


error_reporting(0);

$id=$_GET['id'];

if(isset($id)){

$delete =$pdo->prepare("delete from tbl_employee where id=".$id);
if($delete->execute()){

  $_SESSION['status']= "Account deleted successfully";
  $_SESSION['status_code']="warning";
}else{
  
$_SESSION['status']= "Account Is Not Deletd";
$_SESSION['status_code']="warning";
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
            <h1 class="m-0">Section of Employee</h1>
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
                <h5 class="m-0">employee record</h5>
              </div>
              <div class="card-body">


<div class="row">
  
  <div class="col-lg-8">
  <h3 class="text-center text-info">Add Record</h3>
 <form action="employee.php" method="post" enctype="multipart/form-data">


 <div class="form-group">
    <input type="date" name="date" class="form-control" required>
 </div>


 <div class="form-group">
    <input type="text" name="name" class="form-control" placeholder="enter name" required>
 </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="enter e-email" required>
 </div>

 <div class="form-group">
    <input type="text" name="phone" class="form-control" placeholder="enter phone" required>
 </div>

 <div class="form-group">
    <input type="text" name="address" class="form-control" placeholder="enter address" required>
 </div>

  <div class="form-froup">
    <input type="file" name="image" class="custom-file">
 </div>

 <div class="form-group">
 <button type="submit" class="btn btn-primary" name="btnsave">Add Record</button>
 </div>

 </form>   
  </div>



  <div class="col-lg-12">
  
  <h3 class="text-center text-info">Records present in the Database</h3>



<table id="table_employee" class="table  table-hover">
    <thead class="bg-info text-dark">
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>email</th>
        <th>phone</th>
        <th>address</th>
        <th>Date of Admission</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
                  <?php

                  $select = $pdo->prepare("select * from tbl_employee order by id ASC");
                  $select->execute();

                  while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                    echo '
<tr>
<td> '.$row->id.'</td>
<td> <image src="uploads/' . $row-> photo. '" class="img-rounded" width="40px" height="40px/"></td>
<td> ' . $row->name . '</td>
<td> ' . $row->email . '</td>
<td> ' . $row->phone . '</td>
<td> ' . $row->address . '</td>
<td> ' . $row->joining_date . '</td>


<td>
<div class="btn-group">
<div class="w-75 btn-group">
      <a href="employeeDetails.php?id='.$row->id.'" class="btn btn-warning mx-2">
     <i class="bi-bi-pencil-square"></i>  Details</a>


 <a href="employee.php?id='.$row->id.'"" class="btn btn-danger mx-2">
     <i class="bi-bi-pencil-square"></i>  Delete </a>

</div>
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
    $('#table_employee').DataTable();
  });
</script>


<?php 
if(isset($_SESSION['status'])&& $_SESSION['status']!=='')
{

  ?>
<script>
    

      Swal.fire({
        icon: '<?php echo $_SESSION['status_code'];?>',
        title: '<?php echo $_SESSION['status'];?>'
      })
</script>



<?php
unset($_SESSION['status']);
}

?>
