

<?php

include_once 'connectdb.php';
session_start();


include_once("header.php");

if(isset($_POST['submit'])){

$dateexpense =$_POST['dateexpense'];
$txtselect_option = $_POST['expenseitem'];
$costitem = $_POST['costitem'];




$insert=$pdo->prepare("insert into tbl_expense(expense_item, expense_cost,expense_date)
values(:item,:cost,:date)");

$insert->bindParam(':date', $dateexpense);
$insert->bindParam(':item',$txtselect_option);
$insert->bindParam(':cost',$costitem);

if($insert->execute()){
      
  $_SESSION['status']= "expenses Added successfully";
  $_SESSION['status_code']="success";
}else{
    
  $_SESSION['status']= "expenses Added Failed";
  $_SESSION['status_code']="warning";
}}


function fill_product($pdo)
{

  $output = '';
  $select = $pdo->prepare("select * from tbl_product order by product asc");

  $select->execute();

  $result = $select->fetchAll();

  foreach ($result as $row) {

    $output .= '<option value="' . $row["product"] . '">' . $row["product"] . '</option>';
  }

  return $output;
}







?>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Section of Expenses</h1>
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
                <h5 class="m-0">Expenses Daily,Monthly,Yearly</h5>
              </div>
              <div class="card-body">


<div class="row">
  
  <div class="col-lg-8">
  <h3 class="text-center text-info">Add expenses</h3>
 <form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="dateexpense" required="true">
								</div>
								<div class="form-group">
                <select class="form-control select2" data-dropdown-css-class="select2-purple" name="expenseitem"   style="width: 100%;">
                      <option>Select Item OR search <?php echo fill_product($pdo); ?></option>

                    </select>
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div>
								
								
								</div>
								
							</form>


  <div class="col-lg-12">
  
  <h3 class="text-center text-info">Manage Expense</h3>



<table id="table_employee" class="table  table-hover">
    <thead>
    <tr>
                  <th>SR.NO</th>
                  <th>Expense Item</th>
                  <th>Expense Cost</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
    </thead>
    <tbody>
      <?php 
                        $select = $pdo->prepare("select * from tbl_expense order by expense_id ASC");
                        $select->execute();
      
                        while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                          echo '
      <tr>
      <td> '.$row->expense_id.'</td>
      <td> ' . $row->expense_item . '</td>
      <td> ' . $row->expense_cost . '</td>
      <td> ' . $row->expense_date . '</td>
      
      
      <td>
      <div class="btn-group">
      
          
      <button id=' . $row->expense_id . ' class="btn btn-danger btn-xs btndelete"><span class="fa fa-trash" style="color:#ffffff" data-toggle="tooltip" title="delete employee"></span></button>
      
      </di>
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
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  </script>





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








