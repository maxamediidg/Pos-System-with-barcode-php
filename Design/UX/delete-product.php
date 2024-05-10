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


if(isset($_POST['delete'])){

    $id = $_POST['id'];

    	
    $delete = $pdo->prepare("delete from cart where id = '$id'");
    $delete->execute();


}

?>





<?php require "footeruser.php"; ?>
