<?php
include "hjelpefunksjoner.php";
include "database.php";

topp();
h1('The Dark Cookie Shop...');
?>

<div id="menu"> 
					
					<div class="menu">
						<ul> 
							<a href="index.php" ><li>Forsiden</li> </a>
							<a href="om.php" ><li>The Dark Cookie Shop</li> </a>
							<a href="vare.php" id="current"><li>Varer</li> </a>
							<a href="kontakt.php"><li>Kontakt oss</li> </a>
							<a href="ansatt.php"><li>Ansatt</li> </a>
						</ul> 
                
					</div> 
				</div> 
<div id="content1">

<div id="sidebar"> <!--start sidebar-->	
	<div id="search"> <!--start search-->	
		<h3>Vares�k</h3>
		<form method="POST" action="varesok.php">
		<p>Varenavn: <input type="text" name="txtSok" size="20"></p>
		<p>
		  <input type="submit" value="S�k i varer" name="sendKnapp">
		  <input type="reset" value="Rensk skjema" name="renskKnapp">
		</p>
		</form>
	</div> <!--end search-->
	<div id="bestsellers"> <!--start bestsellers-->
			<h3>5 p� topp</h3>
			<?php
			$forbindelse = koble_opp();
			vis_bestselgere(5);
			mysql_close($forbindelse);
			?>
			<p>hububa</p>
	</div> <!--end bestsellers-->
	<div id="login"> <!--start login-->
		<h3>Innlogging</h3>
		<form name="f1" type="post" action="#"> 
		<table border="0" width="50%">
			<tr>
			  <td><p>Brukernavn:</p></td>
			  <td><input type="text" name="brukernavn" size="20"></td>
			</tr>
			<tr>
			  <td><p>Passord:</p></td>
			  <td><input type="password" name="passord" size="20"></td>
			</tr>
			</table>
			<p>
				<input type='submit' value='Logg inn' onclick="this.form.target='_blank';return true;"> 
                <input type='submit' value='Ny bruker?' onclick="f1.action='ny_bruker.php'; return true;"> 
                <input type="reset" value="Rensk skjema" name="renskKnapp"> 
			</p>
		</form>
	</div> <!--end login-->
</div> <!--end sidebar-->

	
	<h2> Omnomnom </h2>
	<p>Welcome to the dark side, we have cookies... </p>
	<p>- Petter, Christoffer, Kjetil og Tina</p>
	
	
	
</div>

<?php
bunn();
?>
