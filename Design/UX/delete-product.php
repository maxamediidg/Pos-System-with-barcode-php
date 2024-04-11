<?php
include_once 'headeruser.php';
include_once "../../ui/connectdb.php";

?>


<?php 


if(isset($_POST['delete'])){

    $id = $_POST['id'];

    	
    $delete = $pdo->prepare("delete from cart where id = '$id'");
    $delete->execute();


}

?>





<?php require "footeruser.php"; ?>
