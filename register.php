<!DOCTYPE html>

<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="./cs411.css" />
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />

<body>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<div class="container">
<div class="well">
  <form id="signup" class="form-horizontal" method="post" action="create.php">
  <legend>Sign Up</legend>
    <div class="control-group ">
      <label class="control-label">User ID</label>
      <div class="controls">
        <div class="input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
          <input type="text" class="input-xlarge" id="user_id" name="user_id" placeholder="ID">
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email</label>
      <div class="controls">
        <div class="input-prepend">
        <span class="add-on"><i class="icon-envelope"></i></span>
          <input type="text" class="input-xlarge" id="email" name="email" placeholder="Email">
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Gender</label>
      <div class="controls">
        <p><div id="gender" name="gender" class="btn-group" data-toggle="buttons-radio">
           <button type="button" class="btn btn-info">Male</button>
           <button type="button" class="btn btn-info">Female</button>
        </div></p>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Password</label>
      <div class="controls">
      <div class="input-prepend">
        <span class="add-on"><i class="icon-lock"></i></span>
          <input type="Password" id="passwd" class="input-xlarge" name="passwd" placeholder="Password">
        </div>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Confirm Password</label>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on"><i class="icon-lock"></i></span>
          <input type="Password" id="conpasswd" class="input-xlarge" name="conpasswd" placeholder="Re-enter Password">
        </div>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"></label>
        <div class="controls">
         <button type="submit" class="btn btn-success" >Create My <span id="IL_AD10" class="IL_AD">Account</span></button>
        </div>
  </div>
  </form>
   </div>
</div>
</body>

</html>

