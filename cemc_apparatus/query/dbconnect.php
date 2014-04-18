<?PHP

	$database = "station_reads";
	
	global $connection;

    $connection = mysql_connect('localhost','root','manatee1');
	@mysql_select_db($database) or die("Database Error".mysql_error());

?>
