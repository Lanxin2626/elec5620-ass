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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

	img {
		width: 240px;
		height: 140px;
		border: 1px solid #555

	}


	.img-thumbnail {
		background-color: transparent;
		height: 360px;
		width: 250px;
	}

	.text {
		max-width: 240px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;

	}
	* {
		box-sizing: border-box;
	}

	/* Style the search field */
	.example input[type=text] {
		padding: 10px;
		font-size: 17px;
		border: 1px solid grey;
		float: left;
		width: 80%;
		background: #f1f1f1;
	}

	/* Style the submit button */
	.example button {
		float: left;
		width: 20%;
		padding: 10px;
		background: #2196F3;
		color: white;
		font-size: 17px;
		border: 1px solid grey;
		border-left: none; /* Prevent double borders */
		cursor: pointer;
	}

	.example button:hover {
		background: #0b7dda;
	}

	/* Clear floats */
	.example::after {
		content: "";
		clear: both;
		display: table;
	}

</style>
<body class="bg" style="background-repeat: repeat-y;">
<?php  $userInfo = $this->session->userdata('userInfo')?>
<h5 class="text-dark"><strong>Hi,<?php echo $userInfo['agencyName']?> 's <?php echo $userInfo['accountName']?> !</strong></h5>
<ul class="nav nav-pills">
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/showCompanyInform'); ?>">Agency profile</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" href="<?php echo site_url('TravelAgencyFunction/showItinerary'); ?>">Current Itinerary</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/findMostPopView'); ?>">Hot place</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo site_url('TravelAgencyFunction/logout'); ?>">Log out</a>
	</li>

</ul>
<hr>
<div class="row" style="margin-left: 70px;margin-right: 70px;margin-top: 10px">

	<?php foreach ($allItinerary as $itinerary): ?>
		<div class="col-md-3" style="margin-top: 30px">
			<div class="img-thumbnail">
				<img src="<?php echo base_url().'uploads/itineraryImage/'.$itinerary['coverPicture']?>" class="thumbnail" alt="Cinque Terre">

				<div class="caption">
					<h5 class="label">ID: <?php echo $itinerary['itineraryID']?></h5>
					<p class="text">Title <i>"<?php echo $itinerary['title']?>"</i></p>
					<div class="col-md-3">
						<table>
						<tr>
							<td>
								<a href="<?php echo site_url('TravelAgencyFunction/itineraryEditPage/'.$itinerary['itineraryID'])?>"
								   class="btn btn-primary " role="button">
									Edit
								</a></td>
							<td>
								<a href="<?php echo site_url('TravelAgencyFunction/deleteItinerary/'.$itinerary['itineraryID'])?>"
								   class="btn btn-primary " role="button">
									Delete
								</a></td>
						</tr>
						</table>
					</div>
					<hr>
					<h6 style="text-align: right; font-size: 12px;">place Start: <?php echo  $itinerary['placeStart'] ?></h6>
					<h6 style="text-align: right; font-size: 12px;">place End: <?php echo $itinerary['placeEnd'] ?></h6>
					<h6 style="text-align: right; font-size: 12px;">price: <?php echo $itinerary['price'] ?></h6>
				</div>
			</div>
		</div>
	<?php endforeach;?>
	<br>
	<div class="row" style="margin-left: 5px;margin-right: 70px;margin-top: 30px">
		<a href="<?php echo site_url('TravelAgencyFunction/itineraryAddPage')?>"
			class="btn btn-primary " role="button">
			Add a new Itinerary
		</a></div>

</div>

</div>


</body>
</html>
