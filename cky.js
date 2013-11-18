// This function finds the list of categories and push them into the drop down
// list
$(document).ready(_init);

function _init() {
  hide_all_tabs_but("home");

  $("#home_tab").click(_handle_home_tab_click);
  $("#search_tab").click(_handle_search_tab_click);
  $("#post_tab").click(_handle_post_tab_click);
 
  $("#search_button").click(_handle_search_button_click);
  $("#post_question_button").click(_handle_post_question_click);
  $("#post_solution_button").click(_handle_post_solution_click);
  $("#register").click(function(){
    window.open("http://cky.cs.illinois.edu/bchiang3/register.php");
  });

//  $("#login").click(_handle_login_request);
  ajax_call(
    "./post.php?request=category",
    null,
    function(result) {
      var search_cat = $("#search_category");
      var post_cat = $("#post_category");
      for (var i=0; i<result.length; i++) {
        search_cat.append($("<option></option>").append(result[i]));
        post_cat.append($("<option></option>").append(result[i]));
      }
    },
    function() {
      alert("Updating categories failed");
    }
  );
}
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
//      $('.navbar-form').remove();
  //    $('.nav-collapse').append(result);
    },
    function(response) {
      alert("Log in failed");
    },
    "post"
  );

}
function hide_all_tabs_but(tab) {
  $("#home_div").hide();
  $("#search_div").hide();
  $("#post_div").hide();
  if (typeof tab != "undefined") {
    $("#"+tab+"_div").show();
  }
}

function ajax_call(url, data, successCallback, errorCallback, type) {
  if (typeof type === "undefined") {
    type = "get";
  }
  $.ajax({
    url: url,
    type: type,
    //dataType: 'json',
    data: data,
    success: successCallback,
    error: errorCallback
  });
}

function new_button(content, id) {
  var button = $("<button></button>").append(content);
  if (typeof id != "undefined") {
    return button.attr("id", id);
  }
  return button;
}

function new_link(content, id) {
  var link = $("<a></a>")
    .append(content)
    .css("cursor", "pointer");
  if (typeof id != "undefined") {
    return link.attr("id", id);
  }
  return link;
}

function _handle_home_tab_click() {
  hide_all_tabs_but("home");
  $("#search_tab").parent().removeClass("active"); 
  $("#post_tab").parent().removeClass("active"); 
  $('#home_tab').parent().addClass("active"); 
}

function _handle_search_tab_click() {
  hide_all_tabs_but("search");
  empty_search_result();
  $("#result_detail_div").hide();
  $("#post_tab").parent().removeClass("active"); 
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().addClass("active"); 
}

function _handle_post_tab_click() {
  hide_all_tabs_but("post");
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().removeClass("active"); 
  $("#post_tab").parent().addClass("active"); 
}

function empty_result_detail() {
  $("#detail_question_div").empty();
  $("#detail_solutions_div").empty();
  //$("#post_solution_div").removeAttr("qid");
}

function empty_search_result() {
  $("#result_list_div").empty();
  empty_result_detail();
}

function _handle_search_button_click() {
  ajax_call(
    "./post.php",
    { 
      method: "search_category",
      category: $("#search_category").val(),
    },
    function(result) {
      empty_search_result();
      $("#result_detail_div").hide();

      var list = $("<ul></ul>").attr("id", "result_list");
      $("#result_list_div").append(list);
      for (var i=0; i<result.length; i++) {
        var content = new_link(result[i]['title']);
        var content_div = $("<div></div>").append(content);
        var item = $("<li></li>")
          .attr({
            "id": "item"+result[i]['ID'],
            "qid": result[i]['ID']
          })
          .addClass("result-item")
          .append(content_div);
        list.append(item);
      }
      $(".result-item").click(_handle_result_item_click);
    },
    function(error) {
      alert("Searching failed");
    },
    "post"
  );
}

function _handle_result_item_click() {
  var qid = $(this).attr("qid");
  ajax_call(
    "./post.php?request=solutions&id="+qid,
    null,
    function(solutions) {
      empty_result_detail();
      $("#result_detail_div").show();

      var ques_post = $("<div></div>").attr("qid", qid);
      $("#detail_question_div").append(ques_post);
      show_post("question", qid, ques_post);

      for (var i=0; i<solutions.length; i++) {
        var sid = solutions[i]['ID'];
        var soln_div = $("<div></div>").attr("sid", sid);
        div.append(soln_div);
        show_post("solution", sid, soln_div);
      }
    },
    function(error, response) {
      alert("Showing question failed");
    }
  );
}

function _handle_edit_click() {
  var div = $(this).parent().parent();
  var text = $(div.children().get(0)).text();
  div.empty();
  var textarea = $("<textarea></textarea>").append(text).addClass("edit_area");
  var cancel_button = new_button("cancel").addClass("btn").addClass("btn-default").addClass("btn-cancel");
  var submit_button = new_button("submit").addClass("btn").addClass("btn-success").addClass("btn-submit");
  var button_div = $("<div></div>").append(cancel_button).append(submit_button).addClass("to_right");
  div.append(textarea).append(button_div);
  $(".btn-cancel").click(_handle_cancel_click);
  $(".btn-submit").click(_handle_submit_click);
}

function _handle_delete_click() {
  var id = $(this).attr("qid");
  if (id != null) {
    method = "delete_question";
  } else {
    id = $(this.attr("sid"));
    method = "delete_solution";
  }
  ajax_call(
    "./post.php",
    {
      method: method,
      id: id
    },
    function() {
      if (method == "delete_question") {
        $("#item"+id).remove();
        empty_result_detail();
      } else {
        $("#soln"+id).remove();
      }
    },
    function() {
      alert("Deleting failed");
    },
    "post"
  );
}

function _handle_cancel_click() {
  var div = $(this).parent().parent();
  var qid = div.attr("qid");
  if (qid != null) {
    show_post("question", qid, div);
  } else {
    show_post("solution", div.attr("sid"), div);
  }
}

function _handle_submit_click() {
  alert("submit");
}

function _handle_post_solution_click() {
  alert("Posting solution");
}

function show_post(post_type, id, div) {
  ajax_call(
    "./post.php?request="+post_type+"&id="+id,
    null,
    function(result) {
      div.empty();
      div.addClass("thumbnail");
      var span = $("<span></span>").append(result).attr("id", "span"+id);
      var edit_button = new_button("edit").addClass("btn").addClass("btn-success").addClass("btn-edit");
      var delete_button = new_button("delete").addClass("btn").addClass("btn-danger").addClass("btn-delete");
      var button_div = $("<div></div>").addClass("to_right")
        .append(edit_button)
        .append(delete_button);
      div.append(span).append(button_div);
      $(".btn-edit").click(_handle_edit_click);
      $(".btn-delete").click(_handle_delete_click);
    },
    function() {
      alert("Showing post failed");
    }
  );
}

// Post Tab 

function _handle_post_question_click() {
  var question_title = $("#question_title_text");
  if (question_title.val() == "") {
    alert("Title can not be empty");
    return;
  }
  var question_desc = $("#question_text");
  if (question_desc.val() == "") {
    alert("Question can not be empty");
    return;
  }
  ajax_call(
    "./post.php",
    { 
      method: "post_question",
      category: $("#post_category").val(),
      title: question_title.val(),
      question_desc: question_desc.val()
    },
    function() {
      question_title.val("");
      question_desc.val("");
      alert("Succeed")
    },
    function() {
      alert("Failed");
    },
    "post"
  );
}
