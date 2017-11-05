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
   echo htmltable($res_query);
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
     	    http_error("500 Internal Server Error\n\n"."There was a SQL
	    error:\n\n" . $e->getMessage());
     }
}

function http_error($message)
{
	header("Content-type: text/plain");
	die($message);
}      
function htmltable($res_query)
{	//print_r($res_query);
	//echo "<br>";
	$table = NULL;
	$table .= "<table border = 1>";
	/*$field_num = mysql_num_fields($query);
	echo "<thead>";
	for ($i=0; $i<$field_num; $i++)
	{
	$field = mysqli_fetch_field($query);
	echo "<th>{$field->name}</th>";
	}*/
	echo '<table class="data-table"><tr class = "data-heading">';
	while($property = mysqli_fetch_field($query)){
	echo '<td>' . $property->name . '</td>';
	array_push($all_property, $property->name);
	}
	echo '</tr>';
	foreach ($res_query as $row) {
	   $table .= "<tr>";
	   foreach ($row as $column) {
	      $table .= "<td>$column</td>";
	   }
	   $table .="</tr>";
	}
	$table .="</table>";
	return $table;
}
?>
