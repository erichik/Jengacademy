<?php

	$list = $_POST['list'];
	
	$output = array();
	$list = parse_str($list, $output);
	print_r($output);
	$count = count($output['order']);
	
	
	$dbname = $_POST['dbname'];
	
	$id = array();
	$dbc = mysqli_connect('182.50.133.77', 'jenginput', 'eric0517', 'insertdb') OR die('Error: '.mysqli_connect_error());
	
	for($x=0;$x < $count;$x++){
		$q = "SELECT id FROM $dbname WHERE orderid = ".$output['order'][$x];
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_assoc($r);
		$id[$x] = $row['id'];
	}

	for($y=0;$y < $count;$y++)	{
		$inputId = $id[$y];
		$z = $y + 1;
		//$q = "UPDATE $dbname SET orderid = $y WHERE id = ".$id;
		$q = "UPDATE $dbname SET orderid = $z WHERE id = ".$inputId;	
		echo $q."<br>"; 
		$r = mysqli_query($dbc, $q);
		echo mysqli_num_rows($r);
	}
	

?>
