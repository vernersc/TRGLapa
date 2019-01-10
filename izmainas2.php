
<html class="no-js">
		<?php include('includes/header.php'); ?>
		<div class="main-wrapper">

			<!-- Start about Area -->
			<section class="about-area pt-50 pb-100">
				<div class="container">
					<div class="row">
					  <div class="col-9">
					  
						<div class="pamatskola-izmainas">
						<h2 class="stundu-izmainas">Pamatskola | Stundas trešdienai, 9.janvārim</h2>
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
								<td class="stunda"><?php echo $s['1']; ?></td> 
								<td><?php echo $s['1_k']; ?></td>
							  </tr>
							  <tr>
								<td>2.</td>
								<td class="stunda"><?php echo $s['2']; ?></td> 
								<td><?php echo $s['2_k']; ?></td>
							  </tr>
							  <tr>
								<td>3.</td>
								<td class="stunda"><?php echo $s['3']; ?></td> 
								<td><?php echo $s['3_k']; ?></td>
							  </tr>
							  <tr>
								<td>4.</td>
								<td class="stunda"><?php echo $s['4']; ?></td> 
								<td><?php echo $s['4_k']; ?></td>
							  </tr>
							 <tr>
								<td>5.</td>
								<td class="stunda"><?php echo $s['5']; ?></td> 
								<td><?php echo $s['5_k']; ?></td>
							  </tr>
							  <tr>
								<td>6.</td>
								<td class="stunda"><?php echo $s['6']; ?></td> 
								<td><?php echo $s['6_k']; ?></td>
							  </tr>
							  <tr>
								<td>7.</td>
								<td class="stunda"><?php echo $s['7']; ?></td> 
								<td><?php echo $s['7_k']; ?></td>
							  </tr>
							  <tr>
								<td>8.</td>
								<td class="stunda"><?php echo $s['8']; ?></td> 
								<td><?php echo $s['8_k']; ?></td>
							  </tr>
							</table>
							<?php
							}
						}
						?>
						</div>
							
						<div class="vidusskola-izmainas">
						<br>
						<h2 class="stundu-izmainas">Vidusskola | Stundas trešdienai, 9.janvārim</h2>
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
								<td class="stunda"><?php echo $s['1']; ?></td> 
								<td><?php echo $s['1_k']; ?></td>
							  </tr>
							  <tr>
								<td>2.</td>
								<td class="stunda"><?php echo $s['2']; ?></td> 
								<td><?php echo $s['2_k']; ?></td>
							  </tr>
							  <tr>
								<td>3.</td>
								<td class="stunda"><?php echo $s['3']; ?></td> 
								<td><?php echo $s['3_k']; ?></td>
							  </tr>
							  <tr>
								<td>4.</td>
								<td class="stunda"><?php echo $s['4']; ?></td> 
								<td><?php echo $s['4_k']; ?></td>
							  </tr>
							 <tr>
								<td>5.</td>
								<td class="stunda"><?php echo $s['5']; ?></td> 
								<td><?php echo $s['5_k']; ?></td>
							  </tr>
							  <tr>
								<td>6.</td>
								<td class="stunda"><?php echo $s['6']; ?></td> 
								<td><?php echo $s['6_k']; ?></td>
							  </tr>
							  <tr>
								<td>7.</td>
								<td class="stunda"><?php echo $s['7']; ?></td> 
								<td><?php echo $s['7_k']; ?></td>
							  </tr>
							  <tr>
								<td>8.</td>
								<td class="stunda"><?php echo $s['8']; ?></td> 
								<td><?php echo $s['8_k']; ?></td>
							  </tr>
							  <tr>
								<td>9.</td>
								<td class="stunda"><?php echo $s['9']; ?></td> 
								<td><?php echo $s['9_k']; ?></td>
							  </tr>
							</table>
							<?php
							}
						}
						?>

							
						</div>
					  </div>
					  
					  <div class="col-3">
					    <div class="panel-group">
							<div class="panel panel-default">
							  <div class="panel-heading">Ģimnāzijas Vērtības</div>
							  <div class="panel-body"><br><center><img class="vertibas" src="images/vertiba1.png"/></center><br></div>
							  <div class="panel-body"><br><center><img class="vertibas" src="images/vertiba2.png"/></center><br></div>
							  <div class="panel-body">
							  <br>
							  <p style="text-align:left; margin-left: 20%;">
							    <b>“Sevi pilnīgu darīt,<br>
								Sevi citiem ziedot,<br>
								Lauzt gaismai ceļu…”</b><br>
								/Rainis/</p>
							  </div>
							</div>
							<div class="panel panel-default">
							  <div class="panel-heading">Pēdējie Ziņojumi</div>
							  <div class="panel-body"></div>
							</div>
							<div class="panel panel-default">
							  <div class="panel-heading">Saites</div>
							  <div class="panel-body">
							  <br><center><a href="https://www.mykoob.lv/" target="_blank"><img class="vertibas" src="images/mykoob_logo.png"/></a></center><br>
							  <center><a href="https://www.eduspace.lv/" target="_blank"><img class="vertibas" src="images/eduspace_logo.png"/></a></center><br>
							  </div>
							</div>
						</div>
					  </div>
					  
					</div>
				</div>
			</section>
		<?php include('includes/footer.php'); ?>
	</body>
</html>
