<html lang="en">
<?php include('includes/header.php'); ?>
<head>
		<link rel="stylesheet" href="..//css/linearicons.css">
		<link rel="stylesheet" href="..//css/font-awesome.min.css">
		<link rel="stylesheet" href="..//css/nice-select.css">
		<link rel="stylesheet" href="..//css/magnific-popup.css">
		<link rel="stylesheet" href="..//css/bootstrap.css">
		<link rel="stylesheet" href="..//css/main.css">
</head>
<? 
$catID = $_GET["cat"];	

if(isLoggedIn())
{
$user = userInfo((int)$_SESSION['user_id']);
$char = charInfo($_GET["id"]);

if ($user['id'] != (int)$_SESSION['user_id']) {
	header("Location: https://" . $_SERVER['SERVER_NAME'] ."/404");
}

if($user['id'] != '')
{
	
	
} else {
	header("Location: https://" . $_SERVER['SERVER_NAME'] ."/404");
}

if($user['id'] != '')
{
	
if(isset($_POST['update']))
{
	if ($_POST['parse_var'] == "pic") {
		

		if ($_FILES['fileField']['tmp_name'] != "") { 
				$maxfilesize = 5120000; 
				if($_FILES['fileField']['size'] > $maxfilesize ) { 

							$error = true;
							$errorTxt = "Picture size Is too big.";
							unlink($_FILES['fileField']['tmp_name']); 

				} else if (!preg_match("/\.(gif|jpg|png)$/i", $_FILES['fileField']['name'] ) ) {

							$error = true;
							$errorTxt = "Picture type not allowed. Allowed types: GIF, JPG, PNG.";
							unlink($_FILES['fileField']['tmp_name']); 

				} else { 
							$newname = "$user[id].jpg";
							$place_file = move_uploaded_file( $_FILES['fileField']['tmp_name'], "images/characters/".$newname);
							$avatar2 = quote_smart("images/characters/".$user[id].".jpg");
							mysql_query("UPDATE characters SET avatar = 'images/characters/$newname' WHERE id = $char[id]");
							header("Location: https://" . $_SERVER['SERVER_NAME'] ."/character/".$char['id']."");
				}
		}
	}	
}

}
?>
<div class="main-wrapper">
<section class="facts-area pt-100 pb-100">
<div class="container">
	<div class="row">

	<div class="col-md-4 character-sidebar">

		<div class="u-heading-v3-1 g-mb-10">
			<h2 class="h3 u-heading-v3__title g-brd-primary"><?php echo str_replace("_", " ", $char["charname"]); ?></h2>
		</div>
		
		<div class="character-image text-center">
		<br>
			<img class="character_avatar" src="<?php echo "https://" . $_SERVER['SERVER_NAME'] ."/" ?><?php echo $char["avatar"]; ?>" width="175px">
		</div>
		<br><br><br><br><br><br><br><br><br><br>

		<form class="upload_char_pic" method="post" enctype="multipart/form-data">		
		<div class="form-group">
			<input name="parse_var" type="hidden" value="pic" />
			<input type="file" name="fileField" id="fileField" style="display: none;" />
			<input type="button" value="Izvēlēties Bildi..." onclick="document.getElementById('fileField').click();" />
		</div>
		
		<button style="margin-left:-10px;" type="submit" name="update" class="btn rounded-0 btn-primary pull-left">
		Atjaunot Bildi
		</button>
		</form>
		
	</div>
			
<div class="col-md-8">
<h2 class="chardetails">Personāža Detaļas</h2>

<div class="row">
<?php 
$gender = "Sieviete";
$status = "Miris";
$year = 2018;
$dob_year = $char["dob_year"];
$finalyear = $year - $dob_year;

$height = $char["height"];
$weight = $char["weight"];

if ($char["gender"] == 1) {
	$gender = "Vīrietis";
} else {
	$gender = "Sieviete";
}

if ($char["cked"] == 0) {
	$status = "Dzīvs";
} else {
	$status = "Miris";
}

$vehArr = array();
$mQuery4 = mysql_query("SELECT `id`,`veh_brand`, `veh_model`, `veh_year`, `veh_enginet`, `veh_enginec` FROM `vehicles` WHERE `charid`='".$char['id']."'");
while ($vehrow = mysql_fetch_assoc($mQuery4))
{
	$vehArr[$vehrow['id']] = "" .$vehrow["veh_year"]." ".$vehrow["veh_brand"]." ".$vehrow["veh_model"]."";
}

$propArr = array();
$mQuery5 = mysql_query("SELECT `id`,`name` FROM `interiors` WHERE `owner`='".$char['id']."'");
while ($introw = mysql_fetch_assoc($mQuery5))
{
	$propArr[$introw['id']] = $introw['name'];
}

$result=mysql_query("SELECT count(*) as total from vehicles WHERE charid='" .$char['id']."'");
$data=mysql_fetch_assoc($result);

$result3=mysql_query("SELECT count(*) as total from interiors WHERE owner='" .$char['id']."'");
$data3=mysql_fetch_assoc($result3);


$nettworth = 0;
$nettworth = $nettworth + $char['money'];
$nettworth = $nettworth + $char['bankmoney'];

$mQueryNetI = mysql_query("SELECT sum(`price`) AS 'inttotal' FROM `interiors` WHERE `owner`='".$char['id']."' ");
if (mysql_num_rows($mQueryNetI) > 0)
{
	$intWorthRow = mysql_fetch_assoc($mQueryNetI);
	$nettworth = $nettworth + $intWorthRow['inttotal'];
}

$mQueryNetV = mysql_query("SELECT sum(`price`) AS 'inttotal' FROM `vehicles` WHERE `charid`='".$char['id']."' ");
if (mysql_num_rows($mQueryNetV) > 0)
{
	$vehWorthRow = mysql_fetch_assoc($mQueryNetV);
	$nettworth = $nettworth + $vehWorthRow['inttotal'];
}
?>
	<div class="col-md-6 col-sm-12">
	<p><strong>Galvenā Informācija</strong></p>
		<ul>
			<li>
			<strong>Status</strong>: <?php echo $status; ?>
			</li>
			
			<li><strong>Dzimums</strong>: <?php echo $gender; ?></li>
			<li><strong>Vecums</strong>: <?php echo $finalyear; ?> gadi</li>
			<li><strong>Augums</strong>: <?php echo $height; ?> cm</li>
			<li><strong>Svars</strong>: <?php echo $weight; ?> kg</li>
			<li><strong>Stundas nospēlētas</strong>: <?php echo $char["hoursplayed"]; ?> stundas</li>
		</ul>
	</div>
	
	<div class="col-md-6 col-sm-12">
	
	<p><strong>Profesijas & Finances</strong></p>
		<ul>
			<li><strong>Bankas Kontā</strong>: $<?php echo number_format($char["bankmoney"]); ?></li>
			<li><strong>Kopējā vērtība</strong>: $<?php echo number_format($nettworth); ?></li>
		</ul>

	</div>
	
</div>
<br><br>
<div class="row">
<div class="col-md-6 col-sm-12">
<p><strong>Transportlīdzekļi (<?php echo $data['total']; ?>/5)</strong></p>
<?php
	if (count($vehArr) == 0)
		{
		?>
		<li>Tev nav neviens transportlīdzeklis.</li>
		<?php
		}
	else {
		foreach ($vehArr as $vehicleID => $vehicleName)
		{
			echo "<li><a class=\"link\">".$vehicleName."</a></li>\r\n";
		}
	}
?>
</div>
<div class="col-md-6 col-sm-12">
<p><strong>Īpašumi (<?php echo $data3['total']; ?>/10)</strong></p>
<?php
	if (count($propArr) == 0)
		{
		?>
		<li>Tev nav neviens īpašums.</li>
		<?php
		}
	else {
		foreach ($propArr as $propertyID => $propertyName)
		{
			echo "<li><a class=\"link\">".$propertyName."</a> (ID: $propertyID)</li>\r\n";
		}
	}
?>
</div>
</div>
</div>
		

		
</section>	
<section class="feature-area pt-100 pb-100">
</section>
<?
}
?>
<?php include('includes/footer.php'); ?>
</body>
</html>