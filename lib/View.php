<?php
////Denne klassen inneholder alle input-tabeller som benyttes av cookie webshop.
	//Det vil si at dette er en VIEW-klasse som ikke gj¯r noe annet enn Â vise tabeller 
		//og sende data til funksjoner til de ulike klassene.
class View {

//§§§§§§§§§§§§§§§§§§§§§§§§§§§ INPUT §§§§§§§§§§§§§§§§§§§§§§§§§§§§§
		//En temp. simpel mother-fucker som sjekker at konseptet fungerer faktisk.
			//And it fucking does..
			
	//Registrer ny kunde i frontend		
	function newUserTable() {
		$content = 
			"<form action='?user=send' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Fornavn:</td><td><input type='text' name='fname' /></td></tr>
					<tr><td>Etternavn:</td><td><input type='text' name='sname' /></td></tr>
					<tr><td>Addresse:</td><td><input type='text' name='address' /></td></tr>
					<tr><td>Postnummer:</td><td><input type='text' name='zipcode' /></td></tr>
					<tr><td>Epost:</td><td><input type='email' name='email' /></td></tr>
					<tr><td>Brukernavn:</td><td><input type='text' name='username' /></td></tr>
					<tr><td>Nytt passord:</td><td><input type='password' name='password' /></td></tr>
					<tr><td>Gjenta passord:</td><td><input type='password' name='password2' /></td></tr>
				</table>
				<input type='submit' value='Registrer' id='button' />
			</form>";
		echo $content;	
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
	function newCategoryTable() {
		$content = 
			"<form action='?cat=newsend' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Navn:</td><td><input type='text' name='name' /></td></tr>
					<tr><td>Beskrivelse:</td><td><input type='textarea' name='descr' /></td></tr>
				</table>
				<input type='submit' value='Legg til' id='button' />	
			</form>";
		echo $content;	
	}
	
		//Vises ogsÂ hvis man er admin eller medarbeider
		//Det skal IKKE vÊre mulig Â opprette en ny vare i en ukjent kategori
	function NewItemTable() {
		$db = new Database;
		$sql = "SELECT * FROM `category`";
		$sth = $db->dbQuery($sql);
		
		$content = 
			"<form action='?item=newsend' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Navn:</td><td><input type='text' name='name' /></td></tr>
					<tr><td>Beskrivelse:</td><td><input type='text' name='desc' /></td></tr>
					<tr><td>Kategori:</td><td><select name='cat'>";
		echo $content;
		foreach($sth as $row) { 
		 echo "<option value='".$row['catID']."'>".$row['name']."</option>";
		}
					
		$content2 =	"</select></td></tr>
					<tr><td>Antall:</td><td><input type='number' min='0' name='quantity' style='width: 50px;' /></td></tr>
					<tr><td>Pris:</td><td><input type='number' min='0' name='price' style='width: 50px;' /></td></tr>
				</table>
				<input type='submit' value='Legg til' id='button' />	
			</form>";
		echo $content2;		
	}
	
	function editItem($input) {
		$db = new Database;
		$sql = "SELECT * FROM `category`";
		$sth = $db->dbQuery($sql);
		$sql2 = "SELECT * FROM `Webshop`.`categories` WHERE `categories`.`itemID` =".$input[0][0];
		$catID = $db->dbQuery($sql2);
		
		$content = 
			"<form action='?item=editsend' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Navn:</td><td><input type='text' name='name' value='".$input[0][1]."' /></td></tr>
					<tr><td>Beskrivelse:</td><td><input type='text' name='desc' value='".$input[0][3]."' /></td></tr>
					<tr><td>Kategori:</td><td><select name='cat'>";
		echo $content;
		foreach($sth as $row) {
			if ($catID[0][0] == $row['catID']) { $selected = "selected"; }
			else { $selected = ""; }
		 	echo "<option value='".$row['catID']."' ".$selected.">".$row['name']."</option>";
		}
					
		$content2 =	"</select></td></tr>
					<tr><td>Antall:</td><td><input type='number' min='0' name='quantity' style='width: 50px;' value='".$input[0][2]."' /></td></tr>
					<tr><td>Pris:</td><td><input type='number' min='0' name='price' style='width: 50px;' value='".$input[0][4]."' /></td></tr>
				</table>
				<input type='hidden' name='itemid' value='".$input[0][0]."' />
				<input type='hidden' name='oldCatId' value='".$catID[0][0]."' />
				<input type='submit' value='Oppdater' id='button' />	
			</form>";
		echo $content2;		
	}
	
	function updateItemQuantity($itemID) {
		$content = "<form action='?item=updatesend' method='post' accept-charset='utf-8' id='new'>
				<table>
					<tr><td>Antall:</td><td><input type='number' min='0' name='quantity' style='width: 50px;' /></td></tr>
				</table>
				<input type='hidden' name ='itemid' value='".$itemID."' /> 
				<input type='submit' value='Legg til' id='button' />
			</form>";
		echo $content;
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
	
	/* Funksjon som tar imot om sorteringsrekkefølge på outputen og
	 * om kunden er markert som aktiv eller ikke.
	 *
	 * Returns:
	 * Tabell med alle aktive eller inaktive brukere.
	 *
	 * example:
	 * $order = 'ORDER BY `sname` ASC';
	 * $active = '1';
	 *
	 */	 
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
	
	
	/* Funksjon som tar imot om sorteringsrekkefølge på outputen og
	 * om medarbeideren er markert som aktiv eller ikke.
	 *
	 * Returns:
	 * Tabell med alle aktive eller inaktive medarbeidere.
	 *
	 * example:
	 * $order = 'ORDER BY `sname` ASC';
	 * $active = '1';
	 *
	 */	 
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
		
		// Kun default admin kan redigere admin profilen. 
		if ($_SESSION['aID'] == "1" || $row['aID'] != "1") {
			if ($active == "0") {
				$changestatus = "<a href='?user=".$row['aID']."&status=1'>Aktiver </a>| <a href='?edit=".$row['aID']."'>Rediger</a>";
			}
			else if ($active == "1") {
				$changestatus = "<a href='?user=".$row['aID']."&status=0'>Deaktiver </a>| <a href='?edit=".$row['aID']."'>Rediger</a>";
			}
		}
		else { $changestatus = ""; }
		
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
 		   echo "<tr".$even."><td>".$row['sname'].", ".$row['fname']."</td><td>".$admin."</td><td>".$row['username']."</td><td>".$row['email']."</td><td>".$changestatus."</td></tr>", "\n";
			}
		
		// Avslutt tabell
		echo "</table>";
	}
	
	
	function showCategories($order) {
	// Opprett kobling mot databasen og hent workers.
		$db = new Database;
		$sql = "SELECT * FROM  `category` ".$order;
		$sth = $db->dbQuery($sql);
		
		$gui = new webShopGui;
		$category = $gui::orderLink("sortByCategory", "name", "Kategori");
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td id='name'>".$category."</td><td>Beskrivelse</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) { 
			if($row['catID'] != '1') {
				$edit = "<a href='?edit=".$row['catID']."'>Rediger</a>";
			}
			else { $edit = ""; }
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			// Skriv ut rader.
 		   echo "<tr".$even."><td>".$row['name']."</td><td>".$row['descr']."</td><td>".$edit."</td></tr>", "\n";
			}
		
		// Avslutt tabell
		echo "</table>";
	}
	
	function showItems($order) {
	// Opprett kobling mot databasen og hent workers.
		$db = new Database;
		$sql = "SELECT * FROM  `item` ".$order;
		$sth = $db->dbQuery($sql);
		
		$gui = new webShopGui;
		$item = $gui::orderLink("sortByItem", "name", "Vare");
		$quantity = $gui::orderLink("sortByItem", "quantity", "Antall");
		$price = $gui::orderLink("sortByItem", "price", "Pris");
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td id='name'>".$item."</td><td>Beskrivelse</td><td>Kategori</td><td>".$quantity."</td><td>".$price."</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) { 
			$sql = "SELECT * FROM  `categories` WHERE `itemID` = '".$row['itemID']."'";
			$catId = $db->dbQuery($sql);
			$sql = "SELECT * FROM  `category` WHERE `catID` = '".$catId[0][0]."'";
			$cat = $db->dbQuery($sql);
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			// Skriv ut rader.
 		   echo "<tr".$even."><td>".$row['name']."</td><td>".$row['desc']."</td><td>".$cat[0][1]."</td><td>".$row['quantity']."</td><td>".$row['price'].",-</td><td><a href='?edit=".$row['itemID']."&update=quantity'>Varemottak</a> | <a href='?edit=".$row['itemID']."'>Rediger</a></td></tr>", "\n";
			}
		
		// Avslutt tabell
		echo "</table>";
	}
	
	function showOrders($status, $order) {
	// Opprett kobling mot databasen og hent order.
		$db = new Database;
		if($status == "all") {
			$sql = "SELECT * FROM  `order` ".$order;
		}
		else {
			$sql = "SELECT * FROM  `order` WHERE `order`.`status` =".$status." ".$order;
		}
		$sth = $db->dbQuery($sql);
		
		
		
		// Skriv ut tabellstart
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td>OrdreID</td><td>Kundenavn</td><td>Status</td><td>Bestillingsdato</td><td>Handlinger</td></tr>", "\n";
		$rowCount = 0;
		foreach($sth as $row) {
			$sql = "SELECT * FROM  `user` WHERE `uID` =".$row['uid'];
			$name = $db->dbQuery($sql);
			
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			
			echo "<tr".$even."><td>".$row['orderID']."</td><td>".$name[0][2].", ".$name[0][1]."</td><td><span id='status".$row['status']."'></span></td><td>".$row['time']."</td><td><a href='order.php?order=".$row['orderID']."'>Se ordre</a> | <a href='#'>Slett</a></td></tr>", "\n";
		}
		// Avslutt tabell
		echo "</table>";
	}

	function showOrder($orderid) {
	// Opprett kobling mot databasen og hent workers.
		$db = new Database;
		$sql = "SELECT * FROM  `orderlines` WHERE `orderlines`.`orderid` =".$orderid;
		$sth = $db->dbQuery($sql);
		
		$sql = "SELECT * FROM  `order` WHERE `order`.`orderID` =".$orderid;
		$order = $db->dbQuery($sql);
		
		$sql = "SELECT * FROM  `user` WHERE `user`.`uID` =".$order[0][1];
		$user = $db->dbQuery($sql);
		
		$sql = "SELECT * FROM  `zipcodes` WHERE `zipcodes`.`zipcode` =".$user[0][4];
		$city = $db->dbQuery($sql);
		
		// Skriv ut tabellstart
		echo "<strong>Bestillingsadresse:</strong><br />";
		echo $user[0][1]." ".$user[0][2]."<br />", "\n";
		echo $user[0][3]."<br />", "\n";
		echo $user[0][4]." ".$city[0][1]."<br /><br />", "\n";
		
		echo "<table id=\"workers\" cellspacing=\"0\">", "\n";
		echo "<tr id=\"overskrift\"><td>Vare</td><td>Antall</td><td>Enhetspris</td><td>Totalpris</td></tr>", "\n";
		$rowCount = 0;
		$totalprice = 0;
		foreach($sth as $row) {
			$sql = "SELECT * FROM  `item` WHERE `item`.`itemID` =".$row['itemID'];
			$item = $db->dbQuery($sql);
			$even = ""; // Hvis det er partall som settes ikke inn noen ekstra klasse
			$price = $row['quantity'] * $row['price'];
			if ($rowCount++ % 2 == 1 ) {$even = ' class="even"';} // Ved oddetall får <tr> klassen .even
			
			echo "<tr".$even."><td>".$item[0][1]."</td><td>".$row['quantity']."</td><td>".$row['price'].",-</td><td>".$price.",-</td></tr>", "\n";
			
			$totalprice = $totalprice + $price;
		}
		// Avslutt tabell
		echo "<tr id=\"overskrift\"><td></td><td></td><td>Totalpris:</td><td>".$totalprice.",-</td></tr>";
		echo "</table>";
	}

//end-func's-output ---------------------------------------------------------------------



//§§§§§§§§§§§§§§§§§§§§§§§§§§ LOG INN §§§§§§§§§§§§§§§§§§§§§§§§§§§§§

		//Funksjon som sender brukernavn og passord til validering
			//DET M≈ SENDES EN DB FORESPÿRSEL!!
			//Slik jeg tenker det kan UserLogin-funksjon sende foresp¯rsel til
				//Database-klassen som sjekker om bruker eller passord er gyldig
					//og Database-klassen sender true eller false tilbake til validering
					//og validering gir beskjed om login lykkes eller ei.
	function showLogin() {
		$form = '
			<div id="login">
				<form action="login.php" method="post">
					<label for="username">Brukernavn: </label>
					<input type="text" name="username" maxlength="20"/><br/>
					<label for="password">Passord: </label>
					<input type="text" name="password" maxlength="20"/><br/>
					<input type="submit" name="submit" value="Login"/>
				</form>
			</div>';

		echo $form;	
	}	
}
?>
