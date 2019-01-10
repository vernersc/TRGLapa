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
                            <a class="nav-link" href="<?php site_url; ?>/profils"><i class="fa fa-user"></i> Profils</a>
                        </li>
                        <?php if ($user['id'] == (int)$_SESSION['user_id']) { ?>
                        <li class="nav-item">
                            <a class="nav-link aktivs" href="<?php site_url; ?>/lizmainas"><i class="fa fa-edit"></i> Stundu Izmaiņas</a>
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
					<h3 style="text-align:center;">Stundas pamatskolai</h3>
					<div class="stundas-pamatskola">
					<?php 
						
						foreach (array(1, 2, 3, 4, 5, 6) as $v) {
							mysql_set_charset('utf8');
							$stundas = mysql_query("SELECT * FROM stundas_pamatskolai WHERE id='".$v."'");
							
							while($s = mysql_fetch_array($stundas))
							{
								
							$klase = "";
							
							if ($s['klase'] == 71) {
								$klase = "7.a";
							} else if ($s['klase'] == 72) {
								$klase = "7.b";
							} else if ($s['klase'] == 81) {
								$klase = "8.a";
							} else if ($s['klase'] == 82) {
								$klase = "8.b";
							} else if ($s['klase'] == 91) {
								$klase = "9.1";
							} else if ($s['klase'] == 92) {
								$klase = "9.2";
							}
							?>
							<table class="stundu-izmainas">
							  <tr>
								<th></th>
								<th><?php echo $klase; ?></th> 
							  </tr>
							  <tr>
								<td>1.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['1']; ?>" name="stunda1"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['1_k']; ?>" name="kabinets1"></td>
							  </tr>
							  <tr>
								<td>2.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['2']; ?>" name="stunda2"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['2_k']; ?>" name="kabinets2"></td>
							  </tr>
							  <tr>
								<td>3.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['3']; ?>" name="stunda3"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['3_k']; ?>" name="kabinets3"></td>
							  </tr>
							  <tr>
								<td>4.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['4']; ?>" name="stunda4"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['4_k']; ?>" name="kabinets4"></td>
							  </tr>
							 <tr>
								<td>5.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['5']; ?>" name="stunda5"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['5_k']; ?>" name="kabinets5"></td>
							  </tr>
							  <tr>
								<td>6.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['6']; ?>" name="stunda6"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['6_k']; ?>" name="kabinets6"></td>
							  </tr>
							  <tr>
								<td>7.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['7']; ?>" name="stunda7"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['7_k']; ?>" name="kabinets7"></td>
							  </tr>
							  <tr>
								<td>8.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['8']; ?>" name="stunda8"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['8_k']; ?>" name="kabinets8"></td>
							  </tr>
							</table>
							<?php
							}
						}
					?>
					</div>
					<h3 style="text-align:center; margin-top:15px;">Stundas vidusskolai</h3>
					<?php 
						
						foreach (array(1, 2, 3, 4, 5, 6, 7, 8, 9) as $v) {
							mysql_set_charset('utf8');
							$stundas = mysql_query("SELECT * FROM stundas_vidusskolai WHERE id='".$v."'");
							
							while($s = mysql_fetch_array($stundas))
							{
								
							$klase = "";
							
							if ($s['klase'] == 101) {
								$klase = "10.a";
							} else if ($s['klase'] == 102) {
								$klase = "10.b";
							} else if ($s['klase'] == 103) {
								$klase = "10.c";
							} else if ($s['klase'] == 111) {
								$klase = "11.a";
							} else if ($s['klase'] == 112) {
								$klase = "11.b";
							} else if ($s['klase'] == 113) {
								$klase = "11.c";
							} else if ($s['klase'] == 121) {
								$klase = "12.a";
							} else if ($s['klase'] == 122) {
								$klase = "12.b";
							} else if ($s['klase'] == 123) {
								$klase = "12.c";
							}
							?>
							<table class="stundu-izmainas">
							  <tr>
								<th></th>
								<th><?php echo $klase; ?></th> 
							  </tr>
							  <tr>
								<td>1.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['1']; ?>" name="stunda1"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['1_k']; ?>" name="kabinets1"></td>
							  </tr>
							  <tr>
								<td>2.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['2']; ?>" name="stunda2"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['2_k']; ?>" name="kabinets2"></td>
							  </tr>
							  <tr>
								<td>3.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['3']; ?>" name="stunda3"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['3_k']; ?>" name="kabinets3"></td>
							  </tr>
							  <tr>
								<td>4.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['4']; ?>" name="stunda4"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['4_k']; ?>" name="kabinets4"></td>
							  </tr>
							 <tr>
								<td>5.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['5']; ?>" name="stunda5"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['5_k']; ?>" name="kabinets5"></td>
							  </tr>
							  <tr>
								<td>6.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['6']; ?>" name="stunda6"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['6_k']; ?>" name="kabinets6"></td>
							  </tr>
							  <tr>
								<td>7.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['7']; ?>" name="stunda7"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['7_k']; ?>" name="kabinets7"></td>
							  </tr>
							  <tr>
								<td>8.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['8']; ?>" name="stunda8"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['8_k']; ?>" name="kabinets8"></td>
							  </tr>
							  <tr>
								<td>9.</td>
								<td class="stunda"><input class="stunda" type="text" value="<?php echo $s['9']; ?>" name="stunda9"></td> 
								<td><input class="kabinets" type="text" value="<?php echo $s['9_k']; ?>" name="kabinets9"></td>
							  </tr>
							</table>
							<?php
							}
							}
							?>
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