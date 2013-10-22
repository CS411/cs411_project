<?php
$con=mysqli_connect("localhost","root","cs411gogo","CS411Test");
// Check connection
//$firstName = $_POST['FirstName'];
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_GET['request']=='category') {
  echo getCategories($con);
}
function getCategories($con) {
  $sql = "SELECT name FROM categories";
  $result = mysqli_query($con, $sql);
  $ret = array();
  while ($row = mysqli_fetch_array($result)){
    array_push($ret, $row['name']);
  }
  header('Content-type: application/json');
  return json_encode($ret);
}

function postQuestion($con) {
  $category = $_POST['category'];
  $description = $_POST['question_desc'];
  $sql = "INSERT INTO questions (category, description)
                 VALUES ('" . $category . "','" . $description . "')";
  mysqli_query($con,$sql);
}

function deleteQuestion($con) {
  $questionID = $_POST['question_id'];
  $sql = "DELETE FROM question WHERE id = " . $question_id . "";
  mysqli_query($con,$sql);
}


//function updateQuestion($con) {
//  $questionID = $_POST['question_id'];
//  $sql = "UPDATE question SET description ="
//}

?>



