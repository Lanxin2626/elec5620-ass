<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>

<?php
if (!isset($_SESSION)) {
	session_start();
}
if (isset($path)) {
}

require "vendor/autoload.php";

use Google\Cloud\Vision\VisionClient;

$vision = new VisionClient(["keyFile" => json_decode(file_get_contents("key.json"), true)]);

$familyPhotoResource = fopen($_FILES["image"]["tmp_name"], "r");


$image = $vision->image($familyPhotoResource, ["LANDMARK_DETECTION"]);
$result = $vision->annotate($image);

$faces = $result->faces();
$logos = $result->logos();
$labels = $result->labels();
$text = $result->text();
$fullText = $result->fullText();
$properties = $result->imageProperties();
$cropHints = $result->cropHints();
$web = $result->web();
$safeSearch = $result->safeSearch();
$landmarks = $result->landmarks();


?>

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
<div class="container-fluid" style="max-width: 1080px;">
	<br><br><br>
	<div class="row">
		<div class="col-md-12" style="margin:auto; background: white; padding:20px ;
		 box-shadow:10px 10px 5px #888888">
			<div class="row">
				<h2 class="col-md-4"><a herf="/">Picture detection</a></h2>
				<p style="font-style: italic;">The best Image Processing Engine On earth</p>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4" style="text-align: center;">
					<img class='img-thumbnail' src="<?php
					echo $path;
					?>" alt="Analyzed Image">
				</div>
				<div class="col-md-8 border" style="padding: 10px">
					<ul class="nav nav-pills nav-fill mb3-3" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a herf="#pills-landmarks" role="tab" class="nav-link active" id="pills-landmarks-tab"
							   data-toggle="pill" aria-controls="pills-landmarks" aria-selected="true">Landmarks</a>
						</li>
					</ul>
					<hr>

					<div class="tab-content" id="pills-tabContent">

						<div class="tab-pane fade show active" id="pills-landmarks" role="tabpanel"
							 aria-labelledby="pills-landmarks-tab">
							<div class="row">
								<div class="col-12">

									<div class="row">
										<div class="col-12">
											<ol>
												<?php if ($landmarks): ?>
													<?php foreach ($landmarks as $key => $landmark): ?>
														<li>
															<h6><?php $location = str_replace(' ', '', ucfirst($landmark->info()["description"])); ?>
																<a href=<?php echo
																site_url('Mycontroller/GoogleLocation/' . $location) ?>><?php echo ucfirst($landmark->info()["description"]);
																	//$_SESSION['landmark'] = ucfirst($landmark->info()["description"]); echo $_SESSION['landmark'];?></a>
															</h6>
															Confidence:
															<strong><?php echo number_format($landmark->info()["score"]
																	* 100, 2) ?></strong><br><br></li>
													<?php endforeach; ?>
												<?php endif; ?>
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12" style="text-align: center;margin-top: 20px">
				<?php if ($landmarks): ?>
					<?php foreach ($landmarks as $key => $landmark): ?>

						<?php $location = str_replace(' ', '', ucfirst($landmark->info()["description"]));
						break;
						?>

					<?php endforeach; ?>
				<?php endif;
				$location=isset($location) ? $location : 'notSet';
				?>
				<a class="text-primary" href="<?php echo site_url('Mycontroller/uploadPicture/'.$location) ?>"
					   style="TEXT-DECORATION:none">Click here to share your picture now!</a>
			</div>
		</div>

	</div>

</div>
</body>
</html>


</body>
</html>
