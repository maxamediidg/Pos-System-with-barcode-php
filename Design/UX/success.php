<?php
session_start(); // Ensure the session is started

if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect to the desired location if HTTP_REFERER is not set
    header('Location: http://localhost/posbarcode/Design/UX/index.php');
    exit;
}

include_once "headeruser.php";
include_once "../../ui/connectdb.php";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
    exit;
}

// Check if user ID is set in the session
if (isset($_SESSION['userid'])) {
    // Prepare and execute the delete statement
    $delete = $pdo->prepare("DELETE FROM cart WHERE user_id = :userid");
    $delete->bindParam(':userid', $_SESSION['userid']);
    $delete->execute();
} else {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
    exit;
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
            <a href="<?php echo APPURL; ?>" class="btn btn-primary text-uppercase">Home</a>
        </div>
    </div>
</div>

<?php include_once "footeruser.php"; ?>
