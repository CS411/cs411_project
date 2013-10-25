// This function finds the list of categories and push them into the drop down
// list
newFunc(function() {
  ajaxCall(
    './post.php?request=category',
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
});

newClickHandler("post_button", function() {
  /*alert(
    "post\n"+
    $("#question_text").val()+"\n"+
    document.getElementById("post_category").value
  );*/
  ajaxCall(
    './post.php',
    { 
      method: 'post_question',
      category: document.getElementById("post_category").value,
      question_desc: $("#question_text").val()
    },
    function() {
      alert("success")
    },
    function() {
      alert("failed");
    },
    'post'
  );
});

newClickHandler("search_button", function() {
  ajaxCall(
    './post.php',
    { 
      method: 'search_category',
      category: document.getElementById("search_category").value,
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
        div.append(
          newButton(i, "edit")+
          newButton(i, "delete")+
          " "+result[i]+"<br>"
        );
      }
    },
    function() {
      alert("failed");
    },
    'post'
  );
});

newClickHandler("see_question_button", function() {
  var div = $("#search_result_div");
  div.empty();
  div.appent("question desc");
});

newClickHandler("update_button", function() {
  alert("update");
  ajaxCall(
    './post.php',
    {
      question_id: $("#question_id").val(),
      question_desc: $("#question_text").val()
    },
    null,
    null,
    'post'
  );
});

newClickHandler("delete_button", function() {
  alert("delete");
  ajaxCall(
    './post.php',
    {
      method: 'delete_question',
      question_id: $("#question_id").val()
    },
    null,
    null,
    'post'
  );
});

// Helper functions

function getQuestionDesc(question_id) {
  return "question_desc";
}

function newFunc(func) {
  $(document).ready(func);
}

function newClickHandler(id, callback) {
  newFunc(function() {
    id = "#"+id;
    $(id).click(callback);
  });
}

function ajaxCall(url, data, successCallback, errorCallback, type) {
  if (typeof type === "undefined") {
    type = 'get';
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

function newButton(id, text) {
  return "<button id=\""+id+"\" type=\"button\">"+text+"</button>";
}
