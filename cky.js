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
    window.open("http://cky.cs.illinois.edu/carolineli/register.php");
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

function new_elem(name, content, id) {
  var elem = $("<"+name+"></"+name+">");
  if (typeof content == "undefined") {
    return elem;
  }

  elem.append(content);
  if (typeof id == "undefined") {
    return elem
  }

  return elem.attr("id", id);
}

function new_link(content, id) {
  var link = new_elem("a", content).css("cursor", "pointer");
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
  $("#post_solution_button").removeAttr("qid");
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

      var list = new_elem("ul").attr("id", "result_list");
      $("#result_list_div").append(list);
      for (var i=0; i<result.length; i++) {
        var content = new_link(result[i]['title']);
        var content_div = new_elem("div", content);
        var item = new_elem("li", content_div)
          .attr({
            "id": "item_q"+result[i]['id'],
            "qid": result[i]['id']
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
  empty_result_detail();
  $("#result_detail_div").hide();
  var qid = $(this).attr("qid");
  ajax_call(
    "./post.php?request=solutions&id="+qid,
    null,
    function(solutions) {
      var ques_post = new_elem("div").attr("qid", qid);
      $("#detail_question_div").append(ques_post);
      create_post("question", qid, ques_post);

      for (var i=0; i<solutions.length; i++) {
        var sid = solutions[i]['id'];
        var soln_div = new_elem("div").attr("id", "post_s"+sid).attr("sid", sid);
        create_post("solution", sid, soln_div);
        $("#detail_solutions_div").append(soln_div);
      }
      $("#post_question_button").attr("qid", qid);
      $("#result_detail_div").show();
    },
    function(error, response) {
      alert("Showing question failed");
    }
  );
}

function _handle_edit_click() {
  var div = $(this).parent().parent();
  var full_id = typeof div.attr("qid") != "undefined" ?
    "q"+div.attr("qid") : "s"+div.attr("sid");
  var html = $(div.children().get(0)).html();
  div.empty();
  var textarea = new_elem("textarea", htmlToText(html)).addClass("edit_area");
  var cancel_button = 
    new_elem("button", "cancel", "cancel_"+full_id)
    .addClass("btn")
    .addClass("btn-default")
    .addClass("btn-cancel");
  var submit_button = 
    new_elem("button", "submit", "submit_"+full_id)
    .addClass("btn")
    .addClass("btn-success")
    .addClass("btn-submit");
  var button_div = 
    new_elem("div")
    .append(cancel_button)
    .append(submit_button)
    .addClass("to_right");
  div.append(textarea).append(button_div);
  $("#cancel_"+full_id).click(_handle_cancel_click);
  $("#submit_"+full_id).click(_handle_submit_click);
}

function _handle_delete_click() {
  var div = $(this).parent().parent();
  var id = div.attr("qid");
  var method;
  if (typeof id != "undefined") {
    method = "delete_question";
  } else {
    id = div.attr("sid");
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
        $("#item_q"+id).remove();
        empty_result_detail();
      } else {
        $("#post_s"+id).remove();
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
  if (typeof qid != "undefined") {
    create_post("question", qid, div);
  } else {
    create_post("solution", div.attr("sid"), div);
  }
}

function _handle_submit_click() {
  alert("Modifying is not implemented yet");
}

function _handle_post_solution_click() {
  var soln_desc = $("#solution_text");
  if (soln_desc.val() == "") {
    alert("Solution can not be empty");
    return;
  }
  ajax_call(
    "./post.php",
    { 
      method: "post_solution",
      qid: $(this).attr("qid")
    },
    function() {
      soln_desc.val("");
      alert("Succeed")
    },
    function() {
      alert("Failed");
    },
    "post"
  );
}

function create_post(post_type, id, div) {
  ajax_call(
    "./post.php?request="+post_type+"&id="+id,
    null,
    function(result) {
      div.empty();
      div.addClass("thumbnail");
      var span = new_elem("span");
      if (result != null) {
        span.append(textToHtml(result));
      }
      var full_id = post_type == "question" ? "q"+id : "s"+id;
      var edit_button =
        new_elem("button", "edit", "edit_"+full_id)
        .addClass("btn")
        .addClass("btn-success")
      var delete_button =
        new_elem("button", "delete", "delete_"+full_id)
        .addClass("btn")
        .addClass("btn-danger")
      var button_div = new_elem("div").addClass("to_right")
        .append(edit_button)
        .append(delete_button);
      div.append(span).append(button_div);
      $("#edit_"+full_id).click(_handle_edit_click);
      $("#delete_"+full_id).click(_handle_delete_click);
    },
    function() {
      alert("Showing post failed");
    }
  );
}

// Post Tab 

function _handle_post_question_click() {
  var ques_title = $("#question_title_text");
  if (ques_title.val() == "") {
    alert("Title can not be empty");
    return;
  }
  var ques_desc = $("#question_text");
  if (ques_desc.val() == "") {
    alert("Question can not be empty");
    return;
  }
  ajax_call(
    "./post.php",
    { 
      method: "post_question",
      category: $("#post_category").val(),
      title: ques_title.val(),
      question_desc: ques_desc.val()
    },
    function() {
      ques_title.val("");
      ques_desc.val("");
      alert("Succeed")
    },
    function() {
      alert("Failed");
    },
    "post"
  );
}

// Conversions between <br> and '\r\n'

function textToHtml(text) {
  return text.replace(/(\r\n|\n|\r)/gm, "<br>");
}

function htmlToText(html) {
  return html.replace(/<br\s*\/?>/ig, "\r\n");
}

