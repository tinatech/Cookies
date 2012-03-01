<html>
<head>
	<title>The Dark Cookie Shop</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="utf-8" />
</head>
<body>

<!-- Start Wrapper -->
<div id="wrapper">

<header>
	<div id="webshopname"><h1>The Dark Cookie Shop</h1></div>
	<div id="userinfo">Logg inn | Regisrer deg som bruker</div>
</header>

<div id="menu"> 
	
	<!-- Meny -->
	<ul> 
		<a href="index.php"><li class="first">Forsiden</li> </a>
		<a href="about.php" ><li>The Dark Cookie Shop</li> </a>
		<a href="products.php" id="current"><li>Varer</li> </a>
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

	</div>
</div> 
