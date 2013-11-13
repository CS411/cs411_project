<!DOCTYPE html>

<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="./cky.js"></script>
<link rel="stylesheet" type="text/css" href="./cs411.css" />
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />

<body>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</br>
</br>
</br>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Interview Gurus</a>
          <div class="nav-collapse collapse">
           <form class="navbar-form pull-right" name="form" method="post" action="login.php">
            <!--  <a id="newuser_href" href="#NewUser">New User</a>-->
	          <input class="span2" name="username" type="text" placeholder="UserName" id="username">
            <input class="span2" name="passwd" type="password" placeholder="Password" id="password">
            <input type="submit" name="button" class="btn" id="login"></button>
            </form>
            <button type="submit" class="btn" id="register">Register</button>
        </div>
       </div><!--end container -->
      </div><!--end navbar inner -->
    </div> <!--end navbar -->

 <div class="container">
            <div class="nav nav-tabs" id="myTab">
 		 <li class=active> <a id="home_tab" href="#Home" data-toggle="tab">Home</a></li>
		 <li><a id="search_tab" href="#Search" data-toggle="tab">Search</a></li>
		 <li><a id="post_tab" href="#Post" data-toggle="tab">Post</a></li>
            </div> 

 <div class="tab-content">
  
   <div class="home_div" id="home_div">    
	<span>Welcome to Interview Gurus, home to all your software engineering interview needs</span>
   </div>
   <div id="search_div">

        <div class="control-group">
          <label class="control-label" for="category">Category:</label>
          <div class="controls">
            <select id="search_category">...</select>
            <button id="search_button" type="button">Search</button><br>
            <div id="search_result_div" class="horizontal">
              <div id="result_list_div" class="horizontal sub-div"></div>
              <div id="result_detail_div" class="horizontal">
                <div id="detail_top_div" class="main-div"></div>
                <div id="detail_middle_div" class="left-right"></div>
                <div id="detail_bottom_div" class="main-div"></div>
              </div>
            </div>
          </div>
        </div>
   </div><!--end search division-->

   <div class="post-div" id="post_div">

        <div class="control-group">
          <label class="control-label" for="category">Category:</label>
          <div class="controls">
            <select id="post_category">...</select><br>
          </div>
        </div>
    
        <div class="control-group">
         <label class="control-label" for="title">Title:</label>
          <div class="controls">
            <textarea
              placeholder="Type title here"
              class="title" 
              id="question_title_text" 
              rows="1"
              maxlength="100"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="question">Question:</label>
           <div class="controls">
            <textarea 
              placeholder="Type your question here"
              class="main-question" 
              id="question_text"
              maxlength="1024"></textarea>
            </br>
            <button id="post_button" type="button">Post</button><br>
          </div>
        </div>

   </div>
  </div><!--end tab-content-->
 </div><!--end container-->

</body>

</html>

