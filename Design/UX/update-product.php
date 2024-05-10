<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    //redirect them to the desired location
    header('location: http://localhost/posbarcode/Design/UX/index.php');
    exit;
}


?>

<?php
include_once 'headeruser.php';
include_once "../../ui/connectdb.php";
?>

<?php 


if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
}


if(isset($_POST['update'])){

    $id = $_POST['id'];
    $pro_qty = $_POST['pro_qty'];
    $subtotal = $_POST['subtotal'];
    	
    $update = $pdo->prepare("UPDATE cart SET pro_qty = '$pro_qty', pro_subtotal = '$subtotal' where id = '$id'");
    $update->execute();


}

?>

<?php
include_once 'footeruser.php';
?>