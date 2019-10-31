<!DOCTYPE html>
<html lang="en">
<head>
<?php
    if(!isset($_GET["id"])){
        header("location:index.php");
        exit();
    }
    include_once 'php/all.php';
    $id = $_GET["id"];
    $id = preg_replace("#[A-Za-z]+#", "", $id);

    $sql = mysql_query("SELECT * FROM inventory WHERE id='$id'") or die(mysql_error());;
    $total_c = mysql_num_rows($sql);
    if($total_c==0){
        header("location:index.php");
        exit();
    }
    $ds = mysql_fetch_assoc($sql);
    $title = $ds["InvName"];
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?> | E-Market :: Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/other.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->
<body>
<?php
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
                                <?php
                                if(loggedin()){

                                ?>
                                <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                                <?php
                                }else{
                                    ?>
                                <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section class="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-8">
                <?php info(); ?>
            </div>
            <div class="col-sm-2">&nbsp;</div>
        </div>
            <div class="row">
                <!--category-->
                <div class="col-sm-3 padding-left">
                    <div class="left-sidebar">
                        <h3 style="background:#333; color:#fff; text-align:center; margin-bottom:0;">All Categories</h3>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        
                        <?php

                        $sql = "SELECT * FROM categories ORDER BY name ASC";
                        $query = mysql_query($sql) or die(mysql_error());
                        $total = mysql_num_rows($query);
                        if($total==0){
                            echo "No Categories";
                        }else{
                            while(@$rs=mysql_fetch_assoc($query)){
                        ?>
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    
                                    <a href="category.php?id=<?php echo $rs['id']?>"><?php echo $rs['name'];?></a>
                                    </h4>

                                </div>
                        </div>
                        <?php 
                            }//end while
                        }//end if
                        ?>
                    </div>
                    </div>
                    <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                </div>
                <!--product-->
                <div class="col-sm-9 padding-right">
                <?php
                    if($ds["img"]!=""){
                                    $img = "images/products/".$ds["img"];
                                }else{
                                    $img = "images/home/no_image.png";
                                }
                ?>
                <h2 class="title text-center"><?php echo $title;?></h2>
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php echo $img;?>" alt="" width="90%" />
                            </div>
                    </div><!--cols 5-->
                    <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="images/home/new.jpg" class="newarrival" alt="" />
                                <h2><?php echo $title;?></h2>
                                <img src="images/home/stars_5.png" alt="" />
                                <span>
                                    <span>NGN &#8358; <?php echo $ds["InvPrice"];?></span>
                                    <?php
                                        if(loggedin()){

                                    ?>
                                    <label>Quantity:</label>
                                    <?php //check if the product does not exist
                                        $sid = session_id();
                                        $pid = $_GET["id"];
                                        $search = "SELECT * FROM carttemp WHERE sess='$sid' AND invId='$pid'";
                                        $check = mysql_query($search) or die(mysql_error());
                                        $tot = mysql_num_rows($check);
                                        if($tot==0){//if no record start

                                    ?>
                                    <form action="add.php" method="post">
                                    <em>Add to Cart</em>
                                    <input type="hidden" name="invId" value="<?php echo $ds["id"]; ?>">
                                    <input type="hidden" name="action" value="add">
                                    <input type="text" name="qty" value="" required />
                                    <button type="submit" class="btn btn-default cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                    </form>
                                    <?php //if no end
                                        }else{//update and delete starts
                                            $rec = mysql_fetch_assoc($check);
                                            $qty = $rec["qty"];
                                            ?>
                                            <form action="add.php" method="post">
                                            <em>Edit Cart</em>
                                            <input type="hidden" name="invId" value="<?php echo $ds["id"]; ?>">
                                            <input type="hidden" name="action" value="edit">
                                            <input type="text" name="qty" value="<?php echo $qty;?>" required />
                                            <button type="submit" class="btn btn-default cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Update cart
                                            </button>
                                            </form>
                                    
                                            <?php
                                        }//update and delete ends //logged in ends
                                    }else{
                                        echo "<label class='alert alert-warning'>You need to login first</label>";
                                    }
                                    ?>
                                </span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                            </div><!--/product-information-->
                        </div>
                    </div><!--prod details-->

                        <div class="col-sm-12">
                            <h2 class="title">Product Details</h2>
                                <div class="col-sm-8">
                                <h4>Description</h4>
                                    <?php
                                        echo $ds["InvDescription"];
                                    ?>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Category:  <?php echo category($ds["category"]);?></h5>
                                    <h5>Date Added: <?php echo $ds["DateAdded"];?></h5>
                                </div>
                        </div>

                        <div class="features_item"><!--latest products-->
                        <h2 class="title text-center">Recommended Items</h2>
                        <!--start-->
                        <?php
                        //include_once 'rec.php';
                        $ds = mysql_query("SELECT * FROM inventory ORDER BY RAND() LIMIT 4") or die(mysql_error());
                            $dt = mysql_num_rows($ds);
                            if($dt <= 0){
                                echo "No inventory in the database";
                            }else{
                            while($rs=mysql_fetch_assoc($ds)){
                                if($rs["img"]!=""){
                                    $img = "images/products/".$rs["img"];
                                }else{
                                    $img = "images/home/no_image.png";
                                }
                        ?>
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo $img;?>" alt="<?php echo $img;?>" />
                                            <h2>&#8358;<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            <a href="product.php?id=<?php echo $rs['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }//end while
                        }//end else
                        ?>
                        <!-- end-->
                               
                    </div>
                        
                </div><!--col 7-->
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
</body>
</html>