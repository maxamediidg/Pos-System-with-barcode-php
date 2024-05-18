<?php
include_once 'headeruser.php';
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

    $select = $pdo->query("select * from orders where user_id='$id'");
    $select->execute();

    $data = $select->fetchAll(PDO::FETCH_OBJ);
}else {
    echo "<script> window.location.href='" . APPURL . "/404.php'; </script>";
}

?>

<br /><br /><br /><br /><br /><br /><br /><br />
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('./img/tree.png');">
            <br />
            <div class="container">
                <h1 class="pt-5 text-uppercase" style="color: white;">
                    Your Transactions
                </h1>
                <p class="lead" style="color: yellow;">
                    Save time and leave the groceries to us.
                </p>
            </div>
        </div>
    </div>

    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Total Price In USD</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($data) > 0): ?>
                                <?php foreach ($data as $order) : ?>
                                    <tr>
                                        <td> <?php echo $order->id; ?></td>
                                        <td>
                                            <?php echo $order->name; ?>
                                        </td>
                                        <td>
                                            <?php echo $order->created_at; ?>
                                        </td>
                                        <td>
                                            <?php echo $order->price; ?>
                                        </td>
                                        <td>
                                            <?php echo $order->status; ?>
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>
                        <?php else:?>
                            <div class="alert alert-success bg-success text-white text-center">
                                there are no Orders yet
                            </div>
                        <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>
<?php include_once 'footeruser.php'; ?>