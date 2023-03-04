<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

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
	</style>
</head>
<body class="bg">

<?php if (isset($_SESSION['user'])) {
	if (time() - $_SESSION["login_time"] > 10040) {
		unset($_SESSION['user']);
		echo header("Location: logout");
		die();

	} else {
		$_SESSION["login_time"] = time();
	}
}
?>
<?php

//<!--JS refresh -->
echo("<script type=\"text/javascript\">");
echo("function fresh_page()");
echo("{");
echo("window.location.reload();");
echo("}");
echo("setTimeout('fresh_page()',10042000);");
echo("</script>"); ?>


<h5 class="text-dark"><strong>Hi, <?php echo $_SESSION['user'] ?>!</strong></h5>

<ul class="nav nav-pills">
	<li class="nav-item">
		<a class="nav-link " href="<?php echo site_url('Mycontroller/main_page'); ?>">Home page</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/editPortfolioPage'); ?>">Edit portfolio</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="<?php echo site_url('Mycontroller/enterGcpFrame'); ?>">Analyze location</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/topUpPage'); ?>">Top up</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('Mycontroller/logout'); ?>">Log out</a>
	</li>
</ul>
<hr>
<br>

<?php //load database here
$this->load->database();
$this->load->model('elec5620model');
$user = $this->elec5620model->finduser($_SESSION['user']);
$amount_now = $user['balance']; ?>
<script>
	function check() {
		var arr = "<?php echo $amount_now - 2;?>"

		if (arr <= 0) {
			alert("insufficient amount. Please top up!");
			arr.focus();
			return true;
		}
	}
</script>
<h5 class="text-dark" style="text-align: center"><strong>Your current balance is $<?php echo $amount_now; ?></strong>
</h5>
<h5 style="text-align: center"><strong>Please note you will cost $2 for each analysis!</strong></h5>
<div class="container">
	<br>
	<div class="row">
		<div class="col-md6 offset-md-3" style="margin:auto; background: white; padding:20px;width:500px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="panel-heading">
				<h2>Picture detection </h2>
				<p style="font-style: italic;">Coolest Image Processing Engine On earth</p>
			</div>
			<hr>
			<form action=<?php echo site_url('Mycontroller/test') ?> method="post" enctype="multipart/form-data">
				<input type="file" id="image" name="image" accept="image/*" class="form-control">
				<br>
				<label class="form-group" style="margin-left: 135px">
					<button type="submit" onclick="check()" style="border-radius: 10px;" class="btn btn-lg btn-block btn-outline-success">
						Analyze Picture
					</button>
				</label>
			</form>

		</div>
	</div>
</div>
<script>
	function check() {
		var check=document.getElementById("image").value;
		if (check==''){
			alert("You must submit a picture")
		}
	}

</script>
</body>

</html>
