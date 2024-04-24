<?php
include_once 'headeruser.php';
include_once "../../ui/connectdb.php";
?>

<?php 

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