<?php
include_once "headeruser.php";
include_once "../../ui/connectdb.php";



?>

<?php
//categories 
$categories = $pdo->query("SELECT * FROM tbl_category");
$categories->execute();
$allcategories = $categories->fetchAll(PDO::FETCH_OBJ);

//categories 
$featured = $pdo->query("SELECT * FROM tbl_product WHERE barcode between '10-50' and '50-90'");
$featured->execute();
$allfeaturedProducts = $featured->fetchAll(PDO::FETCH_OBJ);
?>

<?php
//products 
$products = $pdo->query("SELECT * FROM tbl_product");
$products->execute();
$allproducts = $products->fetchAll(PDO::FETCH_OBJ);
?>

<?php
// Connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'pos_barcode_db';

$pdo = new mysqli($db_host, $db_user, $db_pass, $db_name);


// Query to count the number of distinct categories
$sql_categories = "SELECT COUNT(*) AS num_categories FROM tbl_category";
$result_categories = $pdo->query($sql_categories);
$row_categories = $result_categories->fetch_assoc();
$num_categories = $row_categories['num_categories'];



// echo "Total number of categories: " . $num_categories . "<br>";





?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Flash Sales</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1"  class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <?php foreach ($allcategories as $category) : ?>
                                        <ul class="list-unstyled fruite-categorie">
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="#"><i class="fas fa-apple-alt me-2"></i><?php echo $category->category; ?></a>
                                                    <span>3</</span>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Additional</h4>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                                        <label for="Categories-1"> Organic</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                                        <label for="Categories-2"> Fresh</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                                        <label for="Categories-3"> Sales</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                                        <label for="Categories-4"> Discount</label>
                                    </div>
                                    <div class="mb-2">
                                        <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                                        <label for="Categories-5"> Expired</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="mb-3">Featured products</h4>
                                <?php foreach ($allfeaturedProducts as $featured) : ?>
                                <div class="d-flex align-items-center justify-content-start">
                                    <div class="rounded me-4" style="width: 100px; height: 100px;">
                                        <img src="../../ui/productimages/<?php echo $featured->image; ?>" class="img-fluid rounded" alt="">
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
                                        <h3 class="text-secondary fw-bold"><br> 🚀 <br></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($allproducts as $product) : ?>
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                        <img src="../../ui/productimages/<?php echo $product->image; ?>" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Stock <?php echo $product->stock; ?></div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4><?php echo $product->product; ?></h4>
                                            <p><?php echo $product->description; ?></p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">$ <?php echo $product->saleprice; ?></p>
                                                <a href="shop-detail.php?id=<?php echo $product->pid; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="#" class="active rounded">1</a>
                                    <a href="#" class="rounded">2</a>
                                    <a href="#" class="rounded">3</a>
                                    <a href="#" class="rounded">4</a>
                                    <a href="#" class="rounded">5</a>
                                    <a href="#" class="rounded">6</a>
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->


<?php include_once "footeruser.php"; ?>