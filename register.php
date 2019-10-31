<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register | E-Market</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
<?php
    include_once 'php/all.php';
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
                                <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a href="register.php"><i class="fa fa-user"></i> Register</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <section id="form"><!--Register-->
    <div align="center">
        <img src="images/home/register.png" class="img-responsive img-thumbnail" alt="Register">
    </div>
        <div class="container">
        
        <?php
            if(isset($_POST["reg"])){
                //print_r($_POST);

                extract($_POST);
                $username = clean($username);
                $password = clean($password);
                $cpassword = clean($cpassword);
                $firstname = clean($firstname);
                $lastname = clean($lastname);
                $address = clean($address);
                $city = clean($city);
                $zip = clean($zip);
                $state = clean($state);
                $email = clean($email);
                $phone = clean($phone);

                $error = array();

                if(strlen($username) < 5){
                    $error[] = "User id must be at least five character";
                }

                $sql = mysql_query("SELECT NULL from customer WHERE UserId='$username'")
                        or die(mysql_error());
                        $total = mysql_num_rows($sql);
                if($total >= 1){
                    $error[] = $username." is already taken, please try another one";
                }

                $sql2 = mysql_query("SELECT NULL from customer WHERE Email='$email'")
                        or die(mysql_error());
                        $total2 = mysql_num_rows($sql2);
                
                $em = explode($email, "@");

                if(count($em) != 1){
                    $error[] = "Invalid email address";
                }

                if(strlen($email)<15){
                    $error[] = "Email is too short";
                }

                if($total2>=1){
                    $error[] = "Email already exist in our database, please try again";
                }

                $sql3 = mysql_query("SELECT NULL from customer WHERE Phone='$phone'")
                        or die(mysql_error());
                        $total3 = mysql_num_rows($sql3);
                
                if($total3 >= 1){
                    $error[] = "Phone number already exist in our database, please try again";
                }

                if(!is_numeric($phone) || strlen($phone)<11){
                    $error[] = "Invalid phone number";
                }

                if(count($error) >= 1){
                    //display error message
                    //print_r($error);
                    echo "<hr/>";
                    echo "<center>";
                    echo "<div class='row img-thumbnail' align='center'>";
                    echo "<h4 align='center'>The Following Errors occur during your registration</h4>";
                    foreach ($error as $key) {
                        # code...
                        echo "<div align='center'>";
                        echo "<h4 class='text-warning'>$key</h4>";
                        
                    }
                    echo "<a href='register.php'>Try again</a>";
                    echo "</div>";
                    echo "</center>";
                }else{
                    //saved
                    //echo "Registration successfull";
                    $insert = "INSERT INTO customer VALUES('','$username','$password','$firstname','$lastname',
                        '$address','$city','$zip','$state','$email','$phone')";
                    $query = mysql_query($insert) or die(mysql_error());

                    echo "<div class='row'>";
                    echo "<div class='col-sm-12' align='center'>";
                    echo "<img src='images/home/reg.png' >";
                    echo "<p class='text-success'>";
                    echo "Your Registration was successfull, you can now login to enjoy un ending services</p>";
                    echo "</div></div>";
                    

                }

                //exit();//end form

        ?>
        <div>
            
        </div>
        <?php 
        }else{
        ?>
            <div class="row">
                <div class="col-sm-12">
                <div class="signup-form"><!--sign up form-->
                <h2>Register a new account!!!</h2>
                <form action="register.php" method="post" enctype="" class="form">
                    <div class="form-group">
                        <label for="username" class="sr-only">User id</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="username" id="username" 
                                placeholder="Enter your new user id" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_name" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="password" class="sr-only">User id</label>
                    <div class="row">
                        <div class="col-sm-7">
                        <input type="password" name="password" required id="password" placeholder="Enter your new password" />
                        </div>
                        <div class="col-sm-5">
                            <span id="check_password" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="cpassword" class="sr-only">User id</label>
                    <div class="row">
                        <div class="col-sm-7">
                        <input type="password" required name="cpassword" id="cpassword" placeholder="Confirm your new password" />
                        </div>
                        <div class="col-sm-5">
                        <span id="check_cpassword" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="fname" class="sr-only">First name</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="firstname" id="fname" 
                                placeholder="Firstname" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_fname" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="sr-only">Last name</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="lastname" id="lname" 
                                placeholder="Last name" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_lname" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="sr-only">Contact Address</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="address" id="address" 
                                placeholder="Contact Address" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_address" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="sr-only">City</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="city" id="city" 
                                placeholder="City" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_city" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip" class="sr-only">Zip Code</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="zip" id="zip" 
                                placeholder="Zip code" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_zip" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="sr-only">State</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <select name="state" id="state" required>
                                    <option value="">Select State</option>
                                    <script type="text/javascript">
                                        var states = new Array('Lagos','Oyo','Adamawa','Yobe','Taraba','FCT','Kogi','Benue','Bayelsa','Abia','Enugu','Ebonyi','Ekiti','Jigawa','Ogun','Osun','Kwara','Delta','Edo','Niger','Borno','Sokoto','Kaduna','Kano','Kebbi','Cross Rivers','Rivers','Katsina','Zamfara','Ondo','Akwa Ibom','Anambra','Bauchi','Imo','Plateau');
                                        states = states.sort();
                                        var g = 0;
                                        while(g<states.length){
                                                document.write("<option value=" + states[g] + ">" + states[g] + "</option>");
                                            g++;
                                        }
                                  </script>
                  
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <span id="check_state" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="sr-only">Email Address</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="email" name="email" id="email" 
                                placeholder="Email Address" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_email" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="sr-only">Phone Number</label>
                        <div class="row">
                            <div class="col-sm-7">
                                <input type="text" name="phone" id="phone" 
                                placeholder="Phone Number" required />
                            </div>
                            <div class="col-sm-5">
                                <span id="check_phone" class="text-muted"><i class="glyphicon glyphicon-question-sign"></i></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="reg">Register</button>
                    
                    </form>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </section><!--Register-->


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
    <script src="js/reg.js"></script>
</body>
</html>