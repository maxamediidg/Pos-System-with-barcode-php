
<?php

include_once'connectdb.php';
session_start();


if($_SESSION['useremail']==""){
    header('location:../index.php');
}

if($_SESSION['role'] == "Admin"){
    include_once"header.php";
}else{
    include_once"headeruser.php";
    
}



// 1 step) when user click on updatepassword button then w.e get out values from user into php variables.

if(isset($_POST['btnupdate'])){

$oldpassword_txt = $_POST['txt_oldpassword'];
$newpassword_txt = $_POST['txt_newpassword'];
$rnewpassword_txt = $_POST['txt_rnewpassword'];

echo $oldpassword_txt. "-".$newpassword_txt. "-".$rnewpassword_txt;


// 2  step) using of select query we will get out database records according to useremail
$email = $_SESSION['useremail'];

$select = $pdo->prepare("select * from tbl_user where useremail='$email'");

$select->execute();
$row= $select->fetch(PDO::FETCH_ASSOC);

$useremail_db= $row['useremail'];
 $password_db=$row ['userpassword'];



// 3 step) we will compare the user values to database values
if($oldpassword_txt== $password_db){
if($newpassword_txt==$rnewpassword_txt){

// 4 step) if values will match then we will run update query
 $update = $pdo->prepare("update tbl_user set userpassword=:pass where useremail=:email");
 $update->bindParam(':pass',$rnewpassword_txt);
 $update->bindParam(':email',$email);
 
 if($update->execute()){
    $_SESSION['status']= "password updated successfully";
    $_SESSION['status_code']="success";
 }else{
    $_SESSION['status']= "password Not  updated successfully";
    $_SESSION['status_code']="error";
 }
    
    // $_SESSION['status']= "New password matched";
    // $_SESSION['status_code']="success";
}else{


    $_SESSION['status']= " New password Does not Matched";
    $_SESSION['status_code']="error";
   
}

}else{
    $_SESSION['status']= "password Does not Matched";
    $_SESSION['status_code']="error";
// }



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
            <h1 class="m-0">change Password</h1>
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
    <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">change password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post">
                <div class="card-body">
               
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">old Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="old Password" name="txt_oldpassword">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">new Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="new Password" name="txt_newpassword">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">repeat new password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword3" placeholder="repeat new Password"  name="txt_rnewpassword">
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" name="btnupdate">Update password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->


            
           
            
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
