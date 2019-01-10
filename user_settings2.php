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
$user = userInfo($_GET['id']);

if ($user['id'] != (int)$_SESSION['user_id']) {
	header("Location: https://" . $_SERVER['SERVER_NAME'] ."/404");
}

$error = false;
$errorTxt = "";

$errorPW = false;
$errorPWS = false;
$errorTxtPW = "";

$errorEM = false;
$errorTxtEM = "";

if($user['id'] != '')
{
	
if(isset($_POST['update']))
{
	  $query = mysql_query("SELECT password FROM uprp_accounts WHERE id = '$user[id]'");
	  $uRow = mysql_fetch_assoc($query);
	  
	  $oldPasswordRN = $_POST['oldpass'];
	  $testHash = hash('sha256', $oldPasswordRN);
	  $passwordNow = $uRow['password'];
	  if($passwordNow == $testHash && $_POST['pass'] == $_POST['pass2'])
	  { 
		$parole = hash('sha256', $_POST['pass']);
		mysql_query("UPDATE uprp_accounts SET password = '$parole' WHERE id = '$user[id]'");
		setcookie("password", $parole, time()+99999999, '/');
		$errorPWS = true;
		$errorPW = false;
		$errorTxtPW = "Parole nomainīta veiksmīgi.";
		header("Location: https://" . $_SERVER['SERVER_NAME'] ."/login");
	  }
	  else
	  {
		$errorPW = true;
		$errorTxtPW = "Paroles nesakrīt.";
	  }
	
	if ($_POST['parse_var'] == "pic") {
		

		if ($_FILES['fileField']['tmp_name'] != "") { 
				$maxfilesize = 5120000; 
				if($_FILES['fileField']['size'] > $maxfilesize ) { 

							$error = true;
							$errorTxt = "Bildes izmērs par lielu.";
							unlink($_FILES['fileField']['tmp_name']); 

				} else if (!preg_match("/\.(gif|jpg|png)$/i", $_FILES['fileField']['name'] ) ) {

							$error = true;
							$errorTxt = "Bildes tips nav atļauts, atļautie tipi: GIF, JPG, PNG.";
							unlink($_FILES['fileField']['tmp_name']); 

				} else { 
							$newname = "$user[id].jpg";
							$place_file = move_uploaded_file( $_FILES['fileField']['tmp_name'], "images/avatars/".$newname);
							$avatar2 = quote_smart("images/avatars/".$user[id].".jpg");
							mysql_query("UPDATE uprp_accounts SET avatar = 'images/avatars/$newname' WHERE id = $user[id]");
							header("Location: https://" . $_SERVER['SERVER_NAME'] ."/settings/".$user['username']."");
				}
		}
	}
}
	
} else {
	header("Location: https://" . $_SERVER['SERVER_NAME'] ."/404");
}
?>
<div class="main-wrapper">
<section class="facts-area pt-100 pb-100">
<div class="container">
	<div class="row">
                    <div class="col-md-3">
                        <div class="user_container">
                            <div class="user_avatar"><h3 class="user_h3"><?php echo $user['username']; ?></h3></div>
                            <center><img style="max-width: 200px;" src="https://pinnacle-roleplay.net/<?php echo $user['avatar']; ?>" class="user_img" alt="<?php echo $user['username']; ?> Avatar"></center>
                            <br>
                            <center><span class="badge_user"><?php echo getUserGroup($user['id']); ?></span></center>
                            <?php if ($user['user_under_group'] > 0 ){ ?>
                            <center><span class="badge_user"><?php echo getUserUnderGroup($user['id']); ?></span></center>
                            <?php } ?>	
                            <center><span class="badge_user_second"><img src="<?php site_url; ?>/images/gamecoin.png"><?php echo $user['credits']; ?> - <a style="color: cyan;" href="/donate">Iegūt Vēl</a></span></center>
                            <br><br>
                            <div class="u-heading-v3-1 g-mb-20">
                                <h2 class="h3 u-heading-v3__title g-brd-primary">Iestatījumi</h2><br>
                            </div>
                            <ul class="list-group sidebar-nav-v1 fa-fixed" id="sidebar-nav">
                                <li class="list-group-item"><a class="g-color-main" href="<?php site_url; ?>/history/<?php echo $user['username']; ?>">
                                <i class="fa fa-history"></i> Konta Vēsture</a></li>
                                <li class="list-group-item"><a class="g-color-main" href="/donations/<?php echo $user['username']; ?>">
                                <i class="fa fa-usd"></i> Pirkumu Vēsture</a></li>
                            </ul>
                            </div>
                    </div>
		
		<div class="col-md-9">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php site_url; ?>/user/<?php echo $user['username']; ?>"><i class="fa fa-user"></i> Profils</a>
                        </li>
                        <?php if ($user['id'] == (int)$_SESSION['user_id']) { ?>
                        <li class="nav-item">
                            <a class="nav-link aktivs" href="<?php site_url; ?>/settings/<?php echo $user['username']; ?>"><i class="fa fa-edit"></i> Iestatījumi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php site_url; ?>/twostepauth/<?php echo $user['username']; ?>"><i class="fa fa-mobile-phone"></i> 2-FA</a>
                        </li>
                        <?php } ?>
                            <?php if (isUserForumAdmin((int)$_SESSION['user_id'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php site_url; ?>/mcp/<?php echo $user['username']; ?>"><i class="fa fa-credit-card"></i> ACP</a>
                            </li>
                        <?php } ?>
                    </ul>
		<?php if(($error) == true) { ?>
		<br>
			<div class="alert alert-danger" role="alert">
			<i class="fa fa-bell-o"></i>  <?php echo $errorTxt; ?>
			</div>	
		<?php } ?>
		
		<?php if(($errorPW) == true) { ?>
			<br>
			<div class="alert alert-danger" role="alert">
			<i class="fa fa-bell-o"></i>  <?php echo $errorTxtPW; ?>
			</div>	
		<?php } else if (($errorPWS) == true) { ?>
			<br>
			<div class="alert alert-success" role="alert">
			<i class="fa fa-bell-o"></i>  <?php echo $errorTxtPW; ?>
			</div>	
		<?php } ?>
		
		<?php if(($errorEM) == true) { ?>
		<br>
			<div class="alert alert-danger" role="alert">
			<i class="fa fa-bell-o"></i>  <?php echo $errorTxtEM; ?>
			</div>	
		<?php } ?>
		<?php if ($user['id'] == (int)$_SESSION['user_id']) { ?>
		<form method="post" enctype="multipart/form-data">
		<h3>Atjaunot Profila Bildi</h3>
		<div class="form-group">
		<img src="https://pinnacle-roleplay.net/<?php echo $user['avatar']; ?>" style="height:100px; width:100px; padding:2px;">
		<input name="fileField" type="file" class="formFields" id="fileField">
		<input name="parse_var" type="hidden" value="pic" />
		</div>
		<br>
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
		header("Location: https://" . $_SERVER['SERVER_NAME'] ."/404"); }
		?>
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