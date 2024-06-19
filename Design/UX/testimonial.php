<?php 
include_once "headeruser.php"; 
include_once "../../ui/connectdb.php";
?>

<?php 
if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $description = $_POST['description'];
  $pro = $_POST['pro'];
  
  $f_name = $_FILES['image']['name'];
  $f_tmp = $_FILES['image']['tmp_name'];
  
  $f_size = $_FILES['image']['size'];
  
  $f_extension = explode('.', $f_name);
  $f_extension = strtolower(end($f_extension));
  
  $f_newfile = uniqid().'.'.$f_extension;
  
  $store = "Feedback/".$f_newfile;
  
  if($f_extension == 'jpg' || $f_extension == 'jpeg' || $f_extension == 'png' || $f_extension == 'gif'){
  
    if($f_size >= 1000000){
      echo "<script>alert('Max file size should be 1MB');</script>";
    } else {
      if(move_uploaded_file($f_tmp, $store)){
        $image = $f_newfile;
        
        $insert = $pdo->prepare("INSERT INTO tbl_client (fullname, description, role, image) VALUES (:name, :description, :role, :image)");
        
        $insert->bindParam(':name', $name);
        $insert->bindParam(':description', $description);
        $insert->bindParam(':role', $pro);
        $insert->bindParam(':image', $image);
        
        if($insert->execute()){
          echo "<script>alert('Employee inserted successfully');</script>";
        } else {
          echo "<script>alert('Error inserting employee');</script>";
        }
      } else {
        echo "<script>alert('Error uploading file');</script>";
      }
    }
  } else {
    echo "<script>alert('Only jpg, jpeg, png, and gif files can be uploaded');</script>";
  }
}
?>

<?php
//products 
$client = $pdo->query("SELECT * FROM tbl_client");
$client->execute();
$allclient = $client->fetchAll(PDO::FETCH_OBJ);
?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Testimonial</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Testimonial</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


         <!-- Tastimonial Start -->
         <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Our Testimonial</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel">
                <?php foreach ($allclient as $client) : ?>
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Description: <?php echo $client->description;?>
                                </p>
                           </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="Feedback/<?php echo $client->image; ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo $client->fullname;?></h4>
                                    <p class="m-0 pb-3">Profession: <?php echo $client->role;?></p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <?php endforeach; ?>             
                </div>
 

<br /><br />


                <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>feedback</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Enter what are your saying <strong>star-mall</strong>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="" action="testimonial.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter your fullname">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">description</label>
                    <textarea class="form-control" spellcheck="false"  name="description" placeholder="please enter what are you saying"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Professional</label>
                    <input type="text" name="pro" class="form-control" id="exampleInputEmail1" placeholder="Enter your professional like teacher,cutsomer...">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" placeholder="Enter image you own" class="custom-file">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>         
            </div>
        </div>
        
        <!-- Tastimonial End -->

 <?php include_once "footeruser.php"; ?>
<!-- 
 <script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
        name: {
        required: true,
        name: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script> -->