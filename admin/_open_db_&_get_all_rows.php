<?php include('_db_login.php');  ?>

<?php
// set database server access variables:
include('_db_login.php');

// open connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to connect!");

// select database
mysql_select_db($db) or die ("Unable to select database!");

// create query to get all rows
$query = "select * from " . $dbTable['name'] . " order by " . $dbTable['order_by'];

// execute query
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
?>
