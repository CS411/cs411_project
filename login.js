// This function finds the list of categories and push them into the drop down
// list
$(document).ready(function(){
//$("#login").click(_handle_login_request);
$("#login").click(_handle_login_request());
});

function _handle_login_request(){
    ajax_call(
    "./login.php",
    {
      id: $("#username").val(),
      passwd: $("#password").val()
    },
    function(result) {
      //location.href += "member.html";
      //window.location += "member.html";
      $('.navbar-form').remove();
      $('.nav-collapse').append(result);
      /*
      var search_cat = $("#search_category");
      var post_cat = $("#post_category");
      for (var i=0; i<result.length; i++) {
        search_cat.append($("<option></option>").append(result[i]));
        post_cat.append($("<option></option>").append(result[i]));
      }*/
    },
    function(response) {
      alert("Log in failed");
    },
    "post"
  );

}
