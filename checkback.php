<html>
<h1>hey there delilah</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "vidic_10";
$dbname = "libraryproject";

$loan_isbn=$_POST['loan_isbn'];
$card_no=$_POST['loan_card_no'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM Book_Loans WHERE (ISBN = '$loan_isbn') OR (Card_id = '$card_no')";

$res = $conn->query($sql);


echo "<html><body><form name='return_book' action='next.php' method='get'>";

if ($res->num_rows > 0) {
    echo "<table border ='1'><tr><th>ISBN</th><th>loanid</th></tr>";
    // output data of each row
    while($row = $res->fetch_assoc()) 
	{
	$var_1 = $row["ISBN_10"];
	echo "<tr><td>".$row["ISBN"]."</td><td>".$row["Loan_id"]."</td><t/r>";
    	}
    echo "</table>";
} else {
    echo "0 results";
}

?> 
</form>

<form method="post" action="bookback.php">

<?php
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//	echo "<select name='select_option'>";
 //   while($row = $result->fetch_assoc()) 
//	{
//	echo "<option value='$row["Loan_id"]'>" .$row["Loan_id"]."</option>";
 //   	}
//	echo "</select>";
//} else {
 //   echo "0 results";
//}
//$conn->close();
?> 
ENTER Loan id:<input type="text" name="loan_id"><br><br>
<center><input type="submit" name="sub" value="returnbook"/></center><br><br>

</form>

<?php


?>


</html>


