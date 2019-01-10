	<?php include('functions.php'); ?>
	<?php include('config.php'); ?>
	<? 
	header("Content-type: text/html; charset=utf-8");
	
	session_start();
	if(isLoggedIn())
	{
		$uId = (int)$_SESSION['user_id'];
		$user = userInfo((int)$_SESSION['user_id']);
	} else {
		
	}
	?>
		
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="user-scalable = no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="http://ultraplay.lv/img/favicon.ico">
		<!-- Author Meta -->
		<meta name="author" content="Colorlib">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Tukuma Raiņa ģimnāzija</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500,600" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/nice-select.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="custom-icons/css/font-awesome.min.css">
	</head>
	
	<script>
	function toggleNav() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}
	</script>
	
	<div class="main_body">
	<div class="logo-large"></div>
	<div class="main-wrapper-first">
		<div class="hero-area relative">
			<header>
				<div class="topnav" id="myTopnav">
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."" ?>">Sākums</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>izmainas">Stundu Izmaiņas</a>
					<?php if(!isLoggedIn()) { ?>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Par Skolu</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Mācības</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Reflekantiem</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Kalendārs</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Panākumi</a>
					<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>">Biedrība</a>
					<?php } else if (isLoggedIn()) {?>
						<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>profils">Mans Profils</a>
						<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/" ?>logout">Atslēgties</a>
					<?php } ?>					
					<a href="javascript:void(0);" class="icon" onclick="toggleNav()">
						<i class="fa fa-bars"></i>
					</a>
				</div>
				<div class="banner-area relative">
					<div class="overlay hero-overlay-bg"></div>
					<div class="slide-ov"></div>
					<div class="container">
						<div class="row height align-items-center justify-content-center">
							<div class="col-lg-7">
							</div>
						</div>
					</div>
				</div>
			</header>
		</div>
	</div>
    <style type="text/css">
        .headers {
            width: 75%;
        }
    </style>
	
	