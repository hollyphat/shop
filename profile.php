<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Profile | E-Market</title>
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

    <section class="main">
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
                <a href="profile.php" class="btn btn-default active">Edit Profile</a>
                <a href="history.php" class="btn btn-default">Purchase History</a>
                </div>
                </div>
                <div class="col-sm-4">&nbsp;</div>
            </div>
            <p>&nbsp;</p>
        </div>
    
            <div class="row">
                <div class="col-sm-3 padding-left">
                    <h2 class="title text-center">User Menu</h2>    
                </div>

                <div class="col-sm-9 padding-right admin-right profile">
                    <h2 class="title text-center">Edit Profile</h2>
                    <form action="profile_update.php" method="post" role="form">
                        <fieldset>
                            <legend>Personal Information</legend>
                        </fieldset>
                    <div class="row">
                        <div class="col-sm-4"><label>User id</label></div>
                        <div class="col-sm-8"><?php echo user("UserId");?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="password">Password</label></div>
                        <div class="col-sm-5">
                        <input type="password" id="pass" value="<?php echo user("Password");?>" required name="password" />
                        </div>
                        <span class="col-sm-3">
                            <input type="checkbox" id="show_pass"> Show Password
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="fname">First Name</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="fname" required value="<?php echo user("FirstName");?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="lname">Last Name</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="lname" required value="<?php echo user("LastName");?>" >
                        </div>
                    </div>
                    <legend>Contact Information</legend>

                    <div class="row">
                        <div class="col-sm-4"><label for="">Phone Number</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="phone" required value="<?php echo user("Phone");?>" >
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4"><label for="">Email Address</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="email" required value="<?php echo user("Email");?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="">Contact Address</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="address" required value="<?php echo user("Address");?>" >
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4"><label for="">City</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="city" required value="<?php echo user("City");?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="">State</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="state" required value="<?php echo user("State");?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4"><label for="">Zip code</label></div>
                        <div class="col-sm-8">
                            <input type="text" name="zip" required value="<?php echo user("Zip");?>" >
                        </div>
                    </div>

                    <br />
                    <input type="submit" name="ok" value="Update" class="btn btn-block btn-success">
                    </form>
                </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#show_pass").change(function(){
                var state = $(this).prop("checked");
                //console.log(state);
                if(state){
                    $("#pass").attr("type","text");
                }else{
                    $("#pass").attr("type","password");
                }
            });
        });
    </script>
</body>
</html>