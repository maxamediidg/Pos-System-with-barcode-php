<?php
include_once "headeruser.php";
include_once "../../ui/connectdb.php";

if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
}

?>

<?php 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    if ($id !== $_SESSION['userid']) {
        echo "<script> window.location.href='" . APPURL . "'; </script>";
    }

    $select = $pdo->query("select * from tbl_user where userid='$id'");
    $select->execute();

    $users = $select->fetch(PDO::FETCH_OBJ);
}

?>

<br /><br /><br /><br /><br /><br /><br /><br />
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('./img/ghust.jpg'); width: 100%; height: 200px;">
                <div class="container">
                    <h1 class="pt-5 text-uppercase" style="color:aquamarine;">
                        Settings
                    </h1>
                    <p class="lead" style="color: yellow;">
                        Update Your Account Info
                    </p>
                </div>
            </div>
        </div>
<br />
        <section id="checkout">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-6">
                        <h5 class="mb-3">ACCOUNT DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="#" class="bill-detail">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="fullname" value="<?php echo $users->username  ?>" placeholder="Full Name" type="text">
                                    </div>
                                   
                                </div>
                               
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Address"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Town / City" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="State / Country" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Postcode / Zip" type="text">
                                </div>
                                <div class="form-group">
                                        <input class="form-control" placeholder="Phone Number" type="tel">
                                    </div>
                               
                                <br />
                                <div class="form-group text-right">
                                    <a href="#" class="btn btn-primary">UPDATE</a>
                                    <div class="clearfix">
                                </div>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                </div>
            </div>
        </section>
    </div>
   
<?php include_once "footeruser.php"; ?>
