<?php 
include_once 'headeruser.php' ; 
include_once "../../ui/connectdb.php";


$products = $pdo->query("select * from cart where user_id ='$_SESSION[userid]'");
$products->execute();

$allproducts = $products->fetchAll(PDO::FETCH_OBJ);

if(isset($_SESSION['saleprice'])){
    $_SESSION['total_price'] = $_SESSION['saleprice'] + 20 ;
}



if(isset($_POST['submit'])) {
    if(empty($_POST['name']) or empty($_POST['lname'])  or empty($_POST['company_name']) 
    or empty($_POST['address'])  or empty($_POST['city']) or empty($_POST['country']) or empty($_POST['zip_code'])
    or empty($_POST['email']) or empty($_POST['phone_number'] or empty($_POST['order_notes']))) {

    echo "<script> alert('one or more inputs are empty');</script>";

    } else{

        $name = $_POST['name'];
        $lname = $_POST['lname'];
        $company_name = $_POST['company_name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $zip_code = $_POST['zip_code'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $order_notes = $_POST['order_notes'];
        $saleprice = $_SESSION['total_price'];
        $user_id = $_SESSION['user_id'];

$insert = $pdo->prepare("insert into orders(name,lname,company_name,address,city,country,zip_code,email,
phone_number,order_notes,price,user_id)
        VALUES(:name,:lname,:company_name,:address,:city,:country,:zip_code,:email,:phone_number,:order_notes,:saleprice,:user_id)");
        
        $insert->execute([
            ":name"=> $name,
            ":lname"=> $lname,
            ":company_name"=> $company_name,
            ":address"=> $address,
            ":city"=> $city,
            ":country"=> $country,
            ":zip_code"=> $zip_code,
            ":email"=> $email,
            ":phone_number"=> $phone_number,
            ":order_notes"=> $order_notes,
            ":saleprice"=> $saleprice,
            ":user_id"=> $user_id,
        ]);       

        echo "<script> alert('order has been created');</script>";

    }
}

?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="chackout.php" method="post">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">First Name<sup>*</sup></label>
                                        <input type="text"  name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Last Name<sup>*</sup></label>
                                        <input type="text" name="lname" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Company Name<sup>*</sup></label>
                                <input type="text" name="company_name" class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address <sup>*</sup></label>
                                <input type="text" class="form-control"  name="address" placeholder="House Number Street Name">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Town/City<sup>*</sup></label>
                                <input type="text" name="city" class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Country<sup>*</sup></label>
                                <input type="text"  name="country" class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                                <input type="text"  name="zip_code" class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="tel"  name="phone_number"  class="form-control">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email"   name="email" class="form-control">
                            </div>
                           
                            <hr>
                           
                            <div class="form-group">
                                    <textarea class="form-control" spellcheck="false" cols="30" rows="11" name="order_notes" placeholder="Order Notes"></textarea>
                                </div>
                            <!-- <div class="form-item mt-1">
                                <textarea name="text" name="order_notes"  class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                            </div> -->
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4 mt-2">
                                <button name="submit" type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary float-left">PROCEED TO CHECKOUT</button>
                            </div>                                                    
                        </form>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($allproducts as $product) : ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="../../ui/productimages/<?php echo $product->pro_image; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"> <?php echo $product->pro_title; ?> </td>
                                            <td class="py-5">$ <?php echo $product->pro_price; ?></td>
                                            <td class="py-5"><?php echo $product->pro_qty; ?></td>
                                            <td class="py-5">$ <?php echo $product->pro_price * $product->pro_qty; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>                                     
                                            <th scope="row">
                                            </th>                                        
                                            <td class="py-4">
                                                <h5 class="mb-0 text-dark py-4">Cart Total :</h5>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping">
                                                    <label class="form-check-label" for="Shipping-3"><h3 class="mb-0 text-dark"> <?php if(isset($_SESSION['saleprice'])) : ?>
                                                $ <?php echo $_SESSION['saleprice']; ?>
                                            <?php endif; ?></h3></label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>                                     
                                            <th scope="row">
                                            </th>                                        
                                            <td class="py-4">
                                                <h4 class="mb-0 text-dark py-4">Shipping</h4>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping">
                                                    <label class="form-check-label" for="Shipping-3">Free Shipping: $20</label>
                                                </div>
                                            </td>
                                        </tr>                  
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <h5 class="mb-0 text-dark text-uppercase py-3">ORDER TOTAL</h5>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <h4 class="mb-0 text-dark">$ <?php echo $_SESSION['saleprice'] + 20; ?></h4>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Transfer-1" name="Transfer" value="Transfer">
                                        <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                    </div>
                                    <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Payments-1" name="Payments" value="Payments">
                                        <label class="form-check-label" for="Payments-1">Check Payments</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                        <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Paypal</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- Checkout Page End -->


<?php include_once 'footeruser.php' ; ?>