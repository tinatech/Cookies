<?php

/*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!! ER DET EN TING SOM JEG HAR INNSETT, SÅ ER DET AT JEG TRENGER FUCKINGS MYE HJELP MED      !!!!
!!!! DATABASEN ETTERSOM DET ER EN SHITLOAD AV QUERIES SOM SKAL SJEKKES OPP MOT ALT MULIG !!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

include_once ROOTDIR.'conf/dbconf.php';

class Database {
		
		//variabel som bare kan benyttes av Database-klassen
	private $DB;
	
	

		//Constructor kjører når klassen Database blir tilkalt.
		//Sjekker først om det faktisk finnes en session.
	function __construct () {
			//Simpel tilkobling opp til databasen uten hjelp av sessions.
				//spørsmålet er om vi skal lage en egen funksjon som
				//CloseSession() eller om vi skal benytte oss av construct..
		if(Database::$this->DB == false) {
			$connect = 'mysql:host=127.0.0.1;dbname=personinfo';
			try {
				Database::$this->DB = new PDO($connect, user, password);
			}
				//Hvis ikke funker, FAIL-message.
			catch (PDOExeption $e) {
				die ('Kan ikke koble til databasen: ' . $e->getmessage());	
			}
		} 
		return true; //  <---  Finnes en sessjon returneres true. Hvis ikke skal det genereres en.
								//Shit jeg må sette meg inn i disse greiene med mindre en av dere har en løsning.
	}
	//end- __construct
	
		
		/*!!! Ettersom det ikke er mange funksjoner for
					sessions så er det mest trivielt å ha de i denne
					databasen. Vet ikke om vi trenger en ny klasse???*/	
		//Hvis bruker eller admin/medarbeider logger ut dør sessionen
			//!!!TRENGS VERIFISERING!!!!! Tror ikke dette funker uten cookies??
	function CloseSession() {
		if (Database::$this->DB != null) {
			Database::$this->DB = null;
			unset($_SESSION);
		}
		return true;
	}
	//end-CloseSession
	
	
// SKAL MAN BLI DIREKTE LOGGET INN NÅ MAN LAGER NY BRUKER 
	// ELLER MÅ MAN LOGGE INN ETTER AT MAN HAR GENERERT BRUKER???
	
//¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤ INPUT ¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤
	function NewUser ($type, $input) {
	//NY BRUKER----
		if ($type = "newUser") {
				//$type forteller hva slags type input det gjelder
				//Andre parametere kan være at bruker bestiller varer
			$sql = 'INSERT INTO persinfo (persid, fornavn, etternavn) 
						VALUES (0, :first, :last)';
				//Klargjører databasen før parametere i bindparm er satt
			$sth = Database::$this->DB->prepare($sql);
				//setter meta alias :.....
			$sth->bindParam (':first' , $_POST['first']);
			$sth->bindParam (':last', $_POST['last']);
				
			//Legger til data i databasen	
				/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				 DERE MÅ HJELPE TIL MED EN TING!!!!!!
					Hvis jeg gjør en feil spørring ved hjelp av execute så
					får jeg ingen feilmelding. har ikke sjekket det ut så mye,
					men nok til å vite at dette er JÆÆVELIG irriterende.......
				!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
			$sth->execute();
		}
		//end-nybruker	
		
			//hjelpevariabel som viser hva som faktisk finnes i array
		print_r($sth);
		
	}
	//end-UserInput
	
		//Tar imot ny admin som KUN er tilgjengelig fra admin panelet.
		//Sendes hit fra View og lagrer i databasen
	function NewAdmin($input) {
	
	}
	//end-NewAdmin
	
		//Skal også kun være mulig hvis man er administrator.
		//Sendes også hit fra View output.
	function NewEmployee ($input) {
	
	}
	//end-NewEmployee
	
//end-Func's-Input ----------------------------------------------------------------------



//+ + + + ++ + + +MYE MER HER 

	
}
//end-Class-Database

	


?>
