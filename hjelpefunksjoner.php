<?php

function topp()
{
  print("<html>\n");
  print("<head>\n");
  print("<title>The Dark Cookie Shop</title>\n");
  print("<link rel='stylesheet' type='text/css'" . "href='css/style.css'/>\n");
  print("</head>\n");
  print("<body>\n");
}

function bunn()
{
  print("<hr/>\n" .
        "<h6>" .
        "&copy; The Dark Cookie Shop 2012" .
        "</h6>\n");
  print("</body>\n");
  print("</html>\n");
}

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