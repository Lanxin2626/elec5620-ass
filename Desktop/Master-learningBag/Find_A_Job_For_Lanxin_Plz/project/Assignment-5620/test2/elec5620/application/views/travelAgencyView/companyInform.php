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
<?php  $userInfo = $this->session->userdata('userInfo')?>
<h5 class="text-dark"><strong>Hi,<?php echo $userInfo['agencyName']?> 's  <?php echo $userInfo['accountName']?> !</strong></h5>
<ul class="nav nav-pills">
	<li class="nav-item">
		<a class="nav-link active" href="<?php echo site_url('TravelAgencyFunction/showCompanyInform'); ?>">Agency profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/showItinerary'); ?>">Current Itinerary</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/findMostPopView'); ?>">Hot place</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/logout'); ?>">Log out</a>
	</li>
</ul>
<hr>
<br><br>
<div class="row">
	<form action="<?php echo site_url('TravelAgencyFunction/agencyInformationEdit')?>" method="post" enctype="multipart/form-data">
		<div class="col-md-8" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="form-group">
				<h4 style="text-align: center"><span class="label label-default"><i><strong>Edit Portfolio</strong></i></span>
				</h4>
			</div>
			<hr>

			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="phone"><strong>Company Name:</strong></label><br>
				<div class="col-md-12">
					<?php echo $companyInfo['agencyName'] ?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="email"><strong>Address</strong></label>
				<div class="col-md-12">
					<input type="text" class="form-control" name="address" id="address" value="<?php echo $companyInfo['address']?>">
					<?PHP echo form_error('address','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="que"><strong>Company Pictures</strong></label>
				<div class="col-md-12">
					<a href=""><img width="" src="<?php echo base_url().'uploads/companyInfo/'.$companyInfo['companyPictures']?>"></a>
					<input type="file" name="companyPictures" value="$companyInfo['companyPictures']">
					<?php echo set_value('companyPictures')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<label class="control-label col-md-2" for="ans"><strong>Introduction</strong></label>
				<div class="col-md-12">
					<textarea name="company_introduction"  style="width: 950px;height:160px" required="required"><?php echo $companyInfo['introduction']?></textarea>
					<?PHP echo form_error('company_introduction','<span>','</span>')?>
				</div>
			</div>
			<div class="form-group"style="margin-top: 15px">
				<div class="col-md-12">
					<input type="submit" class="form-control btn btn-success" value="Submit">
				</div>
			</div>

		</div>
	</form>
</div>


</body>
</html>

