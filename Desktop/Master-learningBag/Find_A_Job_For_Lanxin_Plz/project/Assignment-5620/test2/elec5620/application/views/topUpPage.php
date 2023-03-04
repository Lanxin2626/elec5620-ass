<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
	  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
		integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
		crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
		integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
		crossorigin="anonymous"></script>
<style>
	body, html {
		height: 100%;
	}

	.bg {
		background-image: url(<?php echo base_url()."images/background1.jpg"?>);
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	@import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box
	}

	.body {
		background: #9ab3f5;
		font-family: 'Ubuntu', sans-serif
	}

	.wrapper {
		background-color: #f4f2f7;
		margin: 20px auto;
		max-width: 400px;
		padding: 15px 20px;
		border-radius: 10px
	}

	h4 {
		font-weight: 800;
		color: #888
	}

	label {
		font-weight: 700;
		color: #888;
		font-size: 12px
	}

	.card-no {
		border: none;
		outline: none;
		width: 90%;
		padding-left: 8px
	}

	.form-control {
		outline: none;
		border: none;
		box-shadow: none
	}

	.card-number {
		background-color: #fff;
		border: 1px solid #ddd;
		border-radius: 5px;
		padding: 5px 8px 2px
	}


	.form-inline label {
		font-size: 1rem
	}

	.focused {
		border: 2px solid #9ab3f5
	}

	#form-footer a {
		margin: 0
	}

	#form-footer p {
		margin: 0;
		text-align: center;
		font-size: 14px;
		font-weight: 500;
		color: #777
	}

	@media(max-width:395px) {
		.form-inline label {
			font-size: 12px
		}

		#form-footer p {
			font-size: 11px
		}

		.card-no {
			width: 85%
		}
	}

</style>
<body class="bg">


<?php  if (isset($_SESSION['user'])){

} ?>

<?php  if (isset($balance)){
} ?>
<?php  if (isset($_SESSION['user'])){
	if (time()-$_SESSION["login_time"]>10040){
		unset($_SESSION['user']);
		echo header("Location: logout");
		die();

	}
	else{
		$_SESSION["login_time"]=time();
	}
}
?>
<?php

//<!--JS refresh -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");
echo ("{");
echo ("window.location.reload();");
echo ("}");
echo ("setTimeout('fresh_page()',10042000);");
echo ("</script>");?>
<?php echo form_open('Mycontroller/topUpPage1'); ?>
<h5 class="text-dark"><strong>Hi, <?php echo $_SESSION['user']?>. Your current balance is $<?php echo $balance['balance']?>!</strong></h5>
<ul class="nav nav-pills">
	<li class="nav-item">
		<a class="nav-link " href="<?php echo site_url('Mycontroller/main_page'); ?>">Home page</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/editPortfolioPage'); ?>">Edit portfolio</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/enterGcpFrame'); ?>">Analyze location</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="<?php echo site_url('Mycontroller/topUpPage'); ?>">Top up</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/logout'); ?>">Log out</a>
	</li>
</ul>
<hr>

<div class="wrapper body">
	<h4 class="text-uppercase">Payment Details</h4>
	<form class="form mt-4">

		<div class="form-group"> <label for="name" class="text-uppercase">The amount you want to top up</label> <input id="l1" name="amount" type="text" class="form-control" placeholder="Enter the amount"> </div>
		<div class="form-group"> <label for="name" class="text-uppercase" >name on the card</label> <input name="name"type="text" class="form-control" id="l2" placeholder="Enter your name"> </div>

		<div class="form-group"> <label for="card" class="text-uppercase">card number</label>
			<div class="card-number"> <input name="num" type="text" class="card-no" step="4" id="l3" placeholder="Enter the Card number"> <span class=""> <img src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-marcus-samuelsson-group-2.png" alt="" width="30" height="30"> </span> </div>
		</div>
		<div class="row">
		<div class="d-flex w-100">
			<div class="d-flex w-50 pr-sm-4">
				<div class="form-group"> <label for="expiry" class="text-uppercase">exp.date</label> <input name="exp" type="text" class="form-control" id="l4"placeholder="03/2020"> </div>
			</div>
			<div class="d-flex w-50 pl-sm-5 pl-3">
				<div class="form-group"> <label for="cvv">CVV</label> <a href="#" title="CVV is a credit or debit card number, the last three digit number printed on the signature panel">what's this</a> <input name="cvv" type="password" id="l5"class="form-control pr-5" maxlength="3" placeholder="123"> </div>
			</div>
		</div>
		</div>
		<div class="form-inline pt-sm-3 pt-2"> <input type="checkbox" name="address" id="address"> <label for="address" class="px-sm-1 pl-1 pt-sm-0 pt-2">Email me the billing information</label> </div>
		<div class="form-inline py-sm-2"> <input type="checkbox" name="details" id="details"> <label for="details" class="px-sm-2 pl-2 pt-sm-0 pt-2">Send me any updates</label> </div>
		<div class="my-3" style="margin-left: 72px"> <input  type="submit" onclick="check()" value="place your order" class="text-uppercase btn btn-primary btn-block p-3"> </div>
		<div id="form-footer">
			<p>By placing your order, you agree to our</p>
			<p><a href="#">privacy notice</a> & <a href="#">terms of use</a>.</p>
		</div>
	</form>
</div>
<script>
	function check() {
		var l1 = document.getElementById("l1");
		var l2 = document.getElementById("l2");
		var l3 = document.getElementById("l3");
		var l4 = document.getElementById("l4");
		var l5 = document.getElementById("l5");
		if (l1.value == '') {
			alert("Amount cannot be null");
			l1.focus();
			history.go(0);
			return false;
		} else if (l1.value <= 0) {
			alert("Amount cannot be negative");
			l2.focus();
			history.go(0);
			return false;
		} else if (l2.value == '') {
			alert("Name cannot be null");
			l2.focus();
			history.go(0);
			return false;
		} else if (l3.value == '') {
			alert("Card number cannot be null");
			l3.focus();
			history.go(0);
			return false;
		} else if (l4.value == '') {
			alert("Expire date cannot be null");
			l4.focus();
			history.go(0);
			return false;
		} else if (l5.value == '') {
			alert("CVV cannot be null");
			l5.focus();
			history.go(0);
			return false;
		} else {
			alert("You have Top up successfully! Please check your account.");

		}
	}
</script>



</body>
</html>
