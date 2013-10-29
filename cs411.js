// This function finds the list of categories and push them into the drop down
// list
$(document).ready(_init);

function _init() {
  $("#search_button").click(_handle_search_button_click);
  $("#post_button").click(_handle_post_button_click);
  ajax_call(
    "./post.php?request=category",
    null,
    function(result) {
      var search_cat = $("#search_category");
      var post_cat = $("#post_category");
      for (var i=0; i<result.length; i++) {
        var search_option=document.createElement("option");
        var post_option=document.createElement("option");
        search_option.text=result[i];
        post_option.text=result[i];
        search_cat.append(search_option);
        post_cat.append(post_option);
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

function _handle_search_button_click() {
  $("#search_div").show();
  ajax_call(
    "./post.php",
    { 
      method: "search_category",
      category: $("#search_category").val(),
    },
    function(result) {
      var div = $("#search_result_div");
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
        div.append(button).append(result[i]['title']+"<br>");
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
  var search_result_div = $("#search_result_div");
  search_result_div.empty();
  var id = $(this).attr("id");
  var desc = get_question(id);
  var edit_button = new_button("edit");
  var delete_button = new_button("delete");
  search_result_div
    .append(edit_button)
    .append(delete_button)
    .append("<br>"+desc);
  $("#edit_button").click(_handle_edit_button_click);
  $("#delete_button").click(_handle_delete_button_click);
}

function new_button(label) {
  return $("<button></button>")
    .append(label)
    .attr("id", label+"_button");
}

function get_question(id) {
  ajax_call(
    "./post.php",
    {
      method: "get_question_desc"
    },
    function(result) {
      return result;
    },
    function(error) {
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
      alert("success")
    },
    function() {
      alert("failed");
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

function _handle_delete_button_click() {
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
