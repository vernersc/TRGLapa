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
		if(isLoggedIn())
		{
		$userID = $_SESSION["user_id"];
		$userRow = userInfo($userID);

		//Acc info
		$emailAddress = $userRow['email'];
		$lastlogin = $userRow['lastlogin'];
		$lastIP = $userRow['ip'];
		$usernameBig = $userRow['username'];
	?>
	<div class="main-wrapper">
        <section class="facts-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="user_container">
                            <div class="user_avatar"><h3 class="user_h3"><?php echo $user['username']; ?></h3></div>
                            <center><img style="max-width: 200px;" src="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."" ?><?php echo $user['avatar']; ?>" class="user_img" alt="<?php echo $user['username']; ?> Avatar"></center>
                            <br>
                            <center><span class="badge_user"><?php echo getUserGroup($user['id']); ?></span></center>
                            <?php if ($user['user_under_group'] > 0 ){ ?>
                            <center><span class="badge_user"><?php echo getUserUnderGroup($user['id']); ?></span></center>
                            <?php } ?>	
                            </div>
                    </div>

                <div class="col-md-8">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link aktivs" href="<?php site_url; ?>/profils"><i class="fa fa-user"></i> Profils</a>
                        </li>
                        <?php if ($user['id'] == (int)$_SESSION['user_id']) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php site_url; ?>/lizmainas"><i class="fa fa-edit"></i> Stundu Izmaiņas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php site_url; ?>/pjaunumus"><i class="fa fa-edit"></i> Jaunumi</a>
                        </li>
                        <?php } ?>
                            <?php if (isUserForumAdmin((int)$_SESSION['user_id'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php site_url; ?>/statistika"><i class="fa fa-area-chart"></i> Lapas Statistika</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="<?php site_url; ?>/plietotaju"><i class="fa fa-plus"></i> Pievienot Skolotāju</a>
                            </li>
                        <?php } ?>
                    </ul>
					<br>
					<?php if ($user['id'] == (int)$_SESSION['user_id']) { ?>
					<form method="post" enctype="multipart/form-data">
					<h3>Mainīt E-Pastu</h3>
					<div class="form-group">
					<input type="email" name="email" maxlength="254" minlength="8" class="form-control" value="<?php echo $user['email']; ?>" title="" required="" id="id_email">
					</div>
					<br>
					<h3>Mainīt Paroli</h3>
					<div class="form-group">
					<input type="password" name="oldpass" maxlength="254" minlength="8" class="form-control" placeholder="Esošā parole" title="" id="id_password">
					<br>
					<input type="password" name="pass" maxlength="254" minlength="8" class="form-control" placeholder="Jaunā parole" title="" id="id_password1">
					<br>
					<input type="password" name="pass2" maxlength="254" minlength="8" class="form-control" placeholder="Atkārtoti jaunā parole" title="" id="id_password2">
					<br>
					<button type="submit" name="update" class="btn rounded-0 btn-primary pull-left">
					Atjaunot
					</button>
					</div>
					</form>
					<?php } else { 
					header("Location: http://" . $_SERVER['SERVER_NAME'] ."/404"); }
					?>
            </div>
			
			
        </section>	
<?
}
?>
<?php include('includes/footer.php'); ?>
</body>
</html>