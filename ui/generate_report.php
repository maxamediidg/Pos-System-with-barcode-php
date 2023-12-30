
<?php 

include_once'connectdb.php';

$date_id=$_GET["id"];


$select=$pdo->prepare("select * from tbl_invoice where expense_id=$date_id ");
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);

$response=$row;

header('content-type: application/json');

echo json_encode($response);



?>