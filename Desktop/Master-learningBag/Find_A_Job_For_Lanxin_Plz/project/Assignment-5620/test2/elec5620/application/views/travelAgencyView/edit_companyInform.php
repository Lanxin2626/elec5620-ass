<?php
?>
<!DOCTYPE html>
<head>Travel Agency Company Information Editing</head>
<body>
<form action="<?php echo site_url('TravelAgencyFunction/agencyInformationEdit')?>" method="post" enctype="multipart/form-data">
	<table class="tablet">
		<tr class="th">
			<td colspan="10">Itinerary Information Filling</td>
		</tr>
		<tr>
			<td>Company Name</td>
			<td><?php echo $companyInfo['agencyName']?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="text" name="address" value="<?php echo $companyInfo['address']?>"></td>
			<?PHP echo form_error('address','<span>','</span>')?>
		</tr>
		<tr>
			<td>Company Pictures</td>
			<td><input type="file" name="companyPictures" value="$companyInfo['companyPictures']"></td>
		</tr>
		<tr>
			<td>Introduction</td>
			<td><textarea name="company_introduction" style="width: 550px;height:160px"><?php echo $companyInfo['introduction']?></textarea></td>
			<?PHP echo form_error('company_introduction','<span>','</span>')?>
		</tr>
		<tr>
			<td colspan="10"><input type="submit" value="Edit"></td>
		</tr>
	</table>
</form>
</body>
</html>
