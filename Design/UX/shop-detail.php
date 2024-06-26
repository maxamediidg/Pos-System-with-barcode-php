<?php
include_once "headeruser.php";
include_once "../../ui/connectdb.php";

?>



<?php



if (!isset($_SESSION['username'])) {
    echo "<script> window.location.href='" . APPURL . "'; </script>";
}


if (isset($_POST['submit'])) {

    $pro_id = $_POST['pro_id'];
    $pro_title = $_POST['pro_title'];
    $pro_image = $_POST['pro_image'];
    $pro_price = $_POST['pro_price'];
    $pro_qty = $_POST['pro_qty'];
    $pro_subtotal = $_POST['pro_subtotal'];
    $user_id = $_POST['user_id'];

    $insert = $pdo->prepare("insert into cart(pro_id,pro_title,pro_image,pro_price,pro_qty,pro_subtotal,user_id)
 values(:pro_id,:pro_title,:pro_image,:pro_price,:pro_qty,:pro_subtotal,:user_id)");

    $insert->execute([
        ':pro_id' => $pro_id,
        ':pro_title' => $pro_title,
        ':pro_image' => $pro_image,
        ':pro_price' => $pro_price,
        ':pro_qty' => $pro_qty,
        ':pro_subtotal' => $pro_subtotal,
        ':user_id' => $user_id,

    ]);
}




//categories 
$categories = $pdo->query("SELECT * FROM tbl_category");
$categories->execute();
$allcategories = $categories->fetchAll(PDO::FETCH_OBJ);


//features 
$featured = $pdo->query("SELECT * FROM tbl_product WHERE barcode between '10-50' and '50-90'");
$featured->execute();
$allfeaturedProducts = $featured->fetchAll(PDO::FETCH_OBJ);

//products 
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $products = $pdo->query("SELECT * FROM tbl_product where pid != $id  order by rand() limit 4");
    $products->execute();
    $allproducts = $products->fetchAll(PDO::FETCH_OBJ);
}
?>

<?php

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $select = $pdo->query("select * from tbl_product where  pid='$id'");
    $select->execute();

    $products = $select->fetch(PDO::FETCH_OBJ);
} else {
    echo "<script> window.location.href='" . APPURL . "/404.php'; </script>";
}
?>

<?php
//validate cart products
if (isset($_SESSION['userid'])) {
    $Validate = $pdo->query("select * from cart where pro_id ='$id' And user_id='$_SESSION[userid]' ");
    $Validate->execute();
}




?>

<?php
//products 
$client = $pdo->query("SELECT * FROM tbl_client");
$client->execute();
$allclient = $client->fetchAll(PDO::FETCH_OBJ);
?>


<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop Detail</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop Detail</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded">
                            <a href="#">
                                <img src="../../ui/productimages/<?php echo $products->image; ?>" class="img-fluid rounded" alt="Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="fw-bold mb-3"> <?php echo $products->product; ?></h4>
                        <p class="mb-3">Category:<?php
                                                    $id = $_GET['id'];

                                                    $select = $pdo->prepare("select * from tbl_product where pid=$id");
                                                    $select->execute();

                                                    while ($row = $select->fetch(PDO::FETCH_OBJ)) {

                                                        echo '   
                                 <span float-right">' . $row->category . '</span> ';
                                                    }
                                                    ?>
                        </p>
                        <h5 class="fw-bold mb-3"> <?php echo $products->saleprice; ?> $</h5>
                        <div class="d-flex mb-4">
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <p class="mb-4"> <?php echo $products->description; ?> .</p>
                        <p class="mb-4">Look open eyes</p>
                        <p class="mb-1">
                            <strong>Quantity</strong>
                        <form method="POST" id="form-data">
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_title" value="<?php echo $products->product; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_image" value="<?php echo $products->image; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input class="pro_price form-control" type="hidden" name="pro_price" value="<?php echo $products->saleprice; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="user_id" value="<?php echo $_SESSION['userid']; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_id" value="<?php echo $products->pid; ?>">
                            </div>
                            </p>
                            <!-- <div class="input-group quantity mb-5" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn-insert btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus" value="<?php echo $products->saleprice; ?>" name="pro_qty"></i>
                                </button>
                            </div>
                            <input type="text" class="btn-insert form-control form-control-sm text-center border-0" value="1">
                            <div class="input-group-btn">
                                <button  class=" btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus" value="<?php echo $products->saleprice; ?>" name="pro_qty"></i>
                                </button>
                            </div>
                        </div>  -->

                            <div class="col-sm-5">
                                <input class="pro_qty form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $products->quantity; ?>" name="pro_qty">
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <input class="subtotal_price form-control" type="hidden" name="pro_subtotal" value="<?php echo $products->saleprice * $products->quantity; ?>">
                                </div>
                            </div>
                            <?php if (isset($_SESSION['username'])) : ?>
                                <?php if ($Validate->rowCount() > 0) : ?>

                                    <button name="submit" type="submit" class="btn-insert mt-3 btn btn-primary btn-lg" disabled>
                                        <i class="fa fa-shopping-basket"></i> Added to Cart
                                    </button>
                                <?php else : ?>

                                    <button name="submit" type="submit" class="btn-insert mt-3 btn btn-primary btn-lg">
                                        <i class="fa fa-shopping-basket"></i> Add to Cart
                                    </button> <?php endif; ?>
                            <?php else : ?>
                                <div class="mt-5 alert alert-success bg-success text-white text-center">
                                    log in to buy this product or add it to cart
                                </div>
                            <?php endif; ?>


                            <!-- <a href="shop-detail.php?id=<?php echo $products->pid; ?>"  class=" btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i  class="fa fa-shopping-bag me-2 text-primary"  class=""></i> Add to cart</a> -->
                    </div>
                    </form>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    Susp endisse ultricies nisi vel quam suscipit </p>
                                <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic
                                    icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.</p>
                                <div class="px-2">
                                    <div class="row g-4">
                                        <div class="col-6">
                                            <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Stock</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0"><?php echo $products->stock; ?></p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Country of Origin </p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0"><?php echo $products->country; ?></p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Purchase Price</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0"><?php echo $products->purchaseprice; ?></p>
                                                </div>
                                            </div>
                                            <div class="row text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Сheck</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">Healthy</p>
                                                </div>
                                            </div>
                                            <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                <div class="col-6">
                                                    <p class="mb-0">Min Weight</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-0">250 Kg</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Jason Smith</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                    <div class="">
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                            words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-vision" role="tabpanel">
                                <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                    amet diam et eos labore. 3</p>
                                <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                    Clita erat ipsum et lorem et sit</p>
                            </div>
                        </div>
                    </div>

                        <form action="#">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <?php foreach ($allcategories as $category) : ?>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#"><i class="fas fa-apple-alt me-2"></i><?php echo $category->category; ?></a>
                                                <span></span>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-3">Featured products</h4>
                            <?php foreach ($allfeaturedProducts as $featured) : ?>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="../../ui/productimages/<?php echo $featured->image; ?>"" class=" img-fluid rounded" alt="">
                                    </div>
                                    <div>
                                        <h6 class="mb-2"><?php echo $featured->product; ?></h6>
                                        <div class="d-flex mb-2">
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star text-secondary"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <h5 class="fw-bold me-2"><?php echo $featured->saleprice; ?> $</h5>
                                            <h5 class="text-danger text-decoration-line-through"><?php echo $featured->purchaseprice; ?> $</h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="img/logo-color.png" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold"><br>🚀 <br></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <?php foreach ($allproducts as $products) : ?>
                        <div class="border border-primary rounded position-relative vesitable-item">
                            <div class="vesitable-img">
                                <img src="../../ui/productimages/<?php echo $products->image; ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?php echo $products->stock; ?></div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?php echo $products->product; ?></h4>
                                <p><?php echo $products->description; ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">$<?php echo $products->saleprice; ?> in USD</p>
                                    <a href="shop-detail.php?id=<?php echo $products->pid; ?>" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <?php include_once "footeruser.php"; ?>

    <script>
        $(".btn-insert").on("click", function(e) {
            e.preventDefault();

            var form_data = $("#form-data").serialize() + '&submit=submit';

            $.ajax({
                url: "shop-detail.php?id=<?php echo $id; ?>",
                method: "post",
                data: form_data,
                success: function() {
                    alert("Product added to cart successfully");
                    (".btn-insert").html(" <i class='fa fa-shopping-basket'></i> Added to Cart").prop("disabled", true);
                    WithRef();
                }
            });

            function WithRef() {
                $("body").load("shop-detail.php?id=<?php echo $id; ?>");
            }

            $(".pro_qty").mouseup(function() {



                var $el = $(this).closest('form');


                var pro_qty = $el.find(".pro_qty").val();
                var pro_price = $el.find(".pro_price").val();

                var subtotal = pro_qty * pro_price;
                //alert(subtotal);
                $el.find(".subtotal_price").val("");

                $el.find(".subtotal_price").val(subtotal);
            });

        });
    </script>