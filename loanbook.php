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


$sql2 = "SELECT * FROM Book_Loans WHERE (ISBN = '$loan_isbn')";
$result = $conn->query($sql2);
$sql3 = "SELECT * FROM Book_Loans WHERE (Card_id = '$card_no')";
$result2 = $conn->query($sql3);

$todays_date = date('Y-m-d');
$due_date = date('Y-m-d', strtotime($date. ' + 14 days'));
$sql = "INSERT INTO Book_Loans (ISBN,Card_id,Date_out,Due_date,Date_in) VALUES ('$loan_isbn','$card_no','$todays_date','$due_date','0000-00-00')";
if ($result2->num_rows < 3)
{
if ($result->num_rows > 0)
{
echo "BOOK is already loaned out";
}
else
{

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
}
else
{
echo "This Loaner already has 3 books loaned";
}

$conn->close();
?> 
