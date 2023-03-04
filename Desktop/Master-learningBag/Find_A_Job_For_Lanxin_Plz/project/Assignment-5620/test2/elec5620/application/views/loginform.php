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
	</style>

</head>

<?php $yzm = "";
for ($i = 0; $i < 5; $i++) {
	$a = rand(0, 9);
	$yzm .= $a;
} ?>
<?php echo form_open('Mycontroller/login/' . $yzm); ?>
<?php
$user = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$pw = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<body class="bg">
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<br><br><br>

<div class="container-fluid" style="max-width: 1080px;">
	<div class="row">
		<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">

			<div class="form-group">
				<h4 style="text-align: center"><span class="label label-default"><i><strong>{{message[0]}}</strong></i></span>
				</h4>
			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-2" for="text">{{message[1]}}</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="username" id="text" placeholder="Enter Username"
						   value="<?php echo $user; ?>">
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-2" for="pwd">{{message[2]}}</label>
				<div class="col-md-10">
					<input type="password" class="form-control" name="password" id="pwd" placeholder="Enter Password"
						   value="<?php echo $pw; ?>">
				</div>
			</div>

			<br>
			<div class="form-group">

				<label class="control-label col-md-2" for="cap">{{message[3]}}</label>
				<div class="row">
					<div class="col-md-7 ">
						<input type="text" class="form-control" name="entercode" id="cap" placeholder="Enter Captcha">
					</div>
					<div class="col-md-2" style="margin-left: 70px">
						<h3><i><span class="border"><?php echo $yzm ?></span></i></h3>
					</div>
				</div>
			</div>


			<br>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-10">
					<div class="checkbox">
						<label><input type="checkbox" name="rem" value='1'> {{message[4]}}</label>
					</div>
				</div>
			</div>
			<br>
			<div class="form-group">
				<div class="col-md-12">
					<button type="submit" class="btn btn-success">{{message[5]}}</button>
				</div>
				<div class="col-md-5" style="margin-left: 500px">
					<a class="text-primary" href="<?php echo site_url('Mycontroller/Register') ?>"
					   style="text-decoration:none"><strong>{{message[6]}}</strong></a>
				</div>
				<div class="col-md-5" style="margin-left: 500px">
					<a class="text-primary" href="<?php echo site_url('Mycontroller/Register_admin') ?>"
					   style="text-decoration:none"><strong>{{message[7]}}</strong></a>
				</div>
				<div class="col-md-5" style="margin-left: 500px">
					<a class="text-muted" href="<?php echo site_url('TravelAgencyFunction/index') ?>"
					   style="text-decoration:none"><strong>{{message[8]}}</strong></a>
				</div>
				<div class="col-md-5" style="margin-left: 500px;margin-top: 5px">
					<a class="text-muted" href="<?php echo site_url('Mycontroller/forgetPasswordPage') ?>"
					   style="text-decoration:none">{{message[9]}} </a>
				</div>
			</div>


		</div>
	</div>
</div>

<script>
	var app = new Vue({
		el: '.container-fluid',
		data: {
			message: ["Sign in as User/Tech team ","Username:","Password:","Captcha:","Remember me","Log in","Register as User",
			"Register as Tech team","Agency Log in","Forget password?"],
		}

	})
</script>


</body>
</html>
