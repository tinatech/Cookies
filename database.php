<!--
	Dette er en databasefil.  her har vi en del funksjoner
-->
<?php
function koble_opp(){

	$tjener = "localhost";
	$brukernavn = "root";
	$passord = "";
	$db = "nettbutikk";
	
	$forbindelse = mysql_connect($tjener, $brukernavn, $passord);
	mysql_select_db($db);
	
	return $forbindelse;
}

function ny_bruker ($con, $fornavn, $etternavn, $brukernavn, $passord) {
	
 $operTekst = "Bruker Opprettet";
  $sql = "INSERT INTO Kunde (Fornavn, Etternavn, Brukernavn, Passord) " .
         "VALUES ('$fornavn','$etternavn','$brukernavn','$passord')";			  
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}

function ny_medarbeider ($con, $fornavn, $etternavn, $ansattnavn, $passord) {
	
 $operTekst = "Medarbeider Opprettet";
  $sql = "INSERT INTO Medarbeider (Fornavn, Etternavn, Ansattnavn, Passord) " .
         "VALUES ('$fornavn','$etternavn','$ansattnavn','$passord')";			  
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}
function endre_bruker ($con, $kundenr, $fornavn, $etternavn, $brukernavn, $passord) { 

$sql = "UPDATE Kunde  
		SET Fornavn='$fornavn', Etternavn='$etternavn', Brukernavn='$brukernavn', Passord='$passord';
		WHERE KNr='$kundenr')";
 
$resultat = mysql_query( $sql );

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
}

function vis_kundeinfo($brukernavn, $passord)
{
  $sql = "SELECT * FROM Kunde WHERE Brukernavn = '" . $brukernavn .
         "' AND Passord = '" . $passord . "';";
  $resultat = mysql_query($sql);

  if (mysql_num_rows($resultat) == 1)
  {
    $rad = mysql_fetch_array($resultat, MYSQL_ASSOC);
    $_SESSION["knr"] = $rad["KNr"];
    $_SESSION["brukernavn"] = $rad["Brukernavn"];
    $_SESSION["fornavn"] = $rad["Fornavn"];
    $_SESSION["etternavn"] = $rad["Etternavn"];
}
}

function gyldig_bruker($brukernavn, $passord)
{
  $sql = "SELECT * FROM Kunde WHERE Brukernavn = '" . $brukernavn .
         "' AND Passord = '" . $passord . "';";
  $resultat = mysql_query($sql);
  
  if (mysql_num_rows($resultat) == 1)
  {
    $rad = mysql_fetch_array($resultat, MYSQL_ASSOC);
    $_SESSION["knr"] = $rad["KNr"];
    $_SESSION["brukernavn"] = $rad["Brukernavn"];
    $_SESSION["fornavn"] = $rad["Fornavn"];
    $_SESSION["etternavn"] = $rad["Etternavn"];
    return true;
  }
  else
  {
    return false;
  }
}

function lukk_sesjon()
{
  unset($_SESSION["brukernavn"]);
  unset($_SESSION["fornavn"]);
  unset($_SESSION["etternavn"]);
  unset($_SESSION["kurv"]);
}

function vis_varer($varenavn)
{
  $sql = "SELECT * FROM Vare " .
         "WHERE Betegnelse LIKE '%" . $varenavn . "%' " .
         "ORDER BY Betegnelse;";
  $resultat = mysql_query($sql);

  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  print("<table border='1'>\n");

  print("<tr>\n");
  print("<th>Varekode</th>\n");
  print("<th>Betegnelse</th>\n");
  print("<th>Pris</th>\n");
  print("<th>Antall</th>\n");
  print("</tr>\n");

  while ($linje)
  {
    $varekode = $linje["Varekode"];
    $betegnelse = $linje["Betegnelse"];
    $pris = $linje["PrisPrEnhet"];
    $antall = $linje["LagerAntall"];

    print("<tr>\n");
    print("<td>" . $varekode . "</td>\n");
    print("<td>" . $betegnelse . "</td>\n");
    print("<td>" . number_format($pris,2) . " kr</td>\n");
    print("<td>" . $antall . "</td>\n");
    print("</tr>\n");

    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }
  print("</table>\n");
}
function endre_vare_kunde() {
	
	 $sql = "UPDATE Ordre  
		SET Fornavn='$fornavn', Etternavn='$etternavn', Brukernavn='$brukernavn', Passord='$passord';
		WHERE KNr='$kundenr')";
  $resultat = mysql_query( $sql );

  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  print("<table border='1'>\n");

  print("<tr>\n");
  print("<th>Varekode</th>\n");
  print("<th>Betegnelse</th>\n");
  print("<th>Pris</th>\n");
  print("<th>Antall</th>\n");
  print("</tr>\n");

  while ($linje)
  {
    $varekode = $linje["Varekode"];
    $betegnelse = $linje["Betegnelse"];
    $pris = $linje["PrisPrEnhet"];
    $antall = $linje["LagerAntall"];

    print("<tr>\n");
    print("<td><a href='rediger_vare.php?varekode=" . $varekode ."'>" .
           $varekode . "</a></td>\n");
    print("<td>" . $betegnelse . "</td>\n");
    print("<td>" . number_format($pris,2) . " kr</td>\n");
    print("<td>" . $antall . "</td>\n");
    print("</tr>\n");

    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }
  print("</table>\n");
}
function vedlikehold_varer()
{
  $sql = "SELECT * FROM Vare ORDER BY Betegnelse;";
  $resultat = mysql_query( $sql );

  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  print("<table border='1'>\n");

  print("<tr>\n");
  print("<th>Varekode</th>\n");
  print("<th>Betegnelse</th>\n");
  print("<th>Pris</th>\n");
  print("<th>Antall</th>\n");
  print("</tr>\n");

  while ($linje)
  {
    $varekode = $linje["Varekode"];
    $betegnelse = $linje["Betegnelse"];
    $pris = $linje["PrisPrEnhet"];
    $antall = $linje["LagerAntall"];

    print("<tr>\n");
    print("<td><a href='rediger_vare.php?varekode=" . $varekode ."'>" .
           $varekode . "</a></td>\n");
    print("<td>" . $betegnelse . "</td>\n");
    print("<td>" . number_format($pris,2) . " kr</td>\n");
    print("<td>" . $antall . "</td>\n");
    print("</tr>\n");

    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }
  print("</table>\n");
}

function vis_bestselgere($n)
{
  $sql = "SELECT O.Antall, V.Betegnelse FROM Vare V, Ordrelinje O ORDER BY O.Antall LIMIT $n;";
  $resultat = mysql_query($sql);

  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  print("<ol>\n");
  while ($linje)
  {
    $betegnelse = $linje["Betegnelse"];
    print("<li>" . $betegnelse . "</li>\n");
    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }

  
  print("</ol>\n");
}


function hent_vare($varekode)
{
  $sql = "SELECT * FROM Vare " .
         "WHERE Varekode='" . $varekode . "';";
  $resultat = mysql_query( $sql );
  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  return $linje;
}

function med_siste_ordre ()
{
  	$sql = "SELECT O.OrdreNr, O.OrdreDato, O.KNr, L.Varekode, L.PrisPrEnhet, L.Antall FROM Ordre O, Ordrelinje L ORDER BY O.OrdreNr";
	$resultat = mysql_query($sql);
	$linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
	
	
	print("<table border='1'>\n");
	print("<tr>\n");
	print("<tr>Siste Ordre</tr>\n");
	print("<th>OrdreNr</th>\n");
	print("<th>OrdreDato</th>\n");
	print("<th>KundeNr</th>\n");
	print("<th>Varekode</th>\n");
	print("<th>Pris</th>\n");
	print("<th>Antall</th>\n");
	print("</tr>\n");

	$ordredato = $linje["OrdreDato"];
	$ordrenr = $linje["OrdreNr"];
	$kunde = $linje["KNr"];
	$varekode = $linje["Varekode"];
    $pris = $linje["PrisPrEnhet"];
    $antall = $linje["Antall"];

    print("<tr>\n");
	print("<td>" . $ordrenr . "</td>\n");
	print("<td>" . $ordredato . "</td>\n");
	print("<td>" . $kunde . "</td>\n");
    print("<td>" . $varekode . "</td>\n");
    print("<td>" . number_format($pris,2) . "</td>\n");
    print("<td>" . $antall . "</td>\n");
    print("</tr>\n");

    }



function hent_siste_ordre()
{
  $sql = "SELECT MAX(OrdreNr) AS maxnr FROM Ordre;";
  $resultat = mysql_query($sql);
  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  return $linje["maxnr"];
}

function vis_ordre()
{
	$sql = "SELECT O.OrdreNr, O.OrdreDato, O.KNr, L.Varekode, L.PrisPrEnhet, L.Antall FROM Ordre O, Ordrelinje L ORDER BY O.OrdreNr";
	$resultat = mysql_query($sql);
	$linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
	
	
	print("<table border='1'>\n");
	print("<tr>Alle Ordre</tr>\n");
	print("<tr>\n");
	print("<th>OrdreNr</th>\n");
	print("<th>OrdreDato</th>\n");
	print("<th>KundeNr</th>\n");
	print("<th>Varekode</th>\n");
	print("<th>Pris</th>\n");
	print("<th>Antall</th>\n");
	print("</tr>\n");

	while ($linje)
  {
	
    $ordredato = $linje["OrdreDato"];
	$ordrenr = $linje["OrdreNr"];
	$kunde = $linje["KNr"];
	$varekode = $linje["Varekode"];
    $pris = $linje["PrisPrEnhet"];
    $antall = $linje["Antall"];

    print("<tr>\n");
	print("<td>" . $ordrenr . "</td>\n");
	print("<td>" . $ordredato . "</td>\n");
	print("<td>" . $kunde . "</td>\n");
    print("<td>" . $varekode . "</td>\n");
    print("<td>" . number_format($pris,2) . "</td>\n");
    print("<td>" . $antall . "</td>\n");
    print("</tr>\n");

    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }
  print("</table>\n");
}
?>