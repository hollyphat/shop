//register page javascript

$(document).ready(function(){
	
	$("#username").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 5){
			$("#check_name").attr("class","text-danger");
			$("#check_name").html('<i class="fa fa-warning"></i> User id must be at least five characters');
		}else{
			$("#check_name").attr("class","text-success");
			$("#check_name").html('<i class="glyphicon glyphicon-ok-sign"></i>');

		}
	});

	$("#password").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 5){
			$("#check_password").attr("class","text-danger");
			$("#check_password").html('<i class="fa fa-warning"></i> Password must be at least five characters');
		}else{
			$("#check_password").attr("class","text-success");
			$("#check_password").html('<i class="glyphicon glyphicon-ok-sign"></i>');
		}
	});

	$("#cpassword").blur(function(){
		var pass = $("#password").val();
		var cpass = $(this).val();
		//console.log(size);
		if(cpass==""){
			$("#check_cpassword").html('<i class="fa fa-warning"></i> Field must not be empty').attr("class","text-danger");
		}
		else if(pass !== cpass){
			$("#check_cpassword").html('<i class="fa fa-warning"></i> Password does not match').attr("class","text-danger");
		}else{
			$("#check_cpassword").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});


	$("#fname").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 3){
			$("#check_fname").html('<i class="fa fa-warning"></i> First name must be at least five characters').attr("class","text-danger");
		}else{
			$("#check_fname").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});


	$("#lname").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 3){
			$("#check_lname").html('<i class="fa fa-warning"></i> Last name must be at least five characters').attr("class","text-danger");
		}else{
			$("#check_lname").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});

	$("#email").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 15){
			$("#check_email").html('<i class="fa fa-warning"></i> Email Address must be at least fifteen characters').attr("class","text-danger");
		}else{
			$("#check_email").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});

	$("#phone").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size !== 11){
			$("#check_phone").html('<i class="fa fa-warning"></i> Phone number must be 11 characters').attr("class","text-danger");
		}else{
			$("#check_phone").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});

	$("#address").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 5){
			$("#check_address").html('<i class="fa fa-warning"></i> Contact must be at least ten characters').attr("class","text-danger");
		}else{
			$("#check_address").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});


	$("#zip").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 6){
			$("#check_zip").html('<i class="fa fa-warning"></i> Zip code must be at least six characters').attr("class","text-danger");
		}else{
			$("#check_zip").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});


	$("#state").blur(function(){
		if($(this).val() == ""){
			$("#check_state").html('<i class="fa fa-warning"></i> Select your state from the list').attr("class","text-danger");
		}else{
			$("#check_state").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});

	$("#city").blur(function(){
		var size = $(this).val().length;
		//console.log(size);
		if(size < 3){
			$("#check_city").html('<i class="fa fa-warning"></i> City name must be at least three characters').attr("class","text-danger");
		}else{
			$("#check_city").html('<i class="glyphicon glyphicon-ok-sign"></i>').attr("class","text-success");
		}
	});


});