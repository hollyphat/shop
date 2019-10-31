<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Market</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/other.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
</head><!--/head-->
<body>
<?php
    include_once 'php/all.php';
    include_once 'nav.php';
?>
<!--Login--><div class="fixed">
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" align="center">Login</h4>
                </div>
                <div class="modal-body">
                <h3 align="center">Login to your account</h3>
                <div class="signup-form"><!--log up form-->
                    <form action="login_process.php" method="post" class="form">
                        <div class="form-group">
                            <label for="username">
                                User id <em class="text-warning">*</em>
                            </label>
                            <input type="text" name="username" placeholder="Enter your user id" required>
                        </div>

                        <div class="form-group">
                            <label for="password">
                                Password <em class="text-warning">*</em>
                            </label>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="checkbox" name="auto" id="auto_log">
                                </div>
                            <div class="col-sm-10">
                                <label for="auto_log">Remember me (<em>Do not check on a shared computer</em>)</label>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info" name="login">Login</button>
                        </div>

                        <span class="text-warning"> * All Fields are required!!!</span>

                    </form>
                </div>
                </div>
            
            </div>
        </div>
    </div>
</div><!--Login-->
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
                                <li><a data-toggle="modal" href='#modal-id' id="login"><i class="fa fa-lock"></i> Login</a></li>
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

<section id="slider"><!--slider-->
        <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php info(); ?>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-MARKET</h1>
                                    <h2>Welcome to E-Market</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png"  class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-MARKET</h1>
                                    <h2>Welcome to E-Market</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png"  class="pricing" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-MARKET</h1>
                                    <h2>Featured Product</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png" class="pricing" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->


    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2 class="title text-center">All Categories</h2>
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
                    
                </div><!--/category-products-->


                <?php
                    $ds = mysql_query("SELECT * FROM inventory ORDER BY id DESC LIMIT 12") or die(mysql_error());
                    $dt = mysql_num_rows($ds);
                    if($dt <= 0){
                        echo "No inventory in the database";
                    }else{
                ?>

                <div class="col-sm-9 padding-left">
                    <div class="features_item"><!--latest products-->
                        <h2 class="title text-center">Latest Products</h2>
                        <!--start-->
                        <?php
                            if(loggedin()){

                            while($rs=mysql_fetch_assoc($ds)){
                                if($rs["img"]!=""){
                                    $img = "images/products/".$rs["img"];
                                }else{
                                    $img = "images/home/no_image.png";
                                }
                        ?>
                        <div class="col-sm-4 pull-left">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo $img;?>" alt="<?php echo $img;?>" />
                                            <h2>&#8358;<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            
                                        </div>
                                        <div class="product-overlay">
                                            <?php
                                                $sid = session_id();
                                                $ppid = $rs['id'];
                                                $qs = mysql_query(
                                                    "SELECT * FROM carttemp WHERE sess='$sid' and invId='$ppid'") or die(mysql_error());
                                                $qq = mysql_num_rows($qs);

                                                if($qq==0){
                                                    ?>
                                            <div class="overlay-content">
                                            <h2>#<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            <form action="action.php" method="post" data-prod-id="<?php echo $rs['id'];?>">
                                            <center><pre style="width:80%;" data-pre="<?php echo $rs['id'];?>">Add to cart</pre></center>
                                            <input type="hidden" name="invId" data-inv-id="<?php echo $rs['id'];?>" value="<?php echo $rs['id'];?>">
                                            <input type="hidden" name="action" value="add" data-action="<?php echo $rs['id'];?>">
                                            <input type="text" pattern="[0-9]+" data-qty="<?php echo $rs['id'];?>" name="qty" id="qty" placeholder="Quantity" class="qty" required />
                                            <button type="submit" class="btn btn-default add-to-cart prod-btn" data-btn="<?php echo $rs['id'];?>"><i class="fa fa-shopping-cart"></i>
                                            Add
                                            </button>
                                            </form>
                                            </div>
                                            
                                                    <?php
                                                }else{
                                                    $qtt = mysql_fetch_assoc($qs);
                                                    $qtyy = $qtt["qty"];
                                                    ?>
                                                <div class="overlay-content">
                                                <h2>#<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            <form action="action.php" method="post" data-prod-id="<?php echo $rs['id'];?>">
                                            <center><pre style="width:80%;">Update cart</pre></center>
                                            <input type="hidden" name="invId" data-inv-id="<?php echo $rs['id'];?>" value="<?php echo $rs['id'];?>">
                                            <input type="hidden" name="action" value="edit" data-action="<?php echo $rs['id'];?>">
                                            <input type="text" value="<?php echo $qtyy;?>" pattern="[0-9]+" data-qty="<?php echo $rs['id'];?>" name="qty" id="qty" placeholder="Quantity" class="qty" required />
                                            <button type="submit" class="btn btn-default add-to-cart prod-btn"><i class="fa fa-shopping-cart"></i>
                                            Update
                                            </button>
                                            </form>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <img src="images/home/new.png" class="new" alt="" />
                                </div>
                                <div class="choose">
                                    &nbsp;
                                </div>
                            </div>
                        </div><!--end col-sm-4-->
                        <?php
                            }//end while //end login
                        }else{


                            while($rs=mysql_fetch_assoc($ds)){
                                if($rs["img"]!=""){
                                    $img = "images/products/".$rs["img"];
                                }else{
                                    $img = "images/home/no_image.png";
                                }
                        ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo $img;?>" alt="<?php echo $img;?>" />
                                            <h2>&#8358;<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                            <h2>#<?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></h2>
                                            <label class='alert alert-warning'>You need to login first</label>
                                            <p><?php echo $rs["InvName"]; ?></p>
                                            </div>
                                            
                                        </div>
                                    <img src="images/home/new.png" class="new" alt="" />
                                </div>
                                <div class="choose">
                                </div>
                            </div>
                        </div><!--end col-sm-4-->
                        <?php
                            }//end while




                        }
                        ?>
                        <!-- end-->
                    </div>
                </div>
                <?php
                    }//end else
                ?>
            </div>

            <div class="row">
            <!--Start-->

            <?php
                    $ds = mysql_query("SELECT * FROM inventory ORDER BY RAND() LIMIT 4") or die(mysql_error());
                    $dt = mysql_num_rows($ds);
                    if($dt <= 0){
                        echo "No inventory in the database";
                    }else{
                ?>

                <div class="col-sm-3 padding-left"></div>

                <div class="col-sm-9 padding-right">
                <?php
                    include_once 'rec.php';
                ?>                    
                </div>
                <?php
                    }//end else
                ?>
            </div>

            <!--end-->
        </div>
        <?php 
            //include_once 'rec.php';
        ?>



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
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/login.js"></script>
</body>
</html>