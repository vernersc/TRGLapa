<html lang="en">
<?php include('includes/header.php'); ?>
<?php 
$siteOffline = false;
if(!isLoggedIn())
{
	
if(isset($_POST['signup']))
{
$error = array();
$errorText = "";
	
### lietotajvarda parbaude ###
if($_POST['username'])
{
if(strlen($_POST['username']) >= 3)
{
if(strlen($_POST['username']) <= 25)
{
$username = quote_smart($_POST['username']);
$usernameTest = mysql_query("SELECT id FROM accounts WHERE username = $username");
if(mysql_num_rows($usernameTest) == 1)
{
	$error = true;
	$error[] = "Lietotājvārds jau eksistē";
}
if(!validUsername($_POST['username']) AND !is_numeric($_POST['username']))
{
	$error[] = "Lietotājvārds var saturēt tikai burtus un ciparus!";
}

}
else
{
	$error[] = "Lietotājvārds par garu. Maksimālais garums - 25 rakstzīmes";
}


}else
{
	$error[] = "Lietotājvārdam jābūt vismaz 3 rakstzīmes garam.";
}
}
else
{
	$error[] = "Tu aizmirsi ievadīt lietotājvārdu.";
}
### lietotajvarda parbaude ###

### paroles parbaude ###
if($_POST['password1'])
{
	
if(strlen($_POST['password1']) >= 8)
{
	if($_POST['password1'] == $_POST['password2'])
	{
	$password = $_POST['password1'];
	$pHash = quote_smart(hash('sha256', $password));
	}
	else
	{
		$error[] = "Paroles nesakrīt.";
	}
}
else
{
	$error[] = "Parole ir par īsu.";
}

}
else
{
	$error[] = "Tu aizmirsi ievadīt paroli.";
}
### paroles parbaude ###

### epasta parbaude ###
if($_POST['email'])
{
if(isValidEmail($_POST['email']))
{
$email = quote_smart($_POST['email']);
$emailTest = mysql_query("SELECT id FROM accounts WHERE email = $email");
if(mysql_num_rows($emailTest) == 1)
{
	$error[] = "E-Pasts jau eksistē.";
}
}
else
{
	$error[] = "Nederīgs E-Pasts";
}

}
else
{
	$error[] = "Tu aizmirsi ievadīt E-Pastu";
}
### epasta parbaude ###

if(count($error) >= 1)
{
foreach($error as $err)
{
$errorText = $err;
}
}
else
{
$ip = quote_smart($_SERVER["HTTP_X_FORWARDED_FOR"]);

$queryReg = mysql_query("INSERT INTO accounts (username, password, registerdate, ip, email) VALUES ($username, $pHash, NOW(), $ip, $email)");

if ($queryReg) {
	header("Location: https://" . $_SERVER['SERVER_NAME'] ."/login");
	die();
} else {
	die();
}

}


}
?>
	<div class="main-wrapper">
		<section class="facts-area pt-100 pb-100">
		<div class="container">
		  <div class="row">
			<div class="center-align">
			<h2>Jauna konta izveide</h2>
			<br>
			<div class="col-sm-7">
			<h3></h3>
			<?php if(count($error) >= 1) { ?>
			<div class="alert alert-danger" role="alert">
			<i class="fa fa-bell-o"></i>  <?php echo $errorText; ?>
			</div>	
			<?php } ?>
			<form method="post">
				<input type="hidden" name="" value="">
				
				<div class="form-group">
				<label for="id_username">Lietotājvārds</label>
				<input type="text" name="username" autofocus="" class="form-control" placeholder="Lietotājvārds" title="" required="" id="id_username">
				</div>
				
				<div class="form-group">
				<label for="id_email">E-Pasts</label>
				<input type="email" name="email" class="form-control" placeholder="E-Pasts" title="" required="" id="id_email">
				</div>
				
				<div class="form-group">
				<label for="id_password1">Parole</label>
				<input type="password" name="password1" class="form-control" placeholder="Parole" required="" id="id_password1">
				<div class="help-block">
				<ul><li>Tavai parolei jāsatur vismaz 8 rakstzīmes.</li><li>Tava parole nedrīkst būt bieži izmantota.</li><li>Tava parole nevar saturēt tikai ciparus.</li></ul>
				</div>
				</div>
				
				<div class="form-group">
				<label for="id_password2">Paroles apstiprināšana</label>
				<input type="password" name="password2" class="form-control" placeholder="Parole vēlreiz" required="" id="id_password2">
				<div class="help-block">Ievadi to pašu paroli vēlreiz.</div>
				</div>
				<div class="form-group">
				<button type="submit" name="signup" class="btn rounded-0 btn-primary pull-left">
				Izveidot Kontu
				</button>
				</div>
			</form>
			</div>
			</div>
		  </div>
		</div>
		</section>
		<section class="feature-area pt-100 pb-100">
		</section>
				<? 
		}
		else {
			header("Location: https://" . $_SERVER['SERVER_NAME'] ."");
		}
		?>
		<?php include('includes/footer.php'); ?>
	</body>
</html>