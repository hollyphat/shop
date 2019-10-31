<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard | E-Market :: View All Products</title>
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
            <div class="col-sm-12">
                <?php
                    if(isset($_POST["del"])){
                        //$prod_sel = $_POST["prod"];
                        //print_r($_POST);
                        if(isset($_POST["prod"])){
                            $prod_sel = $_POST["prod"];
                            //print_r($prod_sel);
                            $t = 0;
                            foreach ($prod_sel as $key) {
                                # code...
                                $check_img = mysql_query("SELECT img FROM inventory WHERE id='$key'");
                                $total_img = mysql_num_rows($check_img);
                                if($total_img>=1){
                                    $im = mysql_fetch_assoc($check_img);
                                    $im2 = $im["img"];
                                    if(strlen($im2)>=1){
                                        //img exist
                                        $immg = "images/products/".$im2;
                                        //exit();
                                        unlink($immg);
                                    }
                                }
                                $sql = "DELETE FROM inventory WHERE id='$key'";
                                $que = mysql_query($sql) or die(mysql_error());
                                if(mysql_affected_rows()>=1){
                                    $t++;
                                }
                            }
                            if($t>=1){
                                echo "<div class='alert alert-success text-center'>The marked inventories deleted successfully";
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                echo "</div>";
                            }else{
                                echo "<div class='alert alert-danger text-center'>Inventories does not exist";
                                echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                echo "</div>";
                            }
                        }
                        //exit();
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 pull-left admin-left">
                <h4 align="center">
                    Admin Menu
                </h4>
                <ul>
                    <li><a href="add_product.php">Add Inventory</a></li>
                    <li><a href="edit_product.php">Edit Inventory</a></li>
                    <li><a href="add_category.php">Add Category</a></li>
                    <li><a href="edit_category.php">Edit Category</a></li>
                    <li><a href="admin-shop.php" class="active">View All Invetory</a></li>
                </ul>
            </div><!--left-->

            <div class="col-sm-9 pull-right admin-right">
                    <h2 class="title text-center">All Products</h2>
                    <?php
                        $query = mysql_query("SELECT * FROM inventory")
                            or die(mysql_error());
                            $query_total = mysql_num_rows($query);
                            if($query_total==0){
                                //error
                                echo "Sorry, no product yet";
                            }else{
                                //ok
                                ?>
                        <form action="" method="post" class="form form-prod"><!--start-->
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Date Added</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        //include_once 'rec.php';
                        $i = 1;
                            while($rs=mysql_fetch_assoc($query)){
                        ?>
                                <tr data-prod="<?php echo $rs["id"];?>">
                                    <td><?php echo $i;?></td>
                                    <td><label for="prod<?php echo $rs["id"];?>"><?php echo $rs["InvName"]; ?></label></td>
                                    <td>&#8358; <?php echo number_format($rs['InvPrice'], 2, '.', '  ');?></td>
                                    <td><?php
                                        echo $rs["DateAdded"];
                                    ?></td>
                                    <td>
                                        <input id="prod<?php echo $rs["id"];?>" type="checkbox" name="prod[]" value="<?php echo $rs["id"];?>" class="form-control">
                                    </td>
                                </tr>
                        <?php
                            $i++;
                            }//end while
                            echo "<div class='form-group'>";
                            echo "<input type='submit' name='del' value='Delete Selected' class='btn btn-block btn-danger' />";
                            echo "</div>";
                        }
                        ?>
                        <!-- end-->
                        </tbody>
                    </table>
                    <div class='form-group'>
                        <input type='submit' name='del' value='Delete Selected' class='btn btn-block btn-danger' />
                    </form>
                    </div>
                    </div>

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
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".form-prod :input").change(function(){
                var state = $(this).prop("checked");
                var val = $(this).val();
                //console.log(state);
                if(state){
                   $("[data-prod="+val+"]").attr("class","danger");
                }else{
                   $("[data-prod="+val+"]").attr("class","");
                }
            });

            $("[name=del]").click(function(){
                var c = confirm("Are you sure you want to delete the marked inventory?");
                if(c==false){
                    return false;
                }
            });
        });
    </script>
</body>
</html>