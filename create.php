<?php session_start(); ?>
<?php
$con=mysqli_connect("localhost","root","cs411gogo","CS411Test");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

  $username = $_POST['user_id'];
  $email = $_POST['email'];
//  $gender = $_POST['gender'];

  $pw = $_POST['passwd'];
  $pw2 = $_POST['conpasswd'];

  $sql = "SELECT * FROM users WHERE username = '".$username."'";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_array($result);
  if ($row == null)
  {
    if ($username != null && $pw != null && $pw2 != null && $pw == $pw2)
    {
      $md5_password = md5($pw);
      $sql = "INSERT INTO users(username,password) VALUES ('" .$username. "', '" .$md5_password. "')";
      mysqli_query($con,$sql);
      $sql = "INSERT INTO user_profile(username,email) VALUES ('".$username."','".$email."')";
      mysqli_query($con,$sql);
      echo "success";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
    }else{
      echo "Missing data or password not match";
      echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';
    }
  }
  else
  {
    echo "failed";
    echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
  }


?>



