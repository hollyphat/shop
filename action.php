<?php
include_once 'php/all.php';
$sess =  session_id();
$pid = $_POST["invId"];
$qty = $_POST["qty"];
$action = $_POST["action"];

if($action=="add"){
	$sql = mysql_query("SELECT * FROM carttemp WHERE sess='$sess' AND invId='$pid'")
		or die(mysql_error());
		$tot = mysql_num_rows($sql);

		if($tot==0){
			//ok
			$insert = "INSERT INTO carttemp (sess,invId,qty) VALUES('$sess','$pid','$qty')";
			$query = mysql_query($insert) or die(mysql_error());
			?>
			<a href="#" class="pull-right cart"><i class="fa fa-large fa-shopping-cart"></i> <span><?php echo cart();?> <?php if(cart()>1){echo "Items "; }else{ echo "Item ";}?> - &#8358; <?php echo price(session_id()); ?></span></a>
				<?php

		}else{
			echo "error";
		}
}else if($action=="edit"){
	$sql = mysql_query("SELECT * FROM carttemp WHERE sess='$sess' AND invId='$pid'")
		or die(mysql_error());
		$tot = mysql_num_rows($sql);

		if($tot>=1){
			//ok
			//$insert = "INSERT INTO carttemp (sess,invId,qty) VALUES('$sess','$pid','$qty')";
			$update = "UPDATE carttemp SET qty ='$qty' WHERE sess='$sess' AND invId='$pid'";
			$query = mysql_query($update) or die(mysql_error());
			?>
			<a href="#" class="pull-right cart"><i class="fa fa-large fa-shopping-cart"></i> <span><?php echo cart();?> <?php if(cart()>1){echo "Items "; }else{ echo "Item ";}?> - &#8358; <?php echo price(session_id()); ?></span></a>
			<?php

		}else{
			//echo "error";

		}
}else if($action=="delete"){
	//delete
	$del = "DELETE FROM carttemp WHERE sess='$sess' AND invId='$pid'";
	$query = mysql_query($del);
	?>
	<a href="#" class="pull-right cart"><i class="fa fa-large fa-shopping-cart"></i> <span><?php echo cart();?> <?php if(cart()>1){echo "Items "; }else{ echo "Item ";}?> - &#8358; <?php echo price(session_id()); ?></span></a>
	<?php
}

?>