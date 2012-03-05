<?php
////Denne klassen inneholder alle input-tabeller som benyttes av cookie webshop.
	//Det vil si at dette er en VIEW-klasse som ikke gj¯r noe annet enn Â vise tabeller 
		//og sende data til funksjoner til de ulike klassene.
class View {

//§§§§§§§§§§§§§§§§§§§§§§§§§§§ INPUT §§§§§§§§§§§§§§§§§§§§§§§§§§§§§
		//En temp. simpel mother-fucker som sjekker at konseptet fungerer faktisk.
			//And it fucking does..
	function newUserTable() {
		$content = 
			"<form action='' name='userData'  method='post' id='newUser' accept-charset='utf-8'>
				Fornavn: <input type='text' name='first' /> <br />
				Etternavn: <input type='text' name='last' /> <br />
				<input type='submit' value='OK' />	
			</form>";
		return $content;
		}
		
	function editUserTable($input) {
		$content = 
			"<form action='?edit=send' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Fornavn:</td><td><input type='text' name='fname' value='".$input[0][1]."'/></td></tr>
					<tr><td>Etternavn:</td><td><input type='text' name='sname' value='".$input[0][2]."'/></td></tr>
					<tr><td>Addresse:</td><td><input type='text' name='address' value='".$input[0][3]."'/></td></tr>
					<tr><td>Postnummer:</td><td><input type='text' name='zipcode' value='".$input[0][4]."'/></td></tr>
					<tr><td>Epost:</td><td><input type='email' name='email' value='".$input[0][5]."'/></td></tr>
					<tr><td>Brukernavn:</td><td><input type='text' name='username' value='".$input[0][6]."'/></td></tr>
					<tr><td>Nytt passord:</td><td><input type='password' name='password' /></td></tr>
					<tr><td>Gjenta passord:</td><td><input type='password' name='password2' /></td></tr>
				</table>
				<input type='hidden' name ='uid' value='".$input[0][0]."' /> 
				<input type='submit' value='Oppdater' id='button' />
			</form>";
		echo $content;	
	}
		
		
		//Denne vises kun nÂr adminbruker er verifisert og logget inn.
		//Hvilke data som skal inn er beskrevet i sql-tabellen.
	function newAdminTable() {
		$content = 
			"<form action='?user=sendNew' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Fornavn:</td><td><input type='text' name='fname' /></td></tr>
					<tr><td>Etternavn:</td><td><input type='text' name='sname' /></td></tr>
					<tr><td>Brukernavn:</td><td><input type='text' name='username' /></td></tr>
					<tr><td>Epost:</td><td><input type='email' name='email' /></td></tr>
					<tr><td>Rettigheter:</td><td><select name='admin'><option value='1'>Admin</option><option value='0'>Medarbeider</option></select></td></tr>
					<tr><td>Passord:</td><td><input type='password' name='password' /></td></tr>
					<tr><td>Gjenta passord:</td><td><input type='password' name='password2' /></td></tr>
				</table>
				<input type='submit' value='Legg til' id='button' />	
			</form>";
		echo $content;	
	}
	
	function editAdminTable($input) {
		$aID = $input[0][0];
		$selected = "";
		if ($input[0][6] == "0") { $selected = 'selected'; }
		$content = 
			"<form action='?edit=send' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Fornavn:</td><td><input type='text' name='fname' value='".$input[0][1]."'/></td></tr>
					<tr><td>Etternavn:</td><td><input type='text' name='sname' value='".$input[0][2]."'/></td></tr>
					<tr><td>Brukernavn:</td><td><input type='text' name='username' value='".$input[0][4]."'/></td></tr>
					<tr><td>Epost:</td><td><input type='email' name='email' value='".$input[0][3]."'/></td></tr>
					<tr><td>Rettigheter:</td><td><select name='admin'><option value='1'>Admin</option><option value='0' ".$selected.">Medarbeider</option></select></td></tr>
					<tr><td>Nytt passord:</td><td><input type='password' name='password' /></td></tr>
					<tr><td>Gjenta passord:</td><td><input type='password' name='password2' /></td></tr>
				</table>
				<input type='hidden' name ='aid' value='".$aID."' /> 
				<input type='submit' value='Oppdater' id='button' />
			</form>";
		echo $content;	
	}
	
		// Denne vises i admin-panel OG employee-panel
	function NewCategoryTable() {
	
	}
	
		//Vises ogsÂ hvis man er admin eller medarbeider
		//Det skal IKKE vÊre mulig Â opprette en ny vare i en ukjent kategori
	function NewItemTable() {
		
	}
	
		//Brukere skal kunne legge til ordre.
		//Ser for meg to superavanserte dropdown-boxer som f¯rst viser kategori og 
			//deretter varen i denne kategorien.
		//Tenker at nÂr bruker har valgt kategori, vare og har trykt OK, sendes bruker til
			//siden til valgt vare som viser informasjon om den og bestill-knapp som legger
			//til varen til handlevogn.
				//Valgt vare legges til (orders) pÂ en eller annen mÂte og samler alle varer
				//og slettes nÂr bruker trykker send.
			//SKAL VI LA BRUKERE ANGRE P≈ SINE VALG?? SER FOR MEG AT VI TAR DET HELT
				//TIL SLUTT
		//Det er kun kunder som har mulighet til dette. Skal en admin bestill en vare kan han
			//jaggu registrere seg som kunde.
	function NewOrder() {
	
	}
//end-ny input ---------------------------------------------------------------------------



//§§§§§§§§§§§§§§§§§§§§§§§§§§ OUTPUT §§§§§§§§§§§§§§§§§§§§§§§§§§§§§§
	function ShowUsers($order, $active) {
		// Opprett kobling mot databasen og hent users.
		$db = new Database;
		$sql = "SELECT * FROM  `user` WHERE active = '".$active."'".$order;
		$sth = $db->dbQuery($sql);
		
		$gui = new webShopGui;
		$name = $gui::orderLink("sortByUser", "sname", "Navn");	
		$zipcode = $gui::orderLink("sortByUser", "zipcode", "Poststed");	
		$username = $gui::orderLink("sortByUser", "username", "Brukernavn");
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td id='name'>".$name."</td><td>Adresse</td><td>".$zipcode."</td><td id='username'>".$username."</td><td>E-post</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) { 
		
		//Aktiver eller deaktiv link.
		if ($active == "0") {
			$changestatus = "<a href='?user=".$row['uID']."&status=1'>Aktiver </a>";
		}
		else if ($active == "1") {
			$changestatus = "<a href='?user=".$row['uID']."&status=0'>Deaktiver </a>";
		}
		
		$sql = "SELECT city FROM `Webshop`.`zipcodes` WHERE `zipcodes`.`zipcode` =".$row['zipcode'];
		$city = $db->dbQuery($sql);
		$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			// Skriv ut rader.
 		   echo "<tr".$even."><td>".$row['sname'].", ".$row['fname']."</td><td>".$row['address']."</td><td>".$row['zipcode']." ".$city[0][0]."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>".$changestatus."| <a href='?edit=".$row['uID']."'>Rediger</a></td></tr>", "\n";
			}
		
		// Avslutt tabell
		echo "</table>";
	}
	
		//Viser oversikt over ordre til enten bruker eller admin/medarbeider.
			// sender -> return: true=bruker, false=medarbeider/admin.
		//Bruker: Skal vise alle ordre som er under godkjenning og ikke sendt av aktuell bruker
		//Admin/Medarb. Viser alle ordre fra brukere som ikke er godkjent
		//FLAGG forteller bruker eller AD/MED. hvilke varer som er ubehandlet. Eks "U";
	
	
		//Admin og medarbeider skal kunne se hvem som er admin og medarbeider.
			//Skal gjøre slik at du sender inn hvilken rekkerefølge du vil at navnene skal vises.
			//Skal også få lagt inn handliger som f.eks slett bak hver bruker.
			//Må man opprette kobling til databasen i hver function eller kan dette gjøres globalt?
			//Skal legge inn slik at man ikke får opp handlingsfunksjoner hvis man kun er medarbeider.
	function showManagers($order, $active) {
		// Opprett kobling mot databasen og hent workers.
		$db = new Database;
		$sql = "SELECT * FROM  `worker` WHERE active = '".$active."'".$order;
		$sth = $db->dbQuery($sql);
		
		$gui = new webShopGui;
		$name = $gui::orderLink("sortBy", "sname", "Navn");
		$admin = $gui::orderLink("sortBy", "admin", "Rettigheter");
		$username = $gui::orderLink("sortBy", "username", "Brukernavn");
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td id='name'>".$name."</td><td id='adminstatus'>".$admin."</td><td id='username'>".$username."</td><td>E-post</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) { 
			if ($active == "0") {
				$changestatus = "<a href='?user=".$row['aID']."&status=1'>Aktiver </a>";
			}
			else if ($active == "1") {
				$changestatus = "<a href='?user=".$row['aID']."&status=0'>Deaktiver </a>";
			}
			// Finn ut om det er admin eller ikke. Skriv admin eller medarbeider istedet for 1 eller 0
			if ( $row['admin'] == 1 ){
				$admin = "Admin";
				}
			else {
				$admin = "Medarbeider";
				}
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			// Skriv ut rader.
 		   echo "<tr".$even."><td>".$row['sname'].", ".$row['fname']."</td><td>".$admin."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>".$changestatus."| <a href='?edit=".$row['aID']."'>Rediger</a></td></tr>", "\n";
			}
		
		// Avslutt tabell
		echo "</table>";
	}
	
	
	function ShowNewOrders() {
	
	}
	
		//Oversikt over ordre til bruker eller alle ordre til alle brukere som er godkjent.
			// sender -> return: true=behandlede ordre for bruker. false=alle ordre til bruker til ad/med..
		//FLAGG forteller bruker om tidligere bestillinger eller admin/medar. om alle ordre som er godkjent 
			//for alle bruker som er registrert.
	function ShowOldOrders() {
		
	}


//end-func's-output ---------------------------------------------------------------------



//§§§§§§§§§§§§§§§§§§§§§§§§§§ LOG INN §§§§§§§§§§§§§§§§§§§§§§§§§§§§§

		//Funksjon som sender brukernavn og passord til validering
			//DET M≈ SENDES EN DB FORESPÿRSEL!!
			//Slik jeg tenker det kan UserLogin-funksjon sende foresp¯rsel til
				//Database-klassen som sjekker om bruker eller passord er gyldig
					//og Database-klassen sender true eller false tilbake til validering
					//og validering gir beskjed om login lykkes eller ei.
	function UserLogin() {
	
	}
	
		//Samme som over
	function AdminLogin() {
	
	}
	
		//Samme som over
		//SPÿRSM≈LET ER OM DET FAKTISK SKAL V∆RE 3 SKJEMAER FOR INNLOGGING??
			//Tenker kanskje at det bare er login for bruker, link til ny bruker og 
				//link til administrasjon der man kan logge inn som admin eller medarbeider.
			//Det skal ikke vÊre mulig Â registrere admin eller medarbeider med mindre man
				//er logget inn som admin. Vi lager en hovedadmin i MySQL query for Â lage en admin
				//som ikke kan slettes.
	function EmployeeLogin() {
	
	}
	
	
//§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§§ MISC §§§§§§§§§§§§§§§§§§§§§§§§§§§§§§	
	
		//De ulike brukerene skal ha mulighet til Â drepe sessjonen de befinner seg i..
	function LogOut() {
	
	}
	
//end-func's-MISC-----------------------------------------------------------------------------



	//+ + + + + + En del mer + + + + + 

	
	
		
}



?>
