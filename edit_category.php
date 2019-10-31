<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard | E-Market ::Edit Category</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/other.css">
</head><!--/head-->
<body>
<?php
    include_once 'php/all.php';
    if(!admin()){
        header("location:index.php");
        exit();
    }
?>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Category</h4>
            </div>
            <div class="modal-body">
                <form action="" class="form" role="form" method="post">
                    <div class="form-group">
                        <label>Old category name</label>
                        <input type="text" readonly="readonly" class="form-control" placeholder="Old category name" id="old_cat" />
                    </div>
                    
                    <div class="form-group">
                        <label for="new_cat">New category name</label>
                        <input type="text" name="name" required class="form-control" placeholder="New category name" id="new_cat" />
                    </div>
                    <input type="hidden" id="cat_id" value="id" name="id">

                    <div class="form-group">
                        <input type="submit" name="ok" value="Update" class="btn btn-block btn-success">
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
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
                    <div class="col-sm-12">
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
                                <li><a href="dashboard.php">Admin Dashboard</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.php">All Products</a></li>
                                    </ul>
                                </li> 
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <div class="container">
        <h2 class="title">admin dashboard</h2>
        <div class="row">
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-8">
                
                <?php
                    if(isset($_POST["ok"])){
                        $id = $_POST["id"];
                        $name = $_POST["name"];

                        $up = "UPDATE categories SET name='$name' WHERE id='$id'";
                        $query = mysql_query($up) or die(mysql_error());

                        if($query){
                            echo "<div class='alert alert-success'>Category updated successfully</div>";
                        }else{
                            echo "<div class='alert alert-warning'>Oops, the category does not exists</div>";
                        }
                    }

                ?>
            </div>
            <div class="col-sm-2">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-sm-4 pull-left admin-left">
                <h4 align="center">
                    Admin Menu
                </h4>
                <ul>
                    <li><a href="add_product.php">Add Inventory</a></li>
                    <li><a href="edit_product.php">Edit Inventory</a></li>
                    <li><a href="add_category.php">Add Category</a></li>
                    <li><a href="edit_category.php" class="active">Edit Category</a></li>
                    <li><a href="admin-shop.php">View All Invetory</a></li>
                </ul>
            </div><!--left-->

            <div class="col-sm-8 pull-right admin-right">
                <?php
                    $sql = mysql_query("SELECT * FROM categories") or die(mysql_error());
                    $total = mysql_num_rows($sql);
                    if($total==0){
                        echo "<p>No Category </p>";
                    }else{
                        echo "<b>Click on the name of the category you want to edit</b>";
                        while($rs=mysql_fetch_assoc($sql)){
                            ?>
                                <div class="cat">
                                    <a data-toggle="modal" href='#modal-id' class="cat_a" data-name="<?php echo $rs['name'];?>" data-id="<?php echo $rs['id'];?>">
                                        <i class="fa fa-briefcase"></i> <?php echo $rs['name'];?>
                                    </a>
                                </div>
                            <?php
                        }
                    }//category
                ?>
            </div>
        </div>
    </div>

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