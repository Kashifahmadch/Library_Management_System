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

//////////////

$sql = "SELECT * FROM Book_Loans";
$result = $conn->query($sql);
$todays_date = date('Y-m-d');

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) 
	{
	     if ($row["Date_in"] > $row["Due_date"])
		{
		$var1 = $row['Loan_id'];
		//$var2 = date_diff($row["Date_in"],$row["Due_date"]);
		$diff = abs(strtotime($row["Date_in"]) - strtotime($row["Due_date"]));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$var3 = $days * 0.25;
		echo $days;		
		echo $var3;		
		$sql2 = "INSERT INTO Fines (Loan_id,Fine_amt) VALUES ('$var1','$var3')";
		$res = $conn->query($sql2);
		}
	     if (($todays_date > $row["Due_date"]) AND ($row["Date_in"] = '0000-00-00'))
		{
		$var2 = $row['Loan_id'];
		//$var2 = date_diff($row["Date_in"],$row["Due_date"]);
		$diff = abs(strtotime($todays_date) - strtotime($row["Due_date"]));
		$days2 = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		$var4 = $days2 * 0.25;
		echo $days;		
		echo $var3;		
		$sql3 = "INSERT INTO Fines (Loan_id,Fine_amt) VALUES ('$var2','$var4')";
		$res2 = $conn->query($sql3);
		}
		

    	}

}

///////////////
$sql4 = "SELECT * FROM Fines WHERE (Paid = 'False')";
$result__1 = $conn->query($sql4);
	while($row__2 = $result__1->fetch_assoc()) 
	{
	
	}



/////////////////
$conn->close();
?> 

