<?php 
require_once("header.php"); ?>

<div id="content">
	<div id="sidebar"> <!--start sidebar-->	
		<div id="bestsellers"> <!--start bestsellers-->
			<h3>5 på topp</h3>
			<p>hububa</p>
		</div> <!--end bestsellers-->
	</div> <!--end sidebar-->

	<div id="mainbar">

<?php  
$db = new Database;

// Get the search variable from URL
echo $_POST['keywords'];
if(!isset($_POST['keywords'])) {
die("Search Query not found"); 
}
$var = $_POST['keywords'];
$trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=10;

// check for an empty string and display a message.
if ($trimmed == ""){
echo "<p>Please enter a search…</p>";
exit;
}

// check for a search parameter
if (!isset($var)){
echo "<p>We dont seem to have a search parameter!</p>";
exit;
}

// Build SQL Query
$query = "SELECT * FROM item WHERE name like '".$trimmed."' OR price like '".$trimmed."' order by name DESC";


$numresults= $db->dbQuery($query);
$numrows=count($numresults);

// If we have no results, offer a google search as an alternative — this is optional

if ($numrows == 0)
{
echo "<h4>Results</h4>";
echo "<p>Sorry, your search: $trimmed returned zero results</p>";

// google
echo "<p><a href=\"http://www.google.com/search?q="
. $trimmed . "\" target=\"_blank\" title=\"Look up
" . $trimmed . " on Google\">Click here</a> to try the
search on google</p>";
}

// next determine if s has been passed to script, if not use ZERO (0) to Limit the output
if (empty($s)) {
$s=0;
}

// get results
$query .= " limit $s,$limit";
$result = $db->dbQuery($query);

// display what the person searched for
echo "<p>You searched for: $var </p>";

// begin to show results set
echo "Results: <br/>";
$count = 1 + $s ;

// now you can display the results returned
while ($row= $result) {
$name = $row["name"];
$itemID = $row["itemID"];
$price = $row["price"];

echo "$count.> $name $itemID $price<br/>" ;
$count++ ;
}

$currPage = (($s/$limit) + 1);

//break before paging
echo "<br />";

// next we need to do the links to other results
if ($s>=1) {

// bypass PREV link if s is 0
$prevs=($s-$limit);
print " <a href=\"$PHP_SELF?s=$prevs&q=$var\"><<
Prev 10</a>  ";
}

// calculate number of pages needing links
$pages=intval($numrows/$limit);

// $pages now contains int of pages needed unless there is a remainder from division

if ($numrows%$limit) {
// has remainder so add one page
$pages++;
}



$a = $s + ($limit) ;
if ($a > $numrows) { $a = $numrows ; }
$b = $s + 1 ;
echo "<p>Showing results $b to $a of $numrows</p>";

?>

	</div> <!-- End leftbar -->
	

</div> <!-- End content -->

<?php
//echo $gui::bodyContent();
echo $gui::footer(); 
?>
