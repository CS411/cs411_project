// This function finds the list of categories and push them into the drop down
// list
$(document).ready(_init);

function _init() {
  $("#home_div").show();
  $("#search_div").hide();
  $("#post_div").hide();

  $("#home_tab").click(_handle_home_tab_click);
  $("#search_tab").click(_handle_search_tab_click);
  $("#post_tab").click(_handle_post_tab_click);
 
  $("#search_button").click(_handle_search_button_click);
  $("#post_button").click(_handle_post_button_click);

  /*$("#question_desc_text").click(function() {
    $("#question_desc_text").value = '';
  });*/
  ajax_call(
    "./post.php?request=category",
    null,
    function(result) {
      var search_cat = $("#search_category");
      var post_cat = $("#post_category");
      for (var i=0; i<result.length; i++) {
        search_cat.append(
          $("<option></option>").append(result[i])
        );
        post_cat.append(
          $("<option></option>").append(result[i])
        );
      }
    },
    function() {
      alert("Updating category failed");
    }
  );
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

function _handle_home_tab_click() {
  var home_div = $("#home_div").show();
  var search_div = $("#search_div").hide();
  var post_div = $("#post_div").hide();
  $("#search_tab").parent().removeClass("active"); 
  $("#post_tab").parent().removeClass("active"); 
  $('#home_tab').parent().addClass("active"); 
}

function _handle_search_tab_click() {
  var search_div = $("#search_div").show();
  var home_div = $("#home_div").hide();
  var post_div = $("#post_div").hide();
  $("#post_tab").parent().removeClass("active"); 
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().addClass("active"); 
}

function _handle_post_tab_click() {
  var post_div = $("#post_div").show();
  var search_div = $("#search_div").hide();
  var home_div = $("#home_div").hide();
  $("#home_tab").parent().removeClass("active"); 
  $("#search_tab").parent().removeClass("active"); 
  $("#post_tab").parent().addClass("active"); 
}

function _handle_search_button_click() {
  $("#search_result_left_div").empty();
  $("#search_result_right_div").empty();
  ajax_call(
    "./post.php",
    { 
      method: "search_category",
      category: $("#search_category").val(),
    },
    function(result) {
      var div = $("#search_result_left_div");
      div.empty();
      if (result.length == 0) {
        div.append("No result found");
      } else if (result.length == 1) {
        div.append("1 result:<br>");
      } else {
        div.append(result.length+" results:<br>");
      }
      for (var i=0; i<result.length; i++) {
        var button =
          new_button("see")
            .attr("id", result[i]['ID'])
            .addClass("see_button");
        div.append(button).append(" "+result[i]['title']+"<br>");
      }
      $(".see_button").click(_handle_see_button_click);
    },
    function(error) {
      alert("Error: "+error);
    },
    "post"
  );
}

function _handle_see_button_click() {
  var div = $("#search_result_right_div");
  div.empty();
  var id = $(this).attr("id");
  show_question_desc(id, div);
}


function new_button(label) {
  return $("<button></button>")
    .append(label)
    .attr("id", label+"_button");
}

function show_question_desc(id, div) {
  ajax_call(
    "./post.php",
    {
      method: "get_question_desc",
      id: id
    },
    function(result) {
      var edit_button = new_button("edit");
      var delete_button = new_button("delete");
      div
        .append(edit_button)
        .append(delete_button)
        .append("<br>"+result);
      $("#edit_button").click(_handle_edit_button_click);
      $("#delete_button").click(_handle_delete_button_click);
    },
    function(error, response) {
      alert("Error: "+error);
    },
    "post"
  );
}

function _handle_edit_button_click() {
  alert("edit");
}

function _handle_post_button_click() {
  ajax_call(
    "./post.php",
    { 
      method: "post_question",
      category: $("#post_category").val(),
      title: $("#question_title_text").val(),
      question_desc: $("#question_text").val()
    },
    function() {
      alert("Succeed")
    },
    function() {
      alert("Failed");
    },
    "post"
  );
}

function _handle_update_button_click() {
  alert("update");
  ajax_call(
    "./post.php",
    {
      question_id: $("#question_id").val(),
      question_desc: $("#question_text").val()
    },
    null,
    null,
    "post"
  );
}

function _handle_delete_button_click(id) {
  alert("delete");
  /*ajax_call(
    "./post.php",
    {
      method: "delete_question",
      question_id: $("#question_id").val()
    },
    null,
    null,
    "post"
  );*/
}
