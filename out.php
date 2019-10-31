<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | E-Market</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
</head><!--/head-->
<body>
<?php
    include_once 'php/all.php';
    if(!loggedin()){
        header("location:index.php");
        exit();
    }
    $sid =session_id();
    $c = "SELECT * FROM carttemp WHERE sess='$sid'";
    $q = mysql_query($c);
    $t = mysql_num_rows($q);
    if($t <= 0){
        $_SESSION["info"] = "You currently have no product in your cart , kindly order for a product now";
        header("location:index.php");
        exit();
    }
    if(!isset($_POST["ok"])){
        header("location:index.php");
        exit();
    }

    $name = $_POST["name"];
    $address = $_POST["address"];

    if(strlen($name)==0){
        $name = user("UserId");
    }

    if(strlen($address)==0){
        $address = user("Address");
    }
    
    $_SESSION["shipname"] = $name;

    $_SESSION["shipadd"] = $address;


    $uid = user("id");

    $total_amt = $_SESSION["cart_sub_total"]; 

    //1)insert details into order_details
    $date = time();
    $in = "INSERT INTO order_details VALUES('','$uid','$total_amt','$name','$address','$date')";
    $qu = mysql_query($in) or die("Error ".mysql_error());
    $order_id = mysql_insert_id();
    $_SESSION['orderids'] = $order_id;
    
    //2) Insert Info into orderdet
    //find the correct cart information being temporarily stored
    //put the data into the database one row at a time
    
    while ($rows = mysql_fetch_array($q)) {
    extract ($rows);
    $query4 = "INSERT INTO orders (qty, prodnum, orderid) VALUES (
    '$qty',
    '$invId',
    '$order_id')";
    $insert4 = mysql_query($query4)
    or die(mysql_error());
    }

    //3)delete from temporary table
    $query="DELETE FROM carttemp WHERE sess='$sid'";
    $delete = mysql_query($query);

    include_once 'nav.php';
?>
    <header id="header"><!--header-->
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.php"><img src="images/home/logo.png" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    NGA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USA</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    Naira
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                   <div class="col-sm-8">
                        <form action="search.php" method="get"><div class="search_box pull-right">
                            <input type="text" name="q" required placeholder="Search for products here......."/>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="index.php">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php">All Products</a></li>
                                        <li><a href="checkout.php" class="active">Checkout</a></li> 
                                        <li><a href="cart.php">Cart</a></li> 
                                    </ul>
                                </li> 
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="cart.php" class="active"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section class="main" id="cart_items">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php info(); ?>
                </div>
            </div>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="cart.php">Shopping Cart</a></li>
                    <li>Checkout</li>
                </ol>
            </div>
            
                <div class="col-sm-12">
                    <div class="alert alert-info">Your order has been sent successfully!!!</div>
                    <div class="review-payment">
                <h2>Here is a recap of your Order</h2>
            </div>


                    <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image" width="25%">Item</td>
                            <td class="description" width="30%"></td>
                            <td class="price" width="20%">Price</td>
                            <td class="quantity" width="10%">Quantity</td>
                            <td class="total" width="15% ">Total</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sess = session_id();
                        $sql = "SELECT * FROM orders WHERE orderid='$order_id'";
                        $query = mysql_query($sql);
                        $total = mysql_num_rows($query);
                            $cart_p = 0;
                            while($rs=mysql_fetch_assoc($query)){
                                $invId = $rs["prodnum"];
                                $prod = mysql_query("SELECT * FROM inventory WHERE id='$invId'")
                                    or die(mysql_error());
                                $ds=mysql_fetch_assoc($prod);
                                if($ds["img"]!=""){
                                    $img = "images/products/".$ds["img"];
                                }else{
                                    $img = "images/home/no_image.png";
                                }
                            ?>
                                <tr class="" data-class="<?php echo $ds['id'];?>">
                            <td class="cart_product">
                                <a href="product.php?id=<?php echo $ds['id'];?>"><img class="img-thumbnail" src="<?php echo $img;?>" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="product.php?id=<?php echo $ds['id'];?>"><?php echo $ds['InvName'];?></a></h4>
                            </td>
                            <td class="cart_price">
                                <p>&#8358;<?php echo number_format($ds["InvPrice"],2,"."," ");?></p>
                            </td>
                            <td class="cart_quantity">
                               <p><?php echo $rs['qty'];?></p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" data-price-id="<?php echo $ds['id'];?>">
                                    &#8358;<?php $tot = $ds["InvPrice"] * $rs["qty"];
                                    echo $num = number_format($tot,2,"."," ");
                                    $cart_p += $tot;
                                    ?>
                                </p>
                            </td>
                                </form>
                        </tr>

                            <?php
                            }//end while
                            $_SESSION["cart_t"] = $cart_p;
                            ?>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>&#8358; <?php echo number_format($cart_p,2,"."," ");?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td>
                                            &#8358; <?php
                                                $tax = 0.05 * $cart_p;
                                                $_SESSION["tex"] = $tax;
                                                echo number_format($tax,2,"."," ");
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>                                       
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <?php
                                            $gtotal = $cart_p + $tax;
                                            $_SESSION["gtotal"] = $gtotal;
                                        ?>
                                        <td><span>&#8358; <?php echo number_format($gtotal,2,"."," ");?></span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    </div><!--restable-->

                                <div class="row">
            <div class="register-req">
                <p>Shopping Information Details </p>
            </div><!--/register-req-->

            <div class="shopper-informations">
            <div class="col-sm-4">
                <img src="images/home/shipping.jpg">
                </div>
                <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <div class="shopper-ino">
                    <p>Shipping Information</p>
                        <div>
                        <label for="name">Receiver Name:</label>
                            <?php echo $name; ?>
                        </div>
                        <div class="form-group">
                            <label for="name">Receiver Address:</label>
                            <?php echo $address; ?>
                        </div>
                        
                </div>
                </div>
            </div>

                </div>

            </div>

            <div class="row">
                    <div class="col-sm-3">&nbsp;</div>
                <div class="col-sm-6">
                    <a href="receipt.php" target="_BLANK" class="btn btn-block btn-success">Download Invoice</a>
                </div>
                <div class="col-sm-3">&nbsp;</div>

            </div>
            
        </div>

    </section>


    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            &nbsp;
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Top Categories</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <?php categories(); ?>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="col-sm-5">
                        <div class="single-widget">
                            <h2>Newsletter</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get updates on new products from us subscribe to our newsletter...</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                                    <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +234 813 225 2779</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </footer><!--/Footer-->
    

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
</body>
</html>