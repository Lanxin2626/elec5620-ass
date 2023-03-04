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
<body class="bg">
<br><br><br>
<form action="<?php echo site_url('TravelAgencyFunction/login')?>" method="POST" enctype="multipart/form-data">
	<div class="container-fluid" style="max-width: 1080px;">
		<div class="row">
			<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">

				<div class="form-group">
					<h4 style="text-align: center"><span class="label label-default"><i><strong>Sign in as Agency</strong></i></span>
					</h4>

				</div>
				<hr>
				<div class="form-group">
					<label class="control-label col-md-2" for="text">Agency Name:</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="agencyName" placeholder="Enter AgencyName"
							   value="<?php echo set_value('agencyName')?>">
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="control-label col-md-2" for="pwd">User Name:</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="userName" placeholder="Enter UserName"
							   value="<?php echo set_value('userName')?>">
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="control-label col-md-2" for="pwd">Password:</label>
					<div class="col-md-10">
						<input type="password" class="form-control" name="password" id="pwd" placeholder="Enter Password"
							   value="<?php echo set_value('password')?>">
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success">Log in</button>
					</div>
</form>

<div class="col-md-5" style="margin-left: 500px">
	<a class="text-primary" href="<?php echo site_url('TravelAgencyFunction/registerForm') ?>"
	   style="TEXT-DECORATION:none"><strong>Register Now</strong></a>
</div>
<div class="col-md-5" style="margin-left: 500px">
	<a class="text-muted" href="<?php echo site_url('Mycontroller/') ?>"
	   style="TEXT-DECORATION:none"><strong>Login as User/Tech team</strong></a>
</div>
<div class="col-md-5" style="margin-left: 500px;margin-top: 5px">
	<a class="text-muted" href="<?php echo site_url('TravelAgencyFunction/forgetPasswordPage') ?>"
	   style="TEXT-DECORATION:none">Forget password?</a>
</div>



</body>
</html>

