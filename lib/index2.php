<?php


/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!																											  !!!
!!!	SKAL DERE LEGGE TIL KOMMENTARER, MERK DEN MED C, P ELLER T    !!!
!!!				OG JA; FRA NÅ AV SÅ MERKER JEG MINE MED K					  !!!
!!!																											  !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

/*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!!	MAL FOR SKRIVEMÅTE AV FUNKSJONER, KLASSER OG VARIABLE:	      !!!
!!!	 ALLE FUNKSJONER, KLASSER OG VARIABLE SKRIVES PÅ ENGELSK.      !!!
!!!	- Funksjoner starter med stor bokstav og nytt ord har også stor. bo.	  !!!
!!!	- Klasser gjør også det. Ikke forvirredes ettersom kla. har kun et ord.  !!!
!!!	- Variable starte med liten bokstav og stor bokstav i nytt ord.              !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

//VI TRENGER Å BLI ENIGE OM HVORDAN VI STRUKTURER INDEX SLIK AT DEN
	// BLIR SÅ EFFEKTIV OG SIMPEL SOM MULIG.

include_once './View.php';
include_once './DB.php';



	//Tilkaller funksjoner fra View-klassen som viser tabeller.
$view = new view(); //  (o Y o)
                    //   )   (
                    //  (  v  )

//henter opp tabell slik at nye bruker kan registrere seg
$newUser = $view->newUserTable();

//Hvis ikke alle (navn) feltene er satt, kommer tabellen opp på nytt
if (empty($_POST['first']) || empty($_POST['last']) ) {	
	echo $newUser;

}
else {	//Hvis satt, sender data over til database klassen
	$db = new Database;
	

	$newUser = "newUser";
	$db->NewUser($newUser, $_POST);
	
	echo "<br><br>". "<a href='index.php'>index</a>";

}


?>
