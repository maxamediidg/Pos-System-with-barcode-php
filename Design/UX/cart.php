<?php
include_once 'headeruser.php';
include_once "../../ui/connectdb.php";
?>

<?php



if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
}

$products = $pdo->query("select * from cart where user_id ='$_SESSION[userid]'");
$products->execute();

$allproducts = $products->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    $inp_price = $_POST['inp_price'];

    $_SESSION['saleprice'] = $inp_price;
    echo "<script> window.location.href='" . APPURL . "/chackout.php'; </script>";
}

?>


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6"> Your Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price in USD</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Update</th>
                        <th scope="col">Total In USD</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($allproducts) > 0) : ?>
                        <?php foreach ($allproducts as $product) : ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="../../ui/productimages/<?php echo $product->pro_image; ?>" class="img-fluid me-5  rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <?php echo $product->pro_title; ?><br>
                                    <small>1000g</small>
                                </td>
                                <td class="pro_price">
                                    <?php echo $product->pro_price; ?>
                                </td>
                                <td>
                                    <div class="input-group-btn">
                                        <input class="pro_qty form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $product->pro_qty; ?>" name="vertical-spin">
                                    </div>
                                </td>
                                <td>
                                    <button value="<?php echo $product->id; ?>" class="btn-update btn btn-warning">Update</button>
                                </td>
                                <td class="subtotal_price">
                                    <?php echo $product->pro_price * $product->pro_qty; ?>
                                </td>
                                <td>
                                    <button value="<?php echo $product->id; ?>" class="btn-delete btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-success bg-success text-white text-center">
                            there are no products in cart just yet
                        </div>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <a href="shop.php" class="mt-1 btn btn-info">Continue Shopping</a>
        </div>
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h3 class="mb-0 ps-4 me-4">Total : </h3>
                            <h5 class="full_price mb-0 pe-4"></h5>
                            <form method="post" action="cart.php">
                                <input class="inp_price form-control" type="hidden" value="" name="inp_price">
                                <?php if (count($allproducts) > 0) : ?>
                        </div>
                        <button type="submit" name="submit" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    <?php endif; ?>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <?php include_once 'footeruser.php'; ?>


    <script>
        $(document).ready(function() {
            $(".form-control").keyup(function() {
                var value = $(this).val();
                value = value.replace(/^(0*)/, "");
                $(this).val(1);
            });

        })

        $(".pro_qty").mouseup(function() {

            var $el = $(this).closest('tr');



            var pro_qty = $el.find(".pro_qty").val();
            var pro_price = $el.find(".pro_price").html();

            var subtotal = pro_qty * pro_price;
            $el.find(".subtotal_price").html("");

            $el.find(".subtotal_price").append(subtotal + '$');

            $(".btn-update").on('click', function(e) {

                var id = $(this).val();


                $.ajax({
                    type: "POST",
                    url: "update-product.php",
                    data: {
                        update: "update",
                        id: id,
                        pro_qty: pro_qty,
                        subtotal: subtotal
                    },

                    success: function() {
                        alert("done");
                        //reload();
                    }
                });
                fetch();
            });

            $(".btn-delete").on('click', function(e) {

                var id = $(this).val();


                $.ajax({
                    type: "POST",
                    url: "delete-product.php",
                    data: {
                        delete: "delete",
                        id: id,
                    },

                    success: function() {
                        alert("deleted product successfully");
                        reload();
                    }
                })
            });

            function reload() {
                $("body").load("cart.php");
            }

            fetch();

            function fetch() {

                setInterval(function() {
                    var sum = 0.0;
                    $('.subtotal_price').each(function() {
                        sum += parseFloat($(this).text());
                    });
                    $(".full_price").html('Total Price In USD:  ' + sum);
                    $(".inp_price").val(sum);



                }, 4000);
            }




        });
    </script>