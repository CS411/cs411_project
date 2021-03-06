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

<script src="ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
</br>
</br>
</br>

  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="navbar-brand" href="#">Interview Gurus</a>
        <div class="navbar-collapse collapse">
          <!--<form class="navbar-form pull-right" name="form" method="post" action="login.php">
              <a id="newuser_href" href="#NewUser">New User</a>
	          <input class="span2 form-control" name="username" type="text" placeholder="UserName" id="username">
            <input class="span2 form-control" name="passwd" type="password" placeholder="Password" id="password">
            <button type="submit" name="button" class="btn btn-default" id="login">Sign in</button>
            <button type="submit" class="btn btn-default register" id="register">Register</button> 
	        </form>-->
        </div>
       </div><!--end container -->
      </div><!--end navbar inner -->
    </div> <!--end navbar -->

 <div class="container">
            <div class="nav nav-tabs" id="myTab">
 		 <li class=active> <a id="home_tab" href="#Home" data-toggle="tab">Home</a></li>
		 <li><a id="search_tab" href="#Search" data-toggle="tab">Search</a></li>
		 <li><a id="post_tab" href="#Post" data-toggle="tab">Post</a></li>
		 <li><a id="keyword_tab" href="#Keyword" data-toggle="tab">Word Cloud</a></li>
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
                    <h1>Hello, welcome to Interview Gurus!</h1>
                    <h3>Start practicing questions for your software engineering interviews</h3>
	            <p><a class="btn btn-lg btn-primary" id="learn_more" role="button">Learn more</a></p>        	
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="container slide_container">
                  <div class="carousel-caption">
                    <h1>Search for a question</h1>
                    <h3>Pick a specific category or enter a keyword</h3>
		    <p><a class="btn btn-lg btn-primary" id="search_tab_button" role="button">Search now</a></p>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="container slide_container">
                  <div class="carousel-caption">
                    <h1>Practice for your interviews now!</h1>
	                  <h3>Do not wait until the last minute</h3>
                    <p><a class="btn btn-lg btn-primary" id="post_tab_button" role="button">Post your question!</a></p>
                  </div>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
          </div><!-- /.carousel -->
        </div>

        <div id="search_div" class="search-div">
          <br>
          <div class="form-group float_left">
            <label class="control-label" for="keyword">Keyword:</label>
            <div class="controls">
	            <div class="s_inline">
                <input id="keyword" type="text" class="keyword form-control">
              </div>
            </div>
          </div>
          <div class="form-group float_left">
            <label class="control-label" for="category">Category:</label>
            <div class="controls">
	            <div class="s_inline">
                <select id="search_category" class="form-control col-xs-2">...</select>
                <button id="search_button" class="btn btn-primary" type="button">Search</button>
              </div> 
	            <div id="search_result_div" class="s_results">
                <div id="result_list_div" class="s_results q_titles">
                </div>
                <div id="result_detail_div" class="s_QandA">
                  <div class="page-header">
                    <h1>Question</h1>
                  </div>
                  <div id="detail_question_div" class="q_question">
                  </div>
                  <div class="page-header">
                    <h1>Solution</h1>
                  </div>
                  <div id="detail_solutions_div" class="solutions">
                  </div>
                  <div id="post_solution_div" class="q_question">
                    <div class="form-group">
                    <!--<label class="control-label" for="question">Post Solution:</label>-->
                      <div class="controls">
                        <div class="page-header">
                          <h1>Share your solution</h1>
                        </div>
                        <textarea placeholder="Type your solution here" class="text_area form-control" row="10" id="solution_text" maxlength="1024"></textarea>
                        <br>
                        <div id="code-editor">
                          <span>Select the language you use</span>
                          <select class="form-control" id="code-language">
                            <option>c_cpp</option>
                            <option>java</option>
                            <option>php</option>
                            <option>python</option>
                            <option>ruby</option>
                            <option>perl</option>
                            <option>matlab</option>
                            <option>verilog</option>
                          </select>
                          <pre id="editor" class="editor">
                            function foo(){
                              var i = 5;
                            }
                          </pre>
                        </div>
                        <button id="show_or_hide_code_area_button" class="btn btn-success" type="button">Open Code Editor</button>
                        <button id="post_solution_button" class="btn btn-primary" type="button">Post Solution</button><br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
   </div><!--end search division-->
   <div class="keyword-div" id="keyword_div">
<!--
begin tag cloud : generated by TagCrowd.com
Feel free to modify as long as you keep this notice.

EMBEDDING INSTRUCTIONS:
1. Customize your cloud's style by editing the CSS where it says CUSTOMIZE below.
2. Insert this code in its entirety into your webpage or blog post.

This code and its rendered image are released under the Creative Commons Attribution-Noncommercial 3.0 Unported License. (http://creativecommons.org/licenses/by-nc/3.0/)

For COMMERCIAL USE LICENSING, visit http://tagcrowd.com/licensing.html
-->
<style type="text/css"><!-- #htmltagcloud{

/******************************************
 *  * CUSTOMIZE CLOUD CSS BELOW (optional)
 *   */
  font-size: 100%;
  width: auto;    /* auto or fixed width, e.g. 500px   */
  font-family:'lucida grande','trebuchet ms',arial,helvetica,sans-serif;
  background-color:#fff;
  margin:1em 1em 0 1em;
  border:2px dotted #ddd;
  padding:2em; 
/******************************************
 *  * END CUSTOMIZE
 *   */

}#htmltagcloud{line-height:2.4em;word-spacing:normal;letter-spacing:normal;text-transform:none;text-align:justify;text-indent:0}#htmltagcloud a:link{text-decoration:none}#htmltagcloud a:visited{text-decoration:none}#htmltagcloud a:hover{color:white;background-color:#05f}#htmltagcloud a:active{color:white;background-color:#03d}.wrd{padding:0;position:relative}.wrd a{text-decoration:none}.tagcloud0{font-size:1.0em;color:#ACC1F3;z-index:10}.tagcloud0 a{color:#ACC1F3}.tagcloud1{font-size:1.4em;color:#ACC1F3;z-index:9}.tagcloud1 a{color:#ACC1F3}.tagcloud2{font-size:1.8em;color:#86A0DC;z-index:8}.tagcloud2 a{color:#86A0DC}.tagcloud3{font-size:2.2em;color:#86A0DC;z-index:7}.tagcloud3 a{color:#86A0DC}.tagcloud4{font-size:2.6em;color:#607EC5;z-index:6}.tagcloud4 a{color:#607EC5}.tagcloud5{font-size:3.0em;color:#607EC5;z-index:5}.tagcloud5 a{color:#607EC5}.tagcloud6{font-size:3.3em;color:#4C6DB9;z-index:4}.tagcloud6 a{color:#4C6DB9}.tagcloud7{font-size:3.6em;color:#395CAE;z-index:3}.tagcloud7 a{color:#395CAE}.tagcloud8{font-size:3.9em;color:#264CA2;z-index:2}.tagcloud8 a{color:#264CA2}.tagcloud9{font-size:4.2em;color:#133B97;z-index:1}.tagcloud9 a{color:#133B97}.tagcloud10{font-size:4.5em;color:#002A8B;z-index:0}.tagcloud10 a{color:#002A8B}.freq{font-size:10pt !important;color:#bbb}#credit{text-align:center;color:#333;margin-bottom:0.6em;font:0.7em 'lucida grande',trebuchet,'trebuchet ms',verdana,arial,helvetica,sans-serif}#credit a:link{color:#777;text-decoration:none}#credit a:visited{color:#777;text-decoration:none}#credit a:hover{color:white;background-color:#05f}#credit a:active{text-decoration:underline}// -->
</style>

<div id="htmltagcloud"> <span id="0" class="wrd tagcloud2"><a href="#">anagram</a></span> <span id="1" class="wrd tagcloud0"><a href="#">applications</a></span> <span id="2" class="wrd tagcloud0"><a href="#">arabic</a></span> <span id="3" class="wrd tagcloud8"><a href="#">array</a></span> <span id="4" class="wrd tagcloud4"><a href="#">binary</a></span> <span id="5" class="wrd tagcloud1"><a href="#">bst</a></span> <span id="6" class="wrd tagcloud0"><a href="#">capitalize</a></span> <span id="7" class="wrd tagcloud0"><a href="#">coloring</a></span> <span id="8" class="wrd tagcloud0"><a href="#">combinations</a></span> <span id="9" class="wrd tagcloud2"><a href="#">common</a></span> <span id="10" class="wrd tagcloud1"><a href="#">consecutive</a></span> <span id="11" class="wrd tagcloud0"><a href="#">constructor</a></span> <span id="12" class="wrd tagcloud0"><a href="#">convert</a></span> <span id="13" class="wrd tagcloud0"><a href="#">coverage</a></span> <span id="14" class="wrd tagcloud0"><a href="#">data</a></span> <span id="15" class="wrd tagcloud2"><a href="#">determine</a></span> <span id="16" class="wrd tagcloud5"><a href="#">difference</a></span> <span id="17" class="wrd tagcloud0"><a href="#">distance</a></span> <span id="18" class="wrd tagcloud1"><a href="#">duplicates</a></span> <span id="19" class="wrd tagcloud0"><a href="#">edit</a></span> <span id="20" class="wrd tagcloud3"><a href="#">elements</a></span> <span id="21" class="wrd tagcloud2"><a href="#">encoded</a></span> <span id="22" class="wrd tagcloud0"><a href="#">equal</a></span> <span id="23" class="wrd tagcloud2"><a href="#">example</a></span> <span id="24" class="wrd tagcloud0"><a href="#">foo</a></span> <span id="25" class="wrd tagcloud0"><a href="#">front</a></span> <span id="26" class="wrd tagcloud3"><a href="#">function</a></span> <span id="27" class="wrd tagcloud0"><a href="#">general</a></span> <span id="28" class="wrd tagcloud10"><a href="#">given</a></span> <span id="29" class="wrd tagcloud5"><a href="#">graph</a></span> <span id="30" class="wrd tagcloud0"><a href="#">hash</a></span> <span id="31" class="wrd tagcloud1"><a href="#">inorder</a></span> <span id="32" class="wrd tagcloud1"><a href="#">input</a></span> <span id="33" class="wrd tagcloud6"><a href="#">integers</a></span> <span id="34" class="wrd tagcloud1"><a href="#">interval</a></span> <span id="35" class="wrd tagcloud1"><a href="#">isomorphic</a></span> <span id="36" class="wrd tagcloud0"><a href="#">j-i</a></span> <span id="37" class="wrd tagcloud0"><a href="#">k-element</a></span> <span id="38" class="wrd tagcloud2"><a href="#">largest</a></span> <span id="39" class="wrd tagcloud4"><a href="#">length</a></span> <span id="40" class="wrd tagcloud4"><a href="#">letter</a></span> <span id="41" class="wrd tagcloud0"><a href="#">level</a></span> <span id="42" class="wrd tagcloud0"><a href="#">list</a></span> <span id="43" class="wrd tagcloud2"><a href="#">longest</a></span> <span id="44" class="wrd tagcloud0"><a href="#">lowest</a></span> <span id="45" class="wrd tagcloud3"><a href="#">map</a></span> <span id="46" class="wrd tagcloud1"><a href="#">matrix</a></span> <span id="47" class="wrd tagcloud4"><a href="#">maximum</a></span> <span id="48" class="wrd tagcloud0"><a href="#">merge</a></span> <span id="49" class="wrd tagcloud0"><a href="#">minimum-sized</a></span> <span id="50" class="wrd tagcloud0"><a href="#">moving</a></span> <span id="51" class="wrd tagcloud3"><a href="#">nodes</a></span> <span id="52" class="wrd tagcloud0"><a href="#">non-zero</a></span> <span id="53" class="wrd tagcloud0"><a href="#">null</a></span> <span id="54" class="wrd tagcloud6"><a href="#">number</a></span> <span id="55" class="wrd tagcloud0"><a href="#">order</a></span> <span id="56" class="wrd tagcloud1"><a href="#">output</a></span> <span id="57" class="wrd tagcloud0"><a href="#">pairs</a></span> <span id="58" class="wrd tagcloud2"><a href="#">palindrome</a></span> <span id="59" class="wrd tagcloud1"><a href="#">parent</a></span> <span id="60" class="wrd tagcloud0"><a href="#">partition</a></span> <span id="61" class="wrd tagcloud2"><a href="#">pass</a></span> <span id="62" class="wrd tagcloud4"><a href="#">path</a></span> <span id="63" class="wrd tagcloud3"><a href="#">possible</a></span> <span id="64" class="wrd tagcloud0"><a href="#">primes</a></span> <span id="65" class="wrd tagcloud5"><a href="#">print</a></span> <span id="66" class="wrd tagcloud0"><a href="#">process</a></span> <span id="67" class="wrd tagcloud0"><a href="#">rank</a></span> <span id="68" class="wrd tagcloud0"><a href="#">rectangular</a></span> <span id="69" class="wrd tagcloud0"><a href="#">remapped</a></span> <span id="70" class="wrd tagcloud2"><a href="#">represent</a></span> <span id="71" class="wrd tagcloud5"><a href="#">return</a></span> <span id="72" class="wrd tagcloud0"><a href="#">roman</a></span> <span id="73" class="wrd tagcloud0"><a href="#">root</a></span> <span id="74" class="wrd tagcloud0"><a href="#">row</a></span> <span id="75" class="wrd tagcloud1"><a href="#">search</a></span> <span id="76" class="wrd tagcloud0"><a href="#">segment</a></span> <span id="77" class="wrd tagcloud0"><a href="#">select</a></span> <span id="78" class="wrd tagcloud0"><a href="#">space</a></span> <span id="79" class="wrd tagcloud7"><a href="#">string</a></span> <span id="80" class="wrd tagcloud0"><a href="#">structure</a></span> <span id="81" class="wrd tagcloud1"><a href="#">subarray</a></span> <span id="82" class="wrd tagcloud0"><a href="#">submatrix</a></span> <span id="83" class="wrd tagcloud3"><a href="#">subsets</a></span> <span id="84" class="wrd tagcloud1"><a href="#">substrings</a></span> <span id="85" class="wrd tagcloud5"><a href="#">sum</a></span> <span id="86" class="wrd tagcloud0"><a href="#">table</a></span> <span id="87" class="wrd tagcloud0"><a href="#">tac</a></span> <span id="88" class="wrd tagcloud2"><a href="#">tcp</a></span> <span id="89" class="wrd tagcloud0"><a href="#">template</a></span> <span id="90" class="wrd tagcloud0"><a href="#">thread</a></span> <span id="91" class="wrd tagcloud0"><a href="#">tic</a></span> <span id="92" class="wrd tagcloud0"><a href="#">toe</a></span> <span id="93" class="wrd tagcloud1"><a href="#">total</a></span> <span id="94" class="wrd tagcloud5"><a href="#">tree</a></span> <span id="95" class="wrd tagcloud0"><a href="#">true</a></span> <span id="96" class="wrd tagcloud2"><a href="#">udp</a></span> <span id="97" class="wrd tagcloud3"><a href="#">value</a></span> <span id="98" class="wrd tagcloud1"><a href="#">virtual</a></span> <span id="99" class="wrd tagcloud1"><a href="#">words</a></span> </div><div id="credit">created at <a href="http://tagcrowd.com">TagCrowd.com</a></div>

<!-- end tag cloud : generated by TagCrowd.com : please keep this notice -->

   </div>
   <div class="post-div" id="post_div">
      <br>
      <form role="form">
        <div class="form-group">
          <label for="category">Category:</label>
          <div class="p_inline">
            <select id="post_category" class="form-control">...</select>
          </div>
        </div>

        <div class="form-group">
         <label for="title">Title:</label>
          <div class= "p_inline"> 
	   <input type="text" class="title form-control"
              placeholder="Type title here"
              id="question_title_text"
              rows="1"
              maxlength="100">
	  </div>
        </div>

        <div class="form-group">
          <label class="control-label" for="question">Question:</label>
           <div class="p_inline">
	    <textarea type="text" class="q_text_area form-control"
              placeholder="Type question here"
              id="question_text"
              rows="10"
              maxlength="5000"></textarea>
            </br>
            <button id="post_question_button" class="btn btn-primary" type="button">Post Question</button><br>
         </div>
	 </div>
    </form>

   </div>
  </div><!--end tab-content-->

 </div><!--end container-->

</body>

</html>

