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
</style>

<body class="bg">
<form action="<?php echo site_url('TravelAgencyFunction/checkProblemAns')?>" method="post" enctype="multipart/form-data">
	<br><br><br><br>
	<div class="row">
		<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="form-group">
				<h4 style="text-align: center"><span class="label label-default"><i><strong>Find Password</strong></i></span>
				</h4>

			</div>
			<hr>

			<div class="form-group">
				<label class="control-label col-md-12" >Your first question is: <STRONG><?php
						echo $problems[0]['problem1'] ?></STRONG></label>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Please enter your answer for your question:</label>
				<div class="col-md-10">
					<input v-model="ans1" type="text" class="form-control" name="answer1" id="text" placeholder="Enter Your Answer" value="<?php echo set_value('answer1')?>">
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" >Your second question is: <STRONG><?php
						echo $problems[0]['problem2'] ?></STRONG></label>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Please enter your answer for your question:</label>
				<div class="col-md-10">
					<input v-model="ans2" type="text" class="form-control" name="answer2" id="text" placeholder="Enter Your Answer" value="<?php echo set_value('answer2')?>">
				</div>
			</div>



			<br><br>
			<input @click="checkNull" type="submit" name="sub" value="submit">
		</div>
	</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
	var app = new Vue({
		el: '.row',
		data: {
			ans1:"",
			ans2:"",

		},
		methods:{
			checkNull:function(){
				if (this.ans1==""||this.ans2==""){
					alert("all the fields cannot be null");
				}
			}
		},

	})
</script>
</body>
</html>
