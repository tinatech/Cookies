<?php
////Denne klassen inneholder alle input-tabeller som benyttes av cookie webshop.
	//Det vil si at dette er en VIEW-klasse som ikke gjør noe annet enn å vise tabeller 
		//og sende data til funksjoner til de ulike klassene.
class View {

//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ INPUT ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤
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
		
		
		//Denne vises kun når adminbruker er verifisert og logget inn.
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
	
		//Samme som NewAdminTable (Finnes bare under Adminpanelet.
	function NewEmployeeTable() {
	
	}
	
		// Denne vises i admin-panel OG employee-panel
	function NewCategoryTable() {
	
	}
	
		//Vises også hvis man er admin eller medarbeider
		//Det skal IKKE være mulig å opprette en ny vare i en ukjent kategori
	function NewItemTable() {
		
	}
	
		//Brukere skal kunne legge til ordre.
		//Ser for meg to superavanserte dropdown-boxer som først viser kategori og 
			//deretter varen i denne kategorien.
		//Tenker at når bruker har valgt kategori, vare og har trykt OK, sendes bruker til
			//siden til valgt vare som viser informasjon om den og bestill-knapp som legger
			//til varen til handlevogn.
				//Valgt vare legges til (orders) på en eller annen måte og samler alle varer
				//og slettes når bruker trykker send.
			//SKAL VI LA BRUKERE ANGRE PÅ SINE VALG?? SER FOR MEG AT VI TAR DET HELT
				//TIL SLUTT
		//Det er kun kunder som har mulighet til dette. Skal en admin bestill en vare kan han
			//jaggu registrere seg som kunde.
	function NewOrder() {
	
	}
//end-ny input ---------------------------------------------------------------------------



//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ OUTPUT ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤
	function ShowUsers() {
	
	}
	
		//Viser oversikt over ordre til enten bruker eller admin/medarbeider.
			// sender -> return: true=bruker, false=medarbeider/admin.
		//Bruker: Skal vise alle ordre som er under godkjenning og ikke sendt av aktuell bruker
		//Admin/Medarb. Viser alle ordre fra brukere som ikke er godkjent
		//FLAGG forteller bruker eller AD/MED. hvilke varer som er ubehandlet. Eks "U";
	
	
		//Admin og medarbeider skal kunne se hvem som er admin og medarbeider.
			//Skal gj¿re slik at du sender inn hvilken rekkeref¿lge du vil at navnene skal vises.
			//Skal ogsŒ fŒ lagt inn handliger som f.eks slett bak hver bruker.
			//MŒ man opprette kobling til databasen i hver function eller kan dette gj¿res globalt?
			//Skal legge inn slik at man ikke fŒr opp handlingsfunksjoner hvis man kun er medarbeider.
	function showManagers($order) {
		// Opprett kobling mot databasen og hent workers.
		$db = new Database;
		$sql = "SELECT * FROM  `worker` ".$order;
		$sth = $db->dbQuery($sql);
		
		$gui = new webShopGui;
		$name = $gui::orderLink("sname", "Navn");
		$admin = $gui::orderLink("admin", "Rettigheter");
		$username = $gui::orderLink("username", "Brukernavn");
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td>".$name."</td><td>".$admin."</td><td>".$username."</td><td>E-post</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) { 
			// Finn ut om det er admin eller ikke. Skriv admin eller medarbeider istedet for 1 eller 0
			if ( $row['admin'] == 1 ){
				$admin = "Admin";
				}
			else {
				$admin = "Medarbeider";
				}
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall fŒr <tr> klassen .even
			// Skriv ut rader.
 		   echo "<tr".$even."><td>".$row['sname'].", ".$row['fname']."</td><td>".$admin."</td><td>".$row['username']."</td><td>".$row['email']."</td><td><a href='?remove=".$row['aID']."'>Slett </a>| <a href='?edit=".$row['aID']."'>Rediger</a></td></tr>", "\n";
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



//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ LOG INN ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤

		//Funksjon som sender brukernavn og passord til validering
			//DET MÅ SENDES EN DB FORESPØRSEL!!
			//Slik jeg tenker det kan UserLogin-funksjon sende forespørsel til
				//Database-klassen som sjekker om bruker eller passord er gyldig
					//og Database-klassen sender true eller false tilbake til validering
					//og validering gir beskjed om login lykkes eller ei.
	function UserLogin() {
	
	}
	
		//Samme som over
	function AdminLogin() {
	
	}
	
		//Samme som over
		//SPØRSMÅLET ER OM DET FAKTISK SKAL VÆRE 3 SKJEMAER FOR INNLOGGING??
			//Tenker kanskje at det bare er login for bruker, link til ny bruker og 
				//link til administrasjon der man kan logge inn som admin eller medarbeider.
			//Det skal ikke være mulig å registrere admin eller medarbeider med mindre man
				//er logget inn som admin. Vi lager en hovedadmin i MySQL query for å lage en admin
				//som ikke kan slettes.
	function EmployeeLogin() {
	
	}
	
	
//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ MISC ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤	
	
		//De ulike brukerene skal ha mulighet til å drepe sessjonen de befinner seg i..
	function LogOut() {
	
	}
	
//end-func's-MISC-----------------------------------------------------------------------------



	//+ + + + + + En del mer + + + + + 

	
	
		
}



?>
