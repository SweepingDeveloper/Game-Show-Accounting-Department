<?php
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
 
 <?php
	$contestant_query = "SELECT * FROM contestants WHERE id = ".$_GET["player_id"];
	$contestant_result = mysqli_query($db, $contestant_query) or die ('Error querying contestant data.');
	$contestant_row = mysqli_fetch_array($contestant_result);
 ?>
 <?php
	echo '<p align="center"><h1>'.$contestant_row['firstname'].' '.$contestant_row['lastname'].'</h1>';
	echo '<br>A/An '.$contestant_row['occupation'].' from '.$contestant_row['city'].', '.$contestant_row['state'];
	echo '<br>Total winnings: $'.number_format($contestant_row['totalwinnings']).'</p>';
	
	echo '<h2>Game List:</h2>';
	
	
	$unique_dates = "SELECT DISTINCT airdate, show_name FROM prizes WHERE contestant_id = ".$_GET["player_id"]." ORDER BY airdate ASC";
	$date_result = mysqli_query($db, $unique_dates) or die ('Error querying airdates.');
	
	
	//Ask about ordering the airdates.
	while ($date_row = mysqli_fetch_array($date_result))
	{
		echo '<h3>'.$date_row['show_name'].', '.$date_row['airdate'].'</h3>';
		echo '<table border="1"><tr><td><b>Prize</b></td><td><b>Value</b></td><td><b>Comments</b></td><td><b>Source</b></td></tr>';

		$fixed_airdate = str_replace("-","/",$date_row['airdate']);
		$prize_query = "SELECT description,value,comments,source FROM prizes WHERE contestant_id = ".$_GET["player_id"]." AND airdate = \"".$date_row['airdate']."\"";
		$prize_result = mysqli_query($db, $prize_query) or die ('Error querying prizes.');
		
		
		while ($prize_row = mysqli_fetch_array($prize_result))
		{
			echo '<tr><td>'.$prize_row['description'].'</td><td align="right">$'.number_format($prize_row['value']).'</td><td>'.$prize_row['comments'].'</td><td><a href="'.$prize_row['source'].'" target="new">Source</a></td></tr>';
		}
		
		echo '</table>';
			
	}
	
 ?>
 <p><a href="accounting_dept.php">Back</a></p>
 
 </article>


<footer id="myFooter"></footer>
<script src="elements.js"></script>
 </body>
</html>