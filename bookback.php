<html>
<h1>Thank You for returning your book</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "vidic_10";
$dbname = "libraryproject";

$loan_id=$_POST['loan_id'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$todays_date = date('Y-m-d');
$sql = "UPDATE Book_Loans
SET Date_in = '$todays_date'
WHERE Loan_id = '$loan_id' ";

$res = $conn->query($sql);

$conn->close();
?> 

