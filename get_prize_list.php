<?php
include 'mysql_login.php';
?>


<html>
 <head>
 </head>
 <body>
 <h1>Game Show Accounting Department</h1>
 
 <?php
	echo '"Ledgers" under construction.  <a href="http://gameshows.wikia.com/wiki/Shopper%27s_Bazaar" target="new">Pun in title</a> is deliberate.<br>';
 ?>
 
<?php
//Step2
$prizequery = "SELECT * FROM prizes ORDER BY airdate ASC";
mysqli_query($db, $prizequery) or die('Error querying database.');


$prizeresult = mysqli_query($db, $prizequery);
?>

<table border='1' align="center" width="100%">

<tr>
	<td><b>Show</b></td>
	<td><b>Airdate</b></td>
	<td><b>Contestant</b></td>
	<td><b>Prize</b></td>
	<td><b>Value</b></td>
</tr>

<?php

while ($prizerow = mysqli_fetch_array($prizeresult)) {
	$contestantquery = "SELECT * FROM contestants WHERE ID = ".$prizerow['contestant_id']; 
	$contestantresult = mysqli_query($db, $contestantquery);
	$contestantrow = mysqli_fetch_array($contestantresult);

	echo '<tr><td>' . $prizerow['show_name'] . '</td>'
     	.'<td>'     . $prizerow['airdate']   . '</td>'
		.'<td><a href="get_contestant.php?player_id='.$prizerow['contestant_id'].'">'     . $contestantrow['firstname'] . ' ' . $contestantrow['lastname'] . '</a></td>'
		.'<td>'     . $prizerow['description'] . '</td>'
.'<td align="right">$'    . number_format($prizerow['value']) . '</td></tr>';
	  
	  
}
//Step 4
mysqli_close($db);
?>


</table>

</body>
</html>
