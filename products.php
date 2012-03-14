<?php
include_once("header.php");

?>
<div id="content">
<div id="mainbar">	
<?php 
	//Kobling til databaseklassen.
		$db = new Database;	
		
	//*************** NEW ***************//
function vis_varer($name)
{
	
  $sql = "SELECT * FROM item";
  $resultat = mysql_query($sql);

  $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  print("<table border='1'>\n");

  print("<tr>\n");
  print("<th>Varekode</th>\n");
  print("<th>Navn</th>\n");
  print("<th>Pris</th>\n");
  print("<th>Antall</th>\n");
  print("</tr>\n");

  while ($linje)
  {
    $itemID = $linje["Varekode"];
    $name = $linje["Navn"];
    $price = $linje["PrisPrEnhet"];
    $quantity = $linje["Antall"];

    print("<tr>\n");
    print("<td>" . $itemID . "</td>\n");
    print("<td>" . $name . "</td>\n");
    print("<td>" . number_format($price,2) . " kr</td>\n");
    print("<td>" . $quantity . "</td>\n");
    print("</tr>\n");

    $linje = mysql_fetch_array($resultat, MYSQL_ASSOC);
  }
  print("</table>\n");
}	
?>
<?php

vis_varer($name)

?>


	</div><!-- End mainbar -->	
	
</div><!-- End content -->

<?php
echo $gui::footer();
?>