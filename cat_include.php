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
                    
                </div><!--/category-products-->
