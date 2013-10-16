<?php
$con=mysqli_connect("localhost","root","cs411gogo","CS411Test");
// Check connection
$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$age = $_POST['Age'];
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//echo $firstName;
$sql ="INSERT INTO Persons (FirstName, LastName, Age)
                VALUES ('" . $firstName . "', '" . $lastName . "'," . $age . ")"; 
echo $sql;
mysqli_query($con,$sql);
?>
