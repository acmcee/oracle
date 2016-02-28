<?php
	$config=include './../body/config.php';
	$con = mysqli_connect( $config['host'],$config['username'],$config['password'],$config['dbname']);
	
		if (!$con)
		{
			die('Could not connect to database: ' . mysql_error());
		}
		
		if (!mysqli_query($con,'SET NAMES UTF8')){echo "<div class =\"smile\"> <div class=\"bigsmile\">:( </div> DON'T SUPPORT CHINESE! </div>.<br />";exit;} 
?>