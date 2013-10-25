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
  alert(
    "post\n"+
    $("#question_text").val()+"\n"+
    document.getElementById("post_category").value
  );
  $.ajax({
    url: "./post.php",
    type: 'post',
    dataType: 'json',
    data: {
      method: "post_question",
      category: document.getElementById("post_category").value,
      question_desc: $("#question_text").val()
    },
    success: function() {
      alert("success");
    },
    error: function() {
      alert("failed");
    }
  });
  /*ajaxCall(
    './post.php',
    { 
      method: 'post_question',
      category: document.getElementById("post_category").value,
      question_desc: $("#question_text").val()
    },
    null,
    function() {alert("post error");},
    'post'
  );*/
});

newClickHandler("search_button", function() {
  alert("search");
  var search_div = $("#search_div");
  search_div.append("search result");
  ajaxCall(
    './post.php',
    { 
      category: $("#category").val()
    },
    function(result) {
      search_div.append(result);
    },
    null,
    'post'
  );
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
    dataType: 'json',
    data: data,
    success: successCallback,
    error: errorCallback
  });
}
