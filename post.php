<?php
$con=mysqli_connect("localhost","root","cs411gogo","CS411Test");
// Check connection
//$firstName = $_POST['FirstName'];
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($_GET['request']=='categories'){
  echo getCategories($con);
}
function getCategories($con)
{
  $sql = "SELECT name FROM categories";
  $result = mysqli_query($con, $sql);
  $ret = array();
  while($row = mysqli_fetch_array($result)){
    array_push($ret, $row['name']);
  }
  header('Content-type: application/json');
  return json_encode($ret);
}

//$category = $_POST[''];
//$description = $_POST[''];

//$sql ="INSERT INTO questions (category,description) 
//                values ('" . $category . "','" . $description . "')"
//mysqli_query($con,$sql);

?>



