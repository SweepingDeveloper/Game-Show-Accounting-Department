<?php
define ('login', TRUE);
include 'mysql_login.php';
?>


<html>
<head>
<title>FREE Javascript Apps and Games - The Sweeping Developer</title>
<link rel='stylesheet' href='style.css' id='styler'>
</head>
<body>

<header id="myHeader"></header>
<nav id="navBar"></nav>

<article>

<h1>Game Show Accounting Department</h1>

<hr>
	<p align="center">"Ledgers" (and database structure) under construction.   <a href="http://gameshows.wikia.com/wiki/Shopper%27s_Bazaar" target="new">Pun in title</a> is deliberate.</p>
	
<?php
//Step2
$prizequery = "SELECT DISTINCT `show_name` FROM prizes ORDER BY `show_name` ASC";
mysqli_query($db, $prizequery) or die('Error querying database.');


$prizeresult = mysqli_query($db, $prizequery);
?>

<table border='1' align="center">

<tr>
	<td><h1><b>Show</b></h1></td>
</tr>

<?php

while ($prizerow = mysqli_fetch_array($prizeresult)) {
	

	echo '<tr><td><h1><a href="gsad_show.php?show_name='.$prizerow['show_name'].'">' . $prizerow['show_name'] . '</a></h1></td></tr>';
	  
	  
}
//Step 4
mysqli_close($db);
?>


</table>	

	

</article>


<footer id="myFooter"></footer>
<script src="elements.js"></script>
	

</body>
</html>