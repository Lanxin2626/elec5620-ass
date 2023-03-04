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
		background-repeat: repeat;
		background-size: cover;
	}
</style>
<body class="bg">
<ul class="nav nav-pills">
	<li class="nav-item">
		<a class="nav-link " href="<?php echo site_url('Mycontroller/main_page'); ?>">Home page</a>
	</li>
</ul>
<form action="<?php echo site_url('TravelAgencyFunction/itineraryEdit')?>" method="post" enctype="multipart/form-data">
	<br><br>
	<div class="row">
		<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="form-group">
				<h4 style="text-align: center"><span class="label label-default"><i><strong>Itinerary Introduction</strong></i></span>
				</h4>

			</div>
			<hr>
			<div class="form-group">
				<label class="control-label col-md-12" for="text"> Itinerary title:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="title" id="text"  value="<?php echo $itineraryInfo[0]['title']?>" readonly>
					<?PHP echo form_error('title','<span>','</span>')?>
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Itinerary Starting Place:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="placeStart" id="text" value="<?php echo $itineraryInfo[0]['placeStart']?>" readonly>
					<?PHP echo form_error('placeStart','<span>','</span>')?>
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Itinerary Destination:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="placeEnd" id="text" placeholder="Enter Your place End" value="<?php echo $itineraryInfo[0]['placeEnd']?>" readonly>
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Itinerary Duration:</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="duration" id="text" placeholder="Enter Duration(days)" value="<?php echo $itineraryInfo[0]['duration']?>" readonly>
				</div>
			</div>
			<br>
			<div class="form-group">
				<img src="<?php echo base_url().'uploads/itineraryImage/'.$itineraryInfo[0]['coverPicture']?>" class="thumbnail" alt="Cinque Terre">
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Itinerary Introduction:</label>
				<div class="col-md-10">
					<textarea readonly name="itinerary_introduction" style="width: 550px;height:160px" required="required" readonly ><?php echo $itineraryInfo[0]['introduction']?></textarea>
					<?PHP echo form_error('itinerary_introduction','<span>','</span>')?>
				</div>
			</div>
			<br>
			<div class="form-group">
				<label class="control-label col-md-12" for="text">Itinerary Price:</label>
				<div class="col-md-10">
					<input type="number" class="form-control" name="itinerary_price" id="text" placeholder="Enter price" value="<?php echo $itineraryInfo[0]['price']?>" readonly>
					<?PHP echo form_error('itinerary_price','<span>','</span>')?>
				</div>
			</div>
			<input type="hidden" name="itineraryID" value="<?php echo $itineraryInfo[0]['itineraryID']?>" >
			<br>
			<br><br>
		</div>
	</div>
</form>
</body>
</html>
