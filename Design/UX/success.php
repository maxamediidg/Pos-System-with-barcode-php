<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    //redirect them to the desired location
    header('location: http://localhost/posbarcode/Design/UX/index.php');
    exit;
}


?>


<?php
include_once "headeruser.php";
include_once "../../ui/connectdb.php";
?>

<?php 


if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
}


if(isset($_POST['userid'])){

    $delete =$pdo->prepare("DELETE from cart where user_id ='$_SESSION[userid]'");
    $delete->execute();

}

?>

<div class="banner">
    <br />
    <br />
    <br />
    <br />

    <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('./img/card2.jpg'); width: 100%; height: 600px;  background-size: cover; background-position: center;">
        <div class="container">
            <h1 class="pt-5 text-uppercase" style="color: yellow;">
                <br />
                <br />
                Payment has been a success
            </h1>
            <p class="lead text-uppercase" style="color: white;">
                Save time and leave the groceries to us.
            </p>
            <a href="<?php echo APPURL; ?>" class="btn btn-primary text-uppercase">home</a>


        </div>
    </div>
</div>

<?php include_once "footeruser.php"; ?>