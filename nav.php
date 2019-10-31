<link rel="stylesheet" type="text/css" href="css/other.css" />
<nav id="fixedbar">
  <ul id="fixednav">
    <li><a href="index.php">Home</a></li>
    <li><a href="checkout.php">Checkout</a></li>
    <li><a href="cart.php">Cart</a></li>
    <li id="cat-result"><a href="#" class="pull-right cart"><i class="fa fa-large fa-shopping-cart"></i> <span><?php echo cart();?> <?php if(cart()>1){echo "Items "; }else{ echo "Item ";}?> - &#8358; <?php echo price(session_id()); ?></span></a></li>
  </ul>
</nav>