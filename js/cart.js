$(document).ready(function(){
	$(".prod-btn").click(function(e){
		e.preventDefault();
		//alert("ok");
		var prod = $(this).parent().attr("data-prod-id");
		//console.log("Product id = "+prod);
		var qty = $("[data-qty="+prod+"]").val();
		//console.log("Quantity = "+qty);
		var action = $("[data-action="+prod+"]").val();
		//console.log("Action = "+action);
		$("#cat-result").html("<img src='images/home/loading_row.gif' class='pull-right cart'>");
		cartAction(action,prod,qty);

	});

	$("[data-form] a").click(function(ev){
		ev.preventDefault();
		//console.log(ev.which);
		var link = $(this).attr('data-link');
		//console.log(link);
		var qty = $("[data-value="+link+"]").val();
		var pr = $("[data-price="+link+"]").val();
		//&#8358;
		var price = pr * qty;
		//console.log(pr+"Price"+price);
		$("[data-price-id="+link+"]").html("&#8358;"+price);
		//console.log(qty);
		$("#cat-result").html("<img src='images/home/loading_row.gif' class='pull-right cart'>");
		cartAction("edit",link,qty);
	});

	$("[data-form]").submit(function(e){
		e.preventDefault();
	});

	$("a.cart_quantity_delete").click(function(eve){
		eve.preventDefault();
		var this_prod =  $(this).attr('data-id');
		console.log(this_prod);
		cartAction("delete",this_prod);
		$("#cat-result").html("<img src='images/home/loading_row.gif' class='pull-right cart'>");
		$("[data-class="+this_prod+"]").fadeOut('slow');
		
	});
});

function cartAction(action,product_code,qty) {
	var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
				queryString = 'action='+action+'&invId='+ product_code+'&qty='+qty;
			break;
			case "edit":
				queryString = 'action='+action+'&invId='+ product_code+'&qty='+qty;
			break;
			case "delete":
				queryString = 'action='+action+'&invId='+ product_code+'&qty=';
				break;
		}
	}
	//console.log(queryString);
	jQuery.ajax({
	url: "action.php",
	data:queryString,
	type: "POST",
	success:function(data){
		if(data!=="error"){
			//console.log(data);
			alert("Cart updated successfully");
			$("#cat-result").html(data);
			$("[data-action="+product_code+"]").val('edit');
			$("[data-qty="+product_code+"]").val(qty);
			$("[data-pre="+product_code+"]").html('Update Cart');
			$("[data-btn="+product_code+"]").html('Update');
		}else{
			alert("Product already exist in your cart");
			console.log(data);
		}
	},
	error:function (){
		console.log('error');
	}
	});
}