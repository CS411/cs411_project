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

if ($_POST['method']=='post_question') {
  postQuestion($con);
}

if ($_POST['method']=='delete_question') {
  deleteQuestion($con);
}

if ($_POST['method']=='search_category') {
  echo searchCategory($con);
}

if ($_POST['method'] == 'get_question_desc') {
  echo searchID($con);
}

function getCategories($con) {
  $sql = "SELECT name FROM categories";
  $result = mysqli_query($con, $sql);
  $ret = array();
  while ($row = mysqli_fetch_array($result)) {
    array_push($ret, $row['name']);
  }
  header('Content-type: application/json');
  return json_encode($ret);
}

function postQuestion($con) {
  $category = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['question_desc'];
  $sql = "INSERT INTO questions (category,title, description)
                 VALUES ('" . $category . "','" . $title . "','" . $description . "')";
  mysqli_query($con,$sql);
  echo $sql;
}

function deleteQuestion($con) {
  $questionID = $_POST['question_id'];
  $sql = "DELETE FROM questions WHERE id = " . $questionID ."";
  mysqli_query($con,$sql);
  echo $sql;
}

function searchCategory($con) {
  $category = $_POST['category'];
  $sql = "SELECT ID, title FROM questions WHERE category = '" . $category . "'";
  $result = mysqli_query($con,$sql);
  $ret = array();
  while($row = mysqli_fetch_array($result)) {
    $tmp = array();
    $tmp['ID'] = $row['ID'];
    $tmp['title'] = $row['title'];
    array_push($ret,$tmp);
  }
  header('Content-type: application/json');
  return json_encode($ret); 
}

function searchID($con) {
  $id = $_POST['id'];
  $sql = "SELECT description FROM questions Where id = '" . $id . "' ";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $ret = array();
  $ret['description'] = $row['description'];
  header('Content-type: application/json');
  return json_encode($ret); 
}
//function updateQuestion($con) {
//  $questionID = $_POST['question_id'];
//  $description = $_POST['']
//  $sql = "UPDATE question SET description ="
//}

?>



