<div class="features_item"><!--latest products-->
                        <h2 class="title text-center">Recommended Items</h2>
                        <!--start-->
                        <?php
                        //include_once 'rec.php';
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
                        ?>
                        <!-- end-->
                               
                    </div>
                </div>
                </div>