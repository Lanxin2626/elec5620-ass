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

	img {
		margin-left: 50px;
		width: 630px;
		height: 360px;
		border: 1px solid #555;

	}


	.img-thumbnail {
		background-color: transparent;
		height: 330px;
		width: 250px;


	}

	.text {
		max-width: 580px;

		text-overflow: ellipsis;
		word-wrap: break-word;

	}

</style>
<body class="bg" style="background-repeat: repeat-y;">

<?php if (isset($address)) {

}
if (isset($name)) {

}
if (isset($description)) {

}
if (isset($creatorName)) {

}
if (isset($upload_time)) {

}
if (isset($pid)) {

}
?>

<?php echo form_open('Mycontroller/updateViewRateAndComment/' . $pid); ?>
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

<div class="col-md-12" style="margin-top: 20px">
	<div style="width: 50%; display:inline-block;vertical-align: top;">
		<img src="<?php echo $address ?>" class="thumbnail" alt="Cinque Terre">

		<div class="caption">
			<h5 class="label" style="margin-left: 50px;margin-top: 10px">Title: <?php echo $name ?></h5>

			<p class="text" style="margin-left: 50px">Descriptrion: <br><i>"<?php echo $description ?>"</i></p>

			<h6 style="margin-left: 50px; font-size: 12px;">Creator: <?php echo $creatorName ?></h6>

			<h6 style="margin-left: 50px; font-size: 12px;">Overall rate: <?php if (isset($results)) {
					$sum = 0;
					$num = 0;
					foreach ($results as $result) {
						$rate = $result->rate;
						$sum = $sum + $rate;
						$num += 1;
					}
				}
				if ($num == 0) {
					echo 0;
				} else {
					echo $sum / $num;
				}
				?> </h6>
			<h6 style="margin-left: 50px; font-size: 12px;">Time: <?php echo $upload_time ?></h6>
		</div>
		<hr style="margin-top: 20px">
		<h4 style="margin-left: 50px">Comments: </h4>
		<?php if (isset($results) && ($results)) {
			foreach ($results as $result) {
				if ($result->comment == null) {

				} else {
					echo '<div class="text" style="margin-left: 50px">';
					echo 'User: ' . '<strong>' . $result->username . '</strong>' . ' at ' . $result->time . ' says' . '<br>';
					echo $result->comment . '<br><br>';
					echo '</div>';
				}
			}
		}
		?>
	</div>
	<div style="width: 40%; display:inline-block;vertical-align: top;">
		<table>
			<?php foreach ($advertisements as $agencyItineraries):?>
			   <?php foreach ($agencyItineraries as $itinerary):?>
				<tr><td><?php echo $itinerary['agencyName']?>'s <?php echo $itinerary['userName']?> advertising <br>we have trip</td></tr>
				<tr><td>     </td></tr>
				<tr aria-colspan="25">
					<td>Title</td>
					<td>placeStart</td>
					<td> <td>
					<td>placeEnd</td>
					<td> <td>
					<td>price</td>
				</tr>
				<tr>
					<td><a href=""><?php echo $itinerary['title']?></a></td>
					<td><?php echo $itinerary['placeStart']?></td>
					<td> <td>
					<td><?php echo $itinerary['placeEnd']?></td>
					<td> <td>
					<td><?php echo $itinerary['price']?></td>
				</tr>
				<?php endforeach;?>
			<?php endforeach;?>
		</table>
	</div>
</div>
<script>
	function check() {
		var test = document.getElementById(rate).value;//这是判断的值
		if (!isNaN(test)) {
			alert("it is a number");
		} else {
			alert("it is not a number");
		}
	}
</script>
</body>
</html>
