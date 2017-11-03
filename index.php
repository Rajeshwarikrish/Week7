<?php>
$hostname = "sql.njit.edu";
$username = "rk633";
$password = "rajeshwari22"
$conn = NULL;
try
{
   $conn = new PDO("mysql:host=$hostname;dbname=rk633",$username, $password);
   echo "Connection Successful<br>";
}
catch(PDOException $e)
{
   http_error("500 Internal Server Error\n\n"."There was an SQL error:\n\n" .
   $e->getMessage());
}
/*function runQuery($query) {
   gobal $conn;
     try {
      	    $q = Select* from accounts where id<6;
	    $q = $conn->prepare($query);
	    $q->execute();
	    $results = $q->fetchAll();
	    $q->closeCursor();
	    return $results;
	  }
     catch (PDOException $e) {
  */      


?>
