<?php
require_once("./conf/config.php");


function h1($overskrift)
{
  print("<h1> $overskrift </h1>\n");
}

function h3($overskrift)
{
  print("<h3> $overskrift </h3>\n");
}

function hyperlenke($tekst, $url)
{
  print("<a href='$url'>$tekst<a>");
}


/* Gjør om fra datoformatet dd.mm.yyy
 * til yyy-dd-mm.
 */
function dato_norsk_til_engelsk($norsk)
{
  $tab = explode(".",$norsk);
  $eng = $tab[2] . "-" . $tab[1] . "-" . $tab[0];
  return $eng;
}

?>
