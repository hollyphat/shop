<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User Account | E-Market :: View History</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->
<body>
<?php
    include_once 'php/all.php';
    include_once 'nav.php';
    if(!loggedin()){
        header("location:index.php");
        exit();
    }
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
                                <li><a href="index.php" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php">All Products</a></li>
                                        <li><a href="checkout.php">Checkout</a></li> 
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
                                <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
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
            <div class="row">
                <div class="col-sm-8">
                <div class="btn-group">
                <a href="index.php" class="btn btn-default">Home</a>
                <a href="account.php" class="btn btn-default">Account</a>
                <a href="profile.php" class="btn btn-default">Edit Profile</a>
                <a href="histoty.php" class="btn btn-default active">Purchase History</a>
                                </div>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
            <p>&nbsp;</p>
        </div>
    <!--        <div class="row">-->
                <div class="col-sm-12">
                    <h2 class="title text-center">Purchase History</h2>

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
                        $order_id = $_GET["id"];
                        $uid = user("id");
                        $sql = "SELECT * FROM orders WHERE orderid='$order_id'";
                        $query = mysql_query($sql) or die(mysql_error());
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
                </div>
            <!--</div>-->
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
</body>
</html>
