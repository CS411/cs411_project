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

if ($_GET['request'] == 'question') {
  echo searchID($con);
}

if($_GET['request']=='solutions') {
  echo getSolutions($con);
}

if($_GET['request']=='solution') {
  echo getSolution($con);
}

if ($_POST['method']=='post_question') {
  echo postQuestion($con);
}

if ($_POST['method']=='delete_question') {
  deleteQuestion($con);
}

if ($_POST['method']=='delete_solution') {
  deleteSolution($con);
}

if ($_POST['method']=='search_category') {
  echo searchCategory($con);
}

if ($_POST['method']=='post_solution') {
  echo postSolution($con);
}

if ($_POST['method']=='edit_question') {
  echo editQuestion($con);
}

if ($_POST['method']=='edit_solution') {
  echo editSolution($con);
}

if ($_POST['method']=='vote_solution') {
  echo voteSolution($con);
}


function voteSolution($con) {
  $SID = $_POST['id'];
  $sql = "SELECT vote FROM solutions WHERE id = '".$SID."'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $ori_vote = $row['vote'];
  $new_vote = $ori_vote + 1;
  
  $sql = "UPDATE solutions SET vote = '".$new_vote."' WHERE id = '".$SID."'";
  mysqli_query($con,$sql);
  return $sql;
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

function getSolutions($con) {
  $QID = $_GET['id'];
  $sql = "SELECT a.SID FROM answers a WHERE a.QID ='".$QID."'" ;
  $result = mysqli_query($con,$sql);
  $ret = array();
  while ($row = mysqli_fetch_array($result)) {
    $tmp = array();
    $tmp['id'] = $row['SID'];
    array_push($ret,$tmp);
  }
  header('Content-type: application/json');
  return json_encode($ret);
}

function getSolution($con) {
  $SID = $_GET['id'];
  $sql = "SELECT s.description FROM solutions s WHERE s.ID ='".$SID."'" ;
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  /*$ret = array();
  while ($row = mysqli_fetch_array($result)) {
    $tmp = array();
    $tmp['desc'] = $row['description'];
    array_push($ret,$tmp);
  }*/
  $ret = $row['description'];
  header('Content-type: application/json');
  return json_encode($ret);
}

function postQuestion($con) {
  $category = $_POST['category'];
  $title = $_POST['title'];
  $description = $_POST['desc'];

//  $uid = $_POST['user_id'];
  $uid = "caro";
  $escape_title = mysqli_real_escape_string($con,$title);
  $escape_description = mysqli_real_escape_string($con,$description);

  $sql = "INSERT INTO questions (category,title, description)
    VALUES ('" . $category . "','" . $escape_title . "','" . $escape_description . "')";

  mysqli_query($con,$sql);

  $result = mysqli_query($con,"select @@identity");
  $row = mysqli_fetch_array($result);
  $qid = $row[0];
  $sql = "INSERT INTO asks(username,qid) VALUES ('".$uid."','".$qid."')";
  mysqli_query($con,$sql);
  return $sql;

}

function deleteQuestion($con) {
  $questionID = $_POST['id'];
  $sql = "DELETE FROM questions WHERE id = " . $questionID ."";
  mysqli_query($con,$sql);
  echo $sql;
}

function deleteSolution($con) {
  $solutionID = $_POST['id'];
  $sql = "DELETE FROM solutions WHERE id = " . $solutionID ."";
  mysqli_query($con,$sql);
  $sql = "DELETE FROM answers WHERE SID = " . $solutionID ."";
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
    $tmp['id'] = $row['ID'];
    $tmp['title'] = $row['title'];
    array_push($ret,$tmp);
  }
  header('Content-type: application/json');
  return json_encode($ret); 
}

function searchID($con) {
  $id = $_GET['id'];
  $sql = "SELECT description FROM questions Where id = '" . $id . "' ";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $ret = $row['description'];
  header('Content-type: application/json');
  return json_encode($ret); 
}

function postSolution($con) {
  $desc = $_POST['desc'];
  $QID = $_POST['qid'];
  $escape_desc = mysqli_real_escape_string($con,$desc);

  $sql = "INSERT INTO answers(QID) values('".$QID."')";
  mysqli_query($con,$sql);
  $result = mysqli_query($con,"select @@identity");
  $row = mysqli_fetch_array($result);
  $SID = $row[0];
  $sql = "INSERT INTO solutions(ID,description) VALUES ('".$SID."','".$escape_desc."')";
  mysqli_query($con,$sql);
  header('Content-type: application/json');
  return json_encode($SID);

}

function editQuestion($con) {
  $QID = $_POST['id'];
  $desc = $_POST['desc'];
  $sql = "UPDATE questions SET description ='".$desc."' WHERE id= '".$QID."'";
  mysqli_query($con,$sql);
  return $sql;
}

function editSolution($con) {
  $SID = $_POST['id'];
  $desc = $_POST['desc'];
  $sql = "UPDATE solutions SET description ='".$desc."' WHERE id= '".$SID."'";
  mysqli_query($con,$sql);
  return $sql;
}

?>



