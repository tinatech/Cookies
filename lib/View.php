<?php

include_once './lib/DB.php';

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
	function NewAdminTable() {
	
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
	function ShowManagers() {
	
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
