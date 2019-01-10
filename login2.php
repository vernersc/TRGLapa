<html lang="en">
<?php include('includes/header.php'); ?>
<?php 
session_start();
if(!isLoggedIn())
{

if(isset($_POST['login']))
{
$error = array();
$errorText = "";

$email = quote_smart($_POST['username']);
$password = $_POST['password'];

$pHash = hash('sha256', $password);

$loginTest = mysql_query("SELECT id, admin, password FROM accounts WHERE email = $email AND password = '$pHash' LIMIT 1");
$loginRow = mysql_fetch_array($loginTest);


if(mysql_num_rows($loginTest) == 0)
{
$error[] = "Lietotājvārds vai parole ir nepareiza.";
}
if(count($error) >= 1)
{
foreach($error as $err)
{
$errorText = $err;
}
}
else
{
$_SESSION["user_id"] = $loginRow['id'];
$_SESSION["password"] = $loginRow['password'];
header("Location: http://" . $_SERVER['SERVER_NAME'] ."");
}
}
?>

		<div class="main-wrapper">
			<section class="facts-area pt-100 pb-100">
				<div class="container">
				  <div class="row">
					  <div class="center-align">
					  		<h2>Autorizācija</h2>
							<br>
							<div class="col-sm-9">
							<h3></h3>
							<?php if(count($error) >= 1) { ?>
							<div class="alert alert-danger" role="alert">
							<i class="fa fa-bell-o"></i>  <?php echo $errorText; ?>
							</div>	
							<?php } ?>
								<form method="post">
								<input type="hidden" name="" value="">
								<div class="form-group"><label for="id_username">E-Pasts</label><input type="text" name="username" autofocus="" maxlength="254" class="form-control" placeholder="E-Pasts" title="" required="" id="id_username"></div>
								<div class="form-group"><label for="id_password">Parole</label><input type="password" name="password" class="form-control" placeholder="Parole" title="" required="" id="id_password"></div>
								<div class="form-group">
								<button type="submit" name="login" class="btn rounded-0 btn-primary pull-left" data-disable-with="">
								Pieslēgties
								</button>
								</form>
							</div>
						</div>
				  </div>
				</div>
			</section>
		<? 
		}
		else {
			header("Location: http://" . $_SERVER['SERVER_NAME'] ."");
		}
		?>
		<?php include('includes/footer.php'); ?>
	</body>
</html>