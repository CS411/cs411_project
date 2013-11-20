<!DOCTYPE html>

<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="./cky.js"></script>
<!--<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css" />-->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./cs411.css" />

<body>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</br>
</br>
</br>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="navbar-brand" href="#">Interview Gurus</a>
          <div class="navbar-collapse collapse">
            <button type="submit" class="btn btn-default register" id="register">Register</button>
            <form class="navbar-form pull-right" name="form" method="post" action="login.php">
              <!--  <a id="newuser_href" href="#NewUser">New User</a>-->
	            <input class="span2 form-control" name="username" type="text" placeholder="UserName" id="username">
              <input class="span2 form-control" name="passwd" type="password" placeholder="Password" id="password">
              <input type="submit" name="button" class="btn btn-default" id="login"></button>
            </form>
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
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <div class="container slide_container">
            <div class="carousel-caption">
              <h1>Hello, We are Interview Gurus</h1>
              <p>Home to all your software engineering interview needs</p>
              <p><a class="btn btn-lg btn-primary register" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container slide_container">
            <div class="carousel-caption">
              <h1>Customize interview test for your personal need</h1>
              <p>Select Company and category of question, we can make up a special test for you</p>
              <p><a class="btn btn-lg btn-primary" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="container slide_container">
            <div class="carousel-caption">
              <h1>We believe practice makes perfect</h1>
              <p>Post your question and see other guru's solution</p>
              <p><a class="btn btn-lg btn-primary" id="post_tab_button" role="button">Post your question now!</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

   </div>
   <div id="search_div">
        <div class="form-group">
          <label class="control-label" for="category">Category:</label>
          <div class="controls">
            <select id="search_category" class="form-control col-xs-2">...</select>
            <button id="search_button" class="btn btn-primary" type="button">Search</button><br>
            <div id="search_result_div" class="horizontal">
              <div id="result_list_div" class="horizontal sub-div"></div>
              <div id="result_detail_div" class="horizontal">
                <div class="page-header">
                  <h1>Question</h1>
                </div>
                <div id="detail_question_div" class="main-div"></div>
                  <div class="page-header">
                    <h1>Solutions</h1>
                  </div>
                <div id="detail_solutions_div" class="left-right"></div>
                <div id="post_solution_div" class="main-div">
                  <div class="form-group">
                    <!--<label class="control-label" for="question">Post Solution:</label>-->
                    <div class="controls">
                      <div class="page-header">
                        <h1>Share your solutions</h1>
                      </div>
                      <textarea placeholder="Type your solution here" class="text_area" id="solution_text" maxlength="1024"></textarea>
                      <br>
                      <button id="post_solution_button" class="btn btn-primary" type="button">Post Solution</button><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
   </div><!--end search division-->

   <div class="post-div" id="post_div">
      <form role="form">
        <div class="form-group">
          <label for="category">Category:</label>
          <div class="controls">
            <select id="post_category" class="form-control">...</select>
          </div>
        </div>
    
        <div class="form-group">
         <label for="title">Title:</label>
            <input type="text" class="title form-control"
              placeholder="Type title here"
              id="question_title_text"
              rows="1"
              maxlength="100">
        </div>

        <div class="form-group">
          <label class="control-label" for="question">Question:</label>
            <textarea type="text" class="text_area form-control"
              placeholder="Type question here"
              id="question_text"
              rows="10"
              maxlength="100"></textarea>
            </br>
            <button id="post_question_button" class="btn btn-primary" type="button">Post Question</button><br>
        </div>
    </form>

   </div>
  </div><!--end tab-content-->
 </div><!--end container-->

</body>

</html>

