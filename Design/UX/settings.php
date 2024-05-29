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

    // Check if the ID matches the logged-in user's ID
    if ($id != $_SESSION['userid']) { // Use loose comparison
        echo "<script> window.location.href='" . APPURL . "'; </script>";
        exit; 
    }

    $select = $pdo->query("select * from tbl_user where userid='$id'");
    $select->execute();

    $users = $select->fetch(PDO::FETCH_OBJ);


    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone_number'];

        $update = $pdo->prepare("UPDATE tbl_user SET username = :fullname, address = :address, city = :city, country = :country, zip_code = :zip_code, phone_number = :phone_number WHERE userid = :id");
        $update->bindParam(':fullname', $fullname);
        $update->bindParam(':address', $address);
        $update->bindParam(':city', $city);
        $update->bindParam(':country', $country);
        $update->bindParam(':zip_code', $zip_code);
        $update->bindParam(':phone_number', $phone_number);
        $update->bindParam(':id', $id);
        $update->execute();


        echo "<script> window.location.href='" . APPURL . "'; </script>";
        exit;
    }
} else {
    echo "<script> window.location.href='" . APPURL . "/404.php'; </script>";
    exit;
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
                    <form action="settings.php?id=<?php echo $id ?>" method="post" class="bill-detail">
                        <fieldset>
                            <div class="form-group row">
                                <div class="col">
                                    <input class="form-control" name="fullname" value="<?php echo $users->username  ?>" placeholder="Full Name" type="text">
                                </div>

                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="address" placeholder="Address"><?php echo $users->address  ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="form-control" value="<?php echo $users->city  ?>" name="city" placeholder="Town / City" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" value="<?php echo $users->country  ?>" name="country" placeholder="State / Country" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="zip_code" value="<?php echo $users->zip_code  ?>" placeholder="Postcode / Zip" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="phone_number" value="<?php echo $users->phone_number  ?>" placeholder="Phone Number" type="tel">
                            </div>

                            <br />
                            <div class="form-group text-right">
                                <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
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