
<?php

include_once'connectdb.php';
session_start();

include_once "header.php";

$id=$_GET['id'];

$select=$pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];


$barcode_db=$row['barcode'];
$product_db=$row['product'];
$category_db=$row['category'];
$describtion_db=$row['description'];
$stock_db=$row['stock'];
$purchaseprice_db=$row['purchaseprice'];
$saleprice_db=$row['saleprice'];
$image_db= $row['image'];


if(isset($_POST['btneditproduct'])){

// $barcode_txt = $_POST['txtBarcode'];
$product_txt = $_POST['txtproductname'];
$category_txt= $_POST['txtselect_option'];
$description_txt= $_POST['txtdescription'];
$stock_txt= $_POST['txtstock'];
$purchaseprice_txt= $_POST['txtpurchaseprice'];
$saleprice_txt= $_POST['txtsaleprice'];



$f_name = $_FILES['myfile']['name'];

if(!empty($f_name)){

    $f_tmp = $_FILES['myfile']['tmp_name'];

    $f_size = $_FILES['myfile']['size'];
    
    $f_extension = explode('.', $f_name);
    $f_extension = strtolower(end($f_extension));
    
    $f_newfile = uniqid(). '.'. $f_extension;
    
    $store = "productimages/".$f_newfile;
    
    if($f_extension == 'jpg' || $f_extension= 'jpeg' || $f_extension == 'png' || $f_extension == 'gif'){
    
    if($f_size>=1000000){
    
    
        $_SESSION['status']= "max file should be 1MB";
        $_SESSION['status_code']="warning";
    }else{
      if(move_uploaded_file($f_tmp, $store)){
    
$f_newfile;


    
$update=$pdo->prepare("update tbl_product set product=:product,category=:category,description=:description,stock=:stock,purchaseprice=:pprice,saleprice=:sprice, image=:image where pid=$id");

$update->bindColumn(':product', $product_txt);
$update->bindParam(':product',$product_txt);
$update->bindParam(':category',$category_txt);
$update->bindParam(':description',$description_txt);
$update->bindParam(':stock',$stock_txt);
$update->bindParam(':pprice',$purchaseprice_txt);
$update->bindParam(':sprice',$saleprice_txt);
$update->bindParam(':image', $f_newfile);

if($update->execute()){

    $_SESSION['status']= "product updated successfully with New Image ";
    $_SESSION['status_code']="success";
}else{

    $_SESSION['status']= "product updated failed";
    $_SESSION['status_code']="error";




      }}}


    }
      

}
else{


$update=$pdo->prepare("update tbl_product set product=:product,category=:category,description=:description,stock=:stock,purchaseprice=:pprice,saleprice=:sprice, image=:image where pid=$id");

$update->bindColumn(':product', $product_txt);
$update->bindParam(':product',$product_txt);
$update->bindParam(':category',$category_txt);
$update->bindParam(':description',$description_txt);
$update->bindParam(':stock',$stock_txt);
$update->bindParam(':pprice',$purchaseprice_txt);
$update->bindParam(':sprice',$saleprice_txt);
$update->bindParam(':image', $image_db);

if($update->execute()){

    $_SESSION['status']= "product updated successfully!";
    $_SESSION['status_code']="success";
}else{

    $_SESSION['status']= "product updated failed";
    $_SESSION['status_code']="error";

}



}



}
$select=$pdo->prepare("select * from tbl_product where pid=$id");
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$id_db=$row['pid'];


$barcode_db=$row['barcode'];
$product_db=$row['product'];
$category_db=$row['category'];
$describtion_db=$row['description'];
$stock_db=$row['stock'];
$purchaseprice_db=$row['purchaseprice'];
$saleprice_db=$row['saleprice'];
$image_db= $row['image'];




?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Admin Dashboard</h1> -->
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
          <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="m-0">Edit Product</h5>
              </div>
              
              


              <form action="" name="formeditproduct" method="post" enctype="multipart/form-data">  
<div class="row">
<div class="col-md-6">

<div class="form-group">
                    <label>Barcode</label>
                    <input type="text" value="<?php echo $barcode_db; ?>" class="form-control" placeholder="Enter Barcode" name="txtBarcode" autocomplete="off" disabled>
                  </div>

                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text"  value="<?php echo $product_db; ?>"  class="form-control" placeholder="Enter Name" name="txtproductname" autocomplete="off" required>
                  </div>

                  <div class="form-group">
                  <label>Category</label>
                  <select class="form-control"  name="txtselect_option" autocomplete="off" required>
                    <option value="" disabled selected>select category</option>

                    <?php
                 $select=$pdo->prepare("select * from tbl_category order by catid desc");
                 $select->execute();   
                  while($row=$select->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option <?php if($row['category']==$category_db ){ ?> 
                        selected= "selected"
                        
                        <?php } ?>  ><?php echo $row['category'];?></option>
                    <?php

                  }  
                    
                    ?>

                  </select>
                </div>
                

                
                <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" class="form-control" placeholder="Enter Description" name="txtdescription" autocomplete="off" rows="4" required><?php echo $describtion_db; ?></textarea>
                  </div>
                





</div>




<div class="col-md-6">
    
<div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" value="<?php echo $stock_db; ?>" min="1" step="any" autocomplete="off" class="form-control" placeholder="Enter stock" name="txtstock" required>
                  </div>

                  <div class="form-group">
                    <label>purchase price</label>
                    <input type="number" autocomplete="off" class="form-control" value="<?php echo $purchaseprice_db; ?>" placeholder="Enter purchase price " name="txtpurchaseprice" required>
                  </div>
                

                  <div class="form-group">
                    <label>sale Price</label>
                    <input type="number" autocomplete="off" class="form-control" placeholder="Enter sale price" value="<?php echo $saleprice_db; ?>" name="txtsaleprice"  required>
                  </div>
                
                  <div class="form-group">
                    <label>Product image</label><br />
                    <image src="productimages/<?php echo $image_db;?>" class="img- py-1" width="80px" height="80px/">



                    <input type="file" class="input-group" autocomplete="off" name="myfile">
                    <p>Upload image</p>
                  </div>


             

</div>


</div>

</div>

<div class="card-footer">
    <div class="text-center">
        <div class="text-center">
                  <button type="submit" class="btn btn-success" name="btneditproduct">Update Product</button></div>
                </div>


</form>



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