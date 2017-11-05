<?php
$hostname = "sql.njit.edu";
$username = "rk633";
$password = "LKVWAEKo";
$conn = NULL;
try
{
   $conn = new PDO("mysql:host=$hostname;dbname=rk633",$username, $password);
   echo "Connection Successful<br>";
   $query = "Select * from accounts where id<6";
   $res_query = runQuery($query);
   $no_of_rows = count($res_query);
   echo $no_of_rows . ' no of records have id less than 6';
   $str = "SHOW COLUMNS FROM accounts"; 
   $heading = runHeading($str);
   echo htmltable($heading, $res_query);
}
catch(PDOException $e)
{
   http_error("500 Internal Server Error\n\n"."There was an SQL error:\n\n" .
   $e->getMessage());
}

function runQuery($query) {
   global $conn;
     try {
	    $q = $conn->prepare($query);
	    $q->execute();
	    $results = $q->fetchAll(PDO::FETCH_ASSOC);
	    $q->closeCursor();
	    return $results;
	  }
     catch (PDOException $e) {
     	    http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
     }
}

function runHeading($query)  {
  global $conn;
    try {
            $q = $conn->prepare($query);
	    $q->execute();
	    $results = $q->fetchAll(PDO::FETCH_COLUMN);
	    $q->closeCursor();
	    return $results;
	}
     catch (PDOException $e) {
           http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
     }
}
     
function htmltable($heading,$res_query)
{	
	$table = NULL;
	$table .= "<table border = 1>";
	foreach ($heading as $head)  {
	   $table .= "<th>" . $head . "</th>";
	}
	foreach ($res_query as $row) {
	   $table .= "<tr>";
	   foreach ($row as $column) {
	      $table .= "<td>" . $column ."</td>";
	   }
	   $table .="</tr>";
	}
	$table .="</table>";
	return $table;
}
?>
