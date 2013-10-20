// This function finds the list of categories and push them into the drop down
// list
newFunc(function() {
  ajaxCall(
    './post.php?request=category',
    null,
    function(result) {
      var cat = $("#category");
      for (var i=0; i<result.length; i++) {
        var option=document.createElement("option");
        option.text=result[i];
        cat.append(option);
      }
    }
  );
});

newClickHandler("post", function() {
  alert("post");
  ajaxCall(
    './post.php',
    { 
      question_desc: $("#question_box").val(),
      category: $("#category").val()
    },
    null,
    null,
    'post'
  );
});

newClickHandler("search", function() {
  ajaxCall(
    './post.php',
    { 
      category: $("#category").val()
    },
    function(result) {
      // TODO: find html element and push result to it
    },
    null,
    'post'
  );
});

newClickHandler("delete", function() {
  ajaxCall(
    './post.php',
    {
      question_id: $("#question_id").val()
    },
    null,
    null,
    'post'
  );
});

newClickHandler("button1", function() {
  alert("click me");
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
