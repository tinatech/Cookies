<?php
/**
 * webshopgui.php - GUI class
 *
 * @project	DarkCookie Shop
 * @author	Petter Walbø Johnsgård
 * @ver		0.1
 *
 */
 
class WebshopGui {

//**************************************//
//				HEADER					//
// Send inn hvilket overskrift navn     //
//**************************************//

	function Header($name) {
	
		$content = '<!DOCTYPE html>
					<html>
					<head>
						<title>'.$name.'</title>
						<link rel="stylesheet" type="text/css" href="'.CSSDIR.'style.css" />
						<meta charset="utf-8" />
					</head>
					<body>

					<!-- Start Wrapper -->
					<div id="wrapper">

					<header>
						<div id="webshopname"><h1>'.$name.'</h1></div>
						<div id="userinfo">Logg inn | Regisrer deg som bruker</div>
					</header>';
		
		return $content;
	}

//**************************************//
//				FOOTER					//
//**************************************//

	function Footer() {
	
		$content = '<hr/>
					<h6>&copy; The Dark Cookie Shop 2012</h6>

					<!-- End wrapper -->	
					</div>
					</body>
					</html>';
		
		return $content;
	}


//**************************************//
//				MENY					//
// Send inn admin hvis du ønsker        //
// backend meny, ellers send customer   //
//**************************************//

	function Menu($user) {
		if ($user == "admin") {
			$menu = '<ul> 
					<a href="index.php"><li class="first">Ordre</li> </a>
					<a href="#"><li>Varer</li> </a>
					<a href="#"><li>Brukere</li> </a>
					</ul>';
		}
			
		else {
			$menu = '<ul> 
					<a href="index.php"><li class="first">Forsiden</li> </a>
					<a href="about.php"><li>The Dark Cookie Shop</li> </a>
					<a href="products.php"><li>Varer</li> </a>
					<a href="contact.php"><li>Kontakt oss</li> </a>
					</ul>
					
					<!-- Søk -->
					<div id="search">	
						<form action="search.php" method="POST" id="searchForm" name="sok">
							<fieldset>
								<input type="text" id="search_term" name="keywords" value="" class="clearClick"/>
								<a id="search_go" href="javascript:submitform()">Søk</a>
							</fieldset>
						</form>
					<script type="text/javascript">
						function submitform()
						{
						  document.sok.submit();
						}
					</script>
					</div>'; 
		}
		
		
		$content = '
			<div id="menu"> 
				<!-- Meny -->
				'.$menu.'
			</div> 
			';
		return $content;
		}

}