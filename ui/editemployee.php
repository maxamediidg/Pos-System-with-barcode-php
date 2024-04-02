
<?php

include_once("header.php");

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
               

              
<div class="p-4 mt-0 mt-lg-4">
    <div class="row" style="border: 1px solid #aaa;">

        <div class="col-12 col-lg-6 p-4 2 mt-2 mt-md-0">
            <div class="row p-1 " style="border-radius:20px; ">
                <div class="col-6">
                    <h3 class="text-success">Villa Details</h3>
                </div>
                <div class="col-6 text-end">
                    <a class="btn btn-secondary my-2"><i class="bi bi-arrow-left-circle"></i> Back to Bookings</a>
                </div>
                <hr />
                ~~VILLA DETAILS~~
                <hr />
                <div class="text-end">
                    <h4 class="text-danger font-weight-bold ">
                        Booking Total :
                        <span style="border-bottom:1px solid #ff6a00">
                            $11
                        </span>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 p-4 2 mt-4 mt-md-0" style="border-left:1px solid #aaa">
            <form method="post">

                <div class="row pt-1 mb-3 " style="border-radius:20px; ">
                    <div class="col-6">
                        <h3 class="text-success">Enter Booking Details</h3>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-sm btn-outline-danger form-control my-1"><i class="bi bi-x-circle"></i> &nbsp; Cancel Booking</button>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Name</label>
                        <input class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Phone</label>
                        <input class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Email</label>
                        <input class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Check in Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Check Out Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">No. of nights</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Status</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Booking Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Check-in Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Actual Check-in Date</label>
                        <input disabled class="form-control" />
                    </div>


                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Check-out Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Actual Check-out Date</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Stripe PaymentIntent Id</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Stripe Session Id</label>
                        <input disabled class="form-control" />
                    </div>
                    <div class="form-group pt-2 col-6">
                        <label class="text-warning">Payment Date</label>
                        <input disabled class="form-control" />
                    </div>

                </div>
                <div class="form-group pt-2 pt-md-4">
                    <button type="submit" class="btn btn-warning form-control my-1"><i class="bi bi-check2-square"></i> &nbsp; Check In</button>
                    <button type="submit" class="btn btn-success form-control my-1"><i class="bi bi-clipboard2-check"></i> &nbsp; Check Out / Complete Booking</button>
                </div>
            </form>
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
