 <?php
$servername = "localhost";
$username = "root";
$password = "vidic_10";
$dbname = "libraryproject";

$borrow_ssn=$_POST['ssn_temp'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$address=$_POST['address'];


if ((strlen($borrow_ssn) == 0) || (strlen($first_name) == 0) || (strlen($last_name) == 0)|| (strlen($address) == 0))
	{
	echo "Any Input Field cant be empty";
	}
else
{

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $borrow_ssn;
//echo $first_name;
//echo $last_name;
//echo $address;

$sql = "SELECT * FROM Borrower WHERE (Ssn = '$borrow_ssn')";
$result = $conn->query($sql);
//echo $result;
//echo "wassup";
if ($result->num_rows > 0) 
{
echo "SSN already present, the user is already registered";
}
else
{
$sql1 = "SELECT Card_id FROM Borrower ORDER BY Card_id DESC LIMIT 1";
$result1 = $conn->query($sql1);
while($row = $result1->fetch_assoc()) 
	{
	//echo "<tr><td>".$row["Card_id"]."</td></tr>";
	$temp1 = $row["Card_id"];
    	}

//echo $temp1;
$temp2 = ++$temp1;

$sql2 = "INSERT INTO Borrower(Card_id,Ssn,First_Name,Last_Name,Address,Phone) 
VALUES ('$temp2','$borrow_ssn','$first_name','$last_name','address','(214) 891-7743')";

if ($conn->query($sql2) === TRUE) {
	    echo "New User created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
}
$conn->close();

?>
