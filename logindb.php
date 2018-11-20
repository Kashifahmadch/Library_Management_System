 <?php
$servername = "localhost";
$username = "root";
$password = "vidic_10";
$dbname = "libraryproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$temp1 = NULL;
$temp2 = NULL;
$temp3 = NULL;
$myusername=$_POST['usr'];
$str = (explode(" ",$myusername));
$mypassword=$_POST['pwd'];
$temp1 = $str[0];
$temp2 = $str[1];
$temp3 = $str[2];
//echo $temp1;
//echo $temp2;
//echo $temp3;
if (strlen($temp1) == 0)
	{
	$temp1 = "023940293482039482304982342";
	}
if (strlen($temp2) == 0)
	{
	$temp2 = "239482034982304982340923840923842";
	}
if (strlen($temp3) == 0)
	{
	$temp3 = "2349823094238502935203958235098235203598";
	}

$sql = "SELECT * FROM Books WHERE (ISBN_10 LIKE '%$temp1%') OR (ISBN_10 LIKE '%$temp2%') OR (ISBN_10 LIKE '%$temp3%') OR 
(TITLE LIKE '%$temp1%') OR (TITLE LIKE '%$temp2%') OR (TITLE LIKE '%$temp3%') OR
(AUTHORS LIKE '%$temp1%') OR (AUTHORS LIKE '%$temp2%') OR (AUTHORS LIKE '%$temp3%')";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table border ='1'><tr><th>ISBN</th><th>TITLE</th><th>AUTHORS</th><th>LOAN STATUS</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
	     
	$var_1 = $row["ISBN_10"];
	//echo $var_1;
	$sql2 = "SELECT * FROM Book_Loans WHERE (ISBN='$var_1')";
	$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0)
		{
		$temp_loan = "loaned out";
		//echo "loaned out!";
		}
		else
		{
		//echo "not loaned out!";
		$temp_loan = "not loaned out";
		}
	echo "<tr><td>".$row["ISBN_10"]."</td><td>".$row["TITLE"]."</td><td>".$row["AUTHORS"]."</td><td>".$temp_loan."</td></tr>";
    	}
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?> 


