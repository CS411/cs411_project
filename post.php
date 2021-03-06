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

if ($_POST['method']=='search_question') {
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
  voteSolution($con);
}

if ($_POST['method']=='vote_question') {
  voteQuestion($con);
}

if ($_GET['request']=='words') {
  echo getAllWords($con);
}

function getAllWords($con) {
  $output = "";
  $sql = "SELECT title, description FROM questions";
  $result = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($result)) {
    $output = $output . $row['title'] . " " . $row['description'];
  }
  header('Content-type: application/json');
  return json_encode($output);
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
  echo $sql;
}

function voteQuestion($con) {
  $QID = $_POST['id'];
  $sql = "SELECT vote FROM questions WHERE id = '".$QID."'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $ori_vote = $row['vote'];
  $new_vote = $ori_vote + 1;

  $sql = "UPDATE questions SET vote = '".$new_vote."' WHERE id = '".$QID."'";
  mysqli_query($con,$sql);
  echo $sql;
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
  $sql = "SELECT a.SID FROM answers a,solutions s WHERE a.QID ='".$QID."' and a.SID = s.id order by s.vote desc" ;
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
  $sql = "SELECT s.description, s.vote, s.code, s.language FROM solutions s WHERE s.ID ='".$SID."'" ;
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  /*$ret = array();
  while ($row = mysqli_fetch_array($result)) {
    $tmp = array();
    $tmp['desc'] = $row['description'];
    array_push($ret,$tmp);
  }*/
  $ret = array();
  $ret['desc'] = $row['description'];
  $ret['votes'] = $row['vote'];
  $ret['code'] = $row['code'];
  $ret['language'] = $row['language'];
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
  $keyword = $_POST['keyword'];
  $word = "%" . $keyword . "%";
  if ($category=="All") { 
    $sql = "SELECT ID, title,vote FROM questions WHERE (description LIKE '" . $word ."' OR title LIKE '".$word."') order by vote desc";
  }
  else {
    $sql = "SELECT ID, title,vote FROM questions WHERE category = '" . $category . "' AND (description LIKE '" . $word ."' OR title LIKE '".$word."') order by vote desc";
  }
  $result = mysqli_query($con,$sql);
  $ret = array();
  while($row = mysqli_fetch_array($result)) {
    $tmp = array();
    $tmp['id'] = $row['ID'];
    $tmp['title'] = $row['title'];
    $tmp['votes'] = $row['vote'];
    array_push($ret,$tmp);
  }
  header('Content-type: application/json');
  return json_encode($ret); 
}

function searchID($con) {
  $id = $_GET['id'];
  $sql = "SELECT description,vote FROM questions Where id = '" . $id . "' ";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  $ret = array();
  $ret['desc'] = $row['description'];
  $ret['votes'] = $row['vote'];
  header('Content-type: application/json');
  return json_encode($ret); 
}

function postSolution($con) {
  $desc = $_POST['desc'];
  $QID = $_POST['qid'];
  $code = $_POST['code'];
  $language = $_POST['language'];
  $escape_desc = mysqli_real_escape_string($con,$desc);
  $escape_code = mysqli_real_escape_string($con,$code);

  $sql = "INSERT INTO answers(QID) values('".$QID."')";
  mysqli_query($con,$sql);
  $result = mysqli_query($con,"select @@identity");
  $row = mysqli_fetch_array($result);
  $SID = $row[0];
  $sql = "INSERT INTO solutions(ID,description,code,language) VALUES ('".$SID."','".$escape_desc."','".$escape_code."','".$language."')";
  mysqli_query($con,$sql);
  header('Content-type: application/json');
  return json_encode($SID);

}

function editQuestion($con) {
  $QID = $_POST['id'];
  $desc = $_POST['desc'];
  $escape_desc = mysqli_real_escape_string($con,$desc);
  $sql = "UPDATE questions SET description ='".$escape_desc."' WHERE id= '".$QID."'";
  mysqli_query($con,$sql);
  return $sql;
}

function editSolution($con) {
  $SID = $_POST['id'];
  $desc = $_POST['desc'];
  $escape_desc = mysqli_real_escape_string($con,$desc);
  $sql = "UPDATE solutions SET description ='".$escape_desc."' WHERE id= '".$SID."'";
  mysqli_query($con,$sql);
  return $sql;
}

?>



