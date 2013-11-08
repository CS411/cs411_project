// This function finds the list of categories and push them into the drop down
// list
$(document).ready(_init);

function _init() {
  hide_all_tabs_but("home");

  $("#home_tab").click(_handle_home_tab_click);
  $("#search_tab").click(_handle_search_tab_click);
  $("#post_tab").click(_handle_post_tab_click);
 
  $("#search_button").click(_handle_search_button_click);
  $("#post_button").click(_handle_post_button_click);

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

function new_button(label) {
  return $("<button></button>")
    .append(label)
    .attr("id", label+"_button");
}

function new_a(label) {
  return $("<a></a>")
    .append(label)
    .attr("id", label+"_a")
    .css("cursor", "pointer");
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
  $("#search_result_right_div").hide();
  $("#post_tab").parent().removeClass("active"); 
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().addClass("active"); 
}

function empty_search_result_right() {
  $("#search_result_right_top_div").empty();
  $("#search_result_right_bottom_div").empty();
}

function empty_search_result() {
  $("#search_result_left_div").empty();
  empty_search_result_right();
}

function _handle_post_tab_click() {
  hide_all_tabs_but("post");
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().removeClass("active"); 
  $("#post_tab").parent().addClass("active"); 
}

function _handle_search_button_click() {
  empty_search_result();
  $("#search_result_right_div").hide();
  var list = $("<ul></ul>").attr("id", "result_list");
  $("#search_result_left_div").append(list);
  ajax_call(
    "./post.php",
    { 
      method: "search_category",
      category: $("#search_category").val(),
    },
    function(result) {
      for (var i=0; i<result.length; i++) {
        var a = new_a(result[i]['title']);
        var div = $("<div></div>")
          .addClass("result_content")
          .append(a);
        var list_item = $("<li></li>")
          .attr({
            "id": "item"+result[i]['ID'],
            "qid": result[i]['ID']
          })
          .addClass("result_item")
          .append(div);
        list.append(list_item);
      }
      $(".result_item").click(_handle_result_item_click);
    },
    function(error) {
      alert("Searching failed");
    },
    "post"
  );
}

function _handle_result_item_click() {
  empty_search_result_right();
  var qid = $(this).attr("qid");
  ajax_call(
    "./post.php",
    {
      method: "get_question_desc",
      id: qid
    },
    function(result) {
      $("#search_result_right_div").show();
      $("#search_result_right_top_div").append(result);
      var edit_a = new_a("edit").attr("qid", qid);
      var delete_a = new_a("delete").attr("qid", qid);
      $("#search_result_right_bottom_div")
        .append(edit_a)
        .append(" ")
        .append(delete_a);
      $("#edit_a").click(_handle_edit_click);
      $("#delete_a").click(_handle_delete_click);
    },
    function(error, response) {
      alert("Showing question failed");
    },
    "post"
  );

}

function _handle_edit_click() {
  alert("edit");
}

function _handle_delete_click() {
  var qid = $(this).attr("qid");
  ajax_call(
    "./post.php",
    {
      method: "delete_question",
      question_id: qid
    },
    function() {
      $("#item"+qid).remove();
      empty_search_result_right();
      $("#search_result_right_div").hide();
    },
    function() {
      alert("Failed");
    },
    "post"
  );
}

function _handle_post_button_click() {
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
