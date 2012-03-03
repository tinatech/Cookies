<?php

/*
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!! ER DET EN TING SOM JEG HAR INNSETT, S≈ ER DET AT JEG TRENGER FUCKINGS MYE HJELP MED      !!!!
!!!! DATABASEN ETTERSOM DET ER EN SHITLOAD AV QUERIES SOM SKAL SJEKKES OPP MOT ALT MULIG !!!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

include_once ROOTDIR.'conf/dbconf.php';

class Database {
		
		//variabel som bare kan benyttes av Database-klassen
	private $DB;
	
	

		//Constructor kj¯rer nÂr klassen Database blir tilkalt.
		//Sjekker f¯rst om det faktisk finnes en session.
	function __construct () {
			//Simpel tilkobling opp til databasen uten hjelp av sessions.
				//sp¯rsmÂlet er om vi skal lage en egen funksjon som
				//CloseSession() eller om vi skal benytte oss av construct..
		if(Database::$this->DB == false) {
			$connect = 'mysql:host=localhost;dbname=Webshop';
			try {
				Database::$this->DB = new PDO($connect, user, password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
				//Hvis ikke funker, FAIL-message.
			catch (PDOExeption $e) {
				die ('Kan ikke koble til databasen: ' . $e->getmessage());	
			}
		} 
		return true; //  <---  Finnes en sessjon returneres true. Hvis ikke skal det genereres en.
								//Shit jeg mÂ sette meg inn i disse greiene med mindre en av dere har en l¯sning.
	}
	//end- __construct
	
		
		/*!!! Ettersom det ikke er mange funksjoner for
					sessions sÂ er det mest trivielt Â ha de i denne
					databasen. Vet ikke om vi trenger en ny klasse???*/	
		//Hvis bruker eller admin/medarbeider logger ut d¯r sessionen
			//!!!TRENGS VERIFISERING!!!!! Tror ikke dette funker uten cookies??
	function CloseSession() {
		if (Database::$this->DB != null) {
			Database::$this->DB = null;
			unset($_SESSION);
		}
		return true;
	}
	//end-CloseSession
	
	
// SKAL MAN BLI DIREKTE LOGGET INN N≈ MAN LAGER NY BRUKER 
	// ELLER M≈ MAN LOGGE INN ETTER AT MAN HAR GENERERT BRUKER???
	
//§§§§§§§§§§§§§§§§§§§§§§§§§§§§§ INPUT §§§§§§§§§§§§§§§§§§§§§§§§§§§§§
	function NewUser ($type, $input) {
	//NY BRUKER----
		if ($type = "newUser") {
				//$type forteller hva slags type input det gjelder
				//Andre parametere kan vÊre at bruker bestiller varer
			$sql = 'INSERT INTO persinfo (persid, fornavn, etternavn) 
						VALUES (0, :first, :last)';
				//Klargj¯rer databasen f¯r parametere i bindparm er satt
			$sth = Database::$this->DB->prepare($sql);
				//setter meta alias :.....
			$sth->bindParam (':first' , $_POST['first']);
			$sth->bindParam (':last', $_POST['last']);
				
			//Legger til data i databasen	
				/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				 DERE M≈ HJELPE TIL MED EN TING!!!!!!
					Hvis jeg gj¯r en feil sp¯rring ved hjelp av execute sÂ
					fÂr jeg ingen feilmelding. har ikke sjekket det ut sÂ mye,
					men nok til Â vite at dette er J∆∆VELIG irriterende.......
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
	function NewAdmin($type, $input) {
			if($type=="new"){ $sql = "INSERT INTO `Webshop`.`worker` (`aID`, `fname`, `sname`, `email`, `username`, `password`, `admin`) VALUES (NULL, :fname, :sname, :email, :username, :password, :admin)"; }
			else if($type=="update") { $sql = "UPDATE  `Webshop`.`worker` SET  `fname` =  ':fname', `sname` =  's:name', `email` =  ':email', `username` =  ':username', `password` =  ':password' WHERE  `worker`.`aID` =:aid"; }
				//Klargjører databasen før parametere i bindparm er satt
			$sth = Database::$this->DB->prepare($sql);
				//setter meta alias :.....
			$sth->bindParam (':fname' , $_POST['fname']);
			$sth->bindParam (':sname', $_POST['sname']);
			$sth->bindParam (':email', $_POST['email']);
			$sth->bindParam (':username', $_POST['username']);
			$sth->bindParam (':password', md5($_POST['password'])); // Konverterer passordet til md5
			$sth->bindParam (':admin', $_POST['admin']);
			if($type=="update") { $sth->bindParam (':aid', $_POST['aid']); }
			$sth->execute();
	}
	//end-NewAdmin
	
	//Slett admin - Send inn hvilken aID adminen har.
	function DeleteAdmin($aID) {
		$sql = "DELETE FROM `Webshop`.`worker` WHERE `worker`.`aID` = ".$aID;
		$sth = Database::$this->DB->prepare($sql);
		$sth->execute();
	}
		//Skal ogsÂ kun vÊre mulig hvis man er administrator.
		//Sendes ogsÂ hit fra View output.
	function NewEmployee ($input) {
	
	}
	//end-NewEmployee
	
//end-Func's-Input ----------------------------------------------------------------------

//§§§§§§§§§§§§§§§§§§§§§§§§§§§§§ GET §§§§§§§§§§§§§§§§§§§§§§§§§§§§§

	function GetWorker() {
	//NY BRUKER----
			$sql = "SELECT * FROM  `worker` ORDER BY  `worker`.`sname` ASC";
				//Klargj¯rer databasen f¯r parametere i bindparm er satt
			$sth = Database::$this->DB->prepare($sql);
				//setter meta alias :.....
							
			//Legger til data i databasen	
				/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				 DERE M≈ HJELPE TIL MED EN TING!!!!!!
					Hvis jeg gj¯r en feil sp¯rring ved hjelp av execute sÂ
					fÂr jeg ingen feilmelding. har ikke sjekket det ut sÂ mye,
					men nok til Â vite at dette er J∆∆VELIG irriterende.......
				!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
			$sth->execute();
		
		//end-nybruker	
		
			return $sth;
		}

//+ + + + ++ + + +MYE MER HER 

	
}
//end-Class-Database

	


?>
