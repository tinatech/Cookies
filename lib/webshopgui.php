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
						<div id="userinfo">Logg inn | Registrer deg som kunde</div>
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
					<a href="products.php"><li>Varer</li> </a>
					<a href="users.php"><li>Brukere</li> </a>
					<a href="customers.php"><li>Kunder</li> </a>
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
		
//**************************************//
//				UNDERMENY				//
// Send inn hvilken meny du ønsker      //
// orders, products eller users         //
//**************************************//
	function SecondMenu($menu) {
		if($menu == "orders"){
			$menu = '<a href="#"><li class="first">Ubehandlet (0)</li> </a>
					 <a href="#"><li>Under behandling (0)</li> </a>
					 <a href="#"><li>Ferdigbehandlet</li> </a>';
		}
		
		elseif($menu == "products"){
			$menu = '<a href="#"><li class="first">Varer</li> </a>
					 <a href="#"><li>Legg til vare</li> </a>
					 <a href="#"><li>Legg til kategori</li> </a>
					 <a href="#"><li>Kampanje</li> </a>';
		}
		
		elseif($menu == "users"){
			$menu = '<a href="#"><li class="first">Brukere</li> </a>
					 <a href="#"><li>Legg til bruker</li> </a>';
		}
		
		elseif($menu == "customers"){
			$menu = '<a href="#"><li class="first">Kunder</li> </a>
					 <a href="#"><li>Legg til kunde</li> </a>';
		}
		
		else { $menu = '<li>Error: Finner ikke menyen "'.$menu.'".'; }
		
		$content = '<div id="secondmenu">
					<ul> 
					' . $menu . '
					</ul>
					</div>';
		
		return $content;
		}

}