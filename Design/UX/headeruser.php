<?php 
include_once "../../ui/connectdb.php";
define("APPURL", "http://localhost/posbarcode/Design/UX");

session_start();

if(isset($_SESSION['userid'])){

$cart =$pdo->query("SELECT count(*) as num_products FROM cart where user_id ='$_SESSION[userid]';");

$cart->execute();

$num =$cart->fetch(PDO::FETCH_OBJ);
}

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Star-Mall - POS System</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="../UX/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="../UX/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../UX/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        
    </head>

    <body>
       
       
       <!-- Spinner Start -->
        <!-- <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div> -->
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street,Hargeisa</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">maxamedeid72@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="policy.php" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                        <a href="terms.php" class="text-white"><small class="text-white mx-2">Terms of Use</small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6"><!--Fruitables-->STAR-MALL</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="cart.php" class="nav-item nav-link">Your Cart</a>
                            <!-- <a href="shop-detail.php" class="nav-item nav-link">Shop Detail</a> -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Transaction</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                    <!-- <a href="cart.php" class="dropdown-item">Cart</a> -->
                                    <a href="<?php echo APPURL; ?>/transaction.php?id=<?php echo $_SESSION['userid']; ?>" class="dropdown-item">Transaction History</a> 
                                    <a href="settings.php?id=<?php echo $_SESSION['userid'] ; ?>"  class="dropdown-item">Settings</a>
                                    <!-- <a href="testimonial.php"  class="dropdown-item">Client</a> -->
                                    <!-- <a href="404.html" class="dropdown-item">404 Page</a> -->
                                </div>
                            </div>             
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                            <a href="about.php" class="nav-item nav-link">About</a>
                            <a href="testimonial.php" class="nav-item nav-link">Client</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="cart.php" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span  class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?php echo $num->num_products; ?></span></a>
                            </a>
                            <a href="../UX/settings.php" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        </div>  
                    </div>
                    <i class="bi bi-box-arrow-right px-3" style="font-size: 20px;"> <a href="../../ui/logout.php">logout</a></i>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

    </body>
</html>