<?php
$hostname = "sql.njit.edu";
$username = "rk633";
$password = "LKVWAEKo";
$conn = NULL;
try
{
   $conn = new PDO("mysql:host=$hostname;dbname=rk633",$username, $password);
   echo "Connection Successful<br>";
   runQuery();
}
catch(PDOException $e)
{
   http_error("500 Internal Server Error\n\n"."There was an SQL error:\n\n" .
   $e->getMessage());
}

function runQuery() {
   global $conn;
     try {
      	    $query = "Select * from accounts where id<6";
	    $q = $conn->prepare($query);
	    $q->execute();
	    $results = $q->fetchAll();
	    $q->closeCursor();
	    //return $results;
	    print_r($results);
	  }
     catch (PDOException $e) {
     	    http_error("500 Internal Server Error\n\n"."There was a SQL
	    error:\n\n" . $e->getMessage());
     }
}

function http_error($message)
{
	header("Content-type: text/plain");
	die($message);
}      
function htmltable()
{
	$data = runQuery();
	echo "<table>";
	foreach ($rows as $row) {
	   echo "<tr>";
	   foreach ($row as $column) {
	      echo "<td>$columns</td>";
	   }
	   echo "</tr>";
	}
	echo "</table>";
?>
