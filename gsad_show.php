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
	<p align="center">"Ledgers" under construction.   <a href="http://gameshows.wikia.com/wiki/Shopper%27s_Bazaar" target="new">Pun in title</a> is deliberate.</p>
	
<?php
//Step2
//Because of "The Joker's Wild"
$get_show = $_GET['show_name'];
//$show = $mysqli->real_escape_string($get_show);
//$prizequery = "SELECT * FROM prizes WHERE `show_name` = REPLACE(\"". $get_show."\", \"'\", \"''\") ORDER BY airdate ASC";


$yearquery = "SELECT DISTINCT SUBSTRING(`airdate`,1,4) FROM sdevelop_youtube.prizes WHERE `show_name` = \"".$get_show."\" ORDER BY SUBSTRING(`airdate`,1,4) ASC";
$yearresult = mysqli_query($db, $yearquery);
$yeararray = [];
?>

<?php
	echo "<h1>".$get_show."</h1>";

	while ($yearrow = mysqli_fetch_array($yearresult))	
														
	{
		array_push($yeararray, $yearrow[0]);
	}
	
	echo "<p align='center'>";

	for ($a = 0; $a < sizeof($yeararray); $a++)
	{
		echo "<a href='#y".$yeararray[$a]."'>".$yeararray[$a]."</a>";
		if ($a < sizeof($yeararray) - 1)
		{
			echo " . ";
		}
	}
	
	echo "</p>";

	
	for ($a = 0; $a < sizeof($yeararray); $a++)
	{
		
		$prizequery = "SELECT * FROM prizes WHERE `show_name` = \"".$get_show."\" AND SUBSTRING(`airdate`,1,4) = '".$yeararray[$a]."' ORDER BY airdate ASC";
		mysqli_query($db, $prizequery) or die('Error querying database.');
		$prizeresult = mysqli_query($db, $prizequery);

		echo "<div id='y".$yeararray[$a]."'></div>";
		echo "<h2>".$yeararray[$a]."</h2>";
		
		echo "<table border='1' align='center'>";

		echo "<tr>
			  <td><b>Show</b></td>
			  <td><b>Airdate</b></td>
			  <td><b>Contestant</b></td>
			  <td><b>Prize</b></td>
			  <td><b>Value</b></td>
			  <td><b>Comments</b></td>
			  <td><b>Source</b></td>
			  </tr>";



		while ($prizerow = mysqli_fetch_array($prizeresult)) 
		{
			$contestantquery = "SELECT * FROM contestants WHERE ID = ".$prizerow['contestant_id']; 
			$contestantresult = mysqli_query($db, $contestantquery);
			$contestantrow = mysqli_fetch_array($contestantresult);

			echo '<tr><td>' . $prizerow['show_name'] . '</td>'
				.'<td>'     . $prizerow['airdate']   . '</td>'
				.'<td><a href="get_contestant.php?player_id='.$prizerow['contestant_id'].'">'     . $contestantrow['firstname'] . ' ' . $contestantrow['lastname'] . '</a></td>'
				.'<td>'     . $prizerow['description'] . '</td>'
			.'<td align="right">$'    . number_format($prizerow['value']) . '</td>'
			.'<td>'.$prizerow['comments'].'</td>'
			.'<td><a href="'.$prizerow['source'].'" target="new">Source</a></td></tr>';
				
		}
		
		echo "</table>";
	}
	
	//Step 4
	mysqli_close($db);
?>


	

</article>


<footer id="myFooter"></footer>
<script src="elements.js"></script>
	

</body>
</html>