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
<form action="<?php echo site_url('TravelAgencyFunction/register')?>" method="POST" enctype="multipart/form-data">
	<body class="bg">
	<br>
	<div class="row">
		<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="form-group">
				<h4 style="text-align: center"><span class="label label-default"><i><strong>Register</strong></i></span>
				</h4>
			</div>
			<hr>
			<div class="form-group" >
				<label class="control-label col-md-2" for="text">AgencyName:</label>
				<div class="col-md-12">
					<input v-model="name" type="text" class="form-control" name="agencyName" placeholder="Enter AgencyName" value="<?php echo set_value('agencyName')?>">
					<?PHP echo form_error('agencyName','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group" >
				<label class="control-label col-md-2" for="text">Username:</label>
				<div class="col-md-12">
					<input v-model="userName" type="text" class="form-control" name="userName" placeholder="Enter Username" value="<?php echo set_value('userName')?>">
					<?PHP echo form_error('userName','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="email">Email:</label>
				<div class="col-md-12">
					<input v-model="email" type="text" class="form-control" name="eMail" placeholder="Enter Email" value="<?php echo set_value('eMail')?>">
					<?PHP echo form_error('eMail','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="phone">Phone:</label>
				<div class="col-md-12">
					<input v-model="phone" type="text" class="form-control" name="phoneNumber" placeholder="Enter Phone Number" value="<?php echo set_value('phoneNumber')?>">
					<?PHP echo form_error('phoneNumber','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group" style="margin-top: 15px">
				<label class="control-label col-md-2" for="pwd">Password:</label>
				<div class="col-md-12">
					<input v-model="pwd" type="password" class="form-control" name="password" placeholder="Enter Password" value="<?php echo set_value('password')?>">
					<?PHP echo form_error('password','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group" style="margin-top: 15px">
				<label class="control-label col-md-2" for="pwd">Check PassWord:</label>
				<div class="col-md-12">
					<input v-model="checkPwd" type="password" class="form-control" name="cPassword" placeholder="Check PassWord" value="<?php echo set_value('cPassword')?>">
					<?PHP echo form_error('cPassword','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<div class="col-md-12">
					<input @click="checkNull"  type="submit" class="form-control btn btn-success" value="Submit">
				</div>
			</div>

		</div>
	</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
	var app = new Vue({
		el: '.row',
		data: {
			name:"",
			userName:"",
			email:"",
			phone:"",
			pwd:"",
			checkPwd:""
		},
		methods:{
			checkNull:function(){
				if (this.name==""||this.userName==""||this.email==""||this.phone==""||
					this.pwd==""||this.checkPwd==""){
					alert("all the fields cannot be null");
				}

			}
		},

	})
</script>
</body>
</html>
