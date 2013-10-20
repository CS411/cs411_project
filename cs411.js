newFunc(function() {
  ajaxCall(
    './post.php?request=category',
    null,
    function(result) {
      var cat = $("#category");
      for (var i=0; i<result.length; i++) {
        var option=document.createElement("option");
        option.text=result[i];
        try {
          cat.append(option);
        } catch (e) {
          alert(cat.size);
        }
      }
    }
  );
});

newClickHandler("post", function() {
  ajaxCall(
    './post.php',
    { QuestionDesc: $("question_desc").val() },
    null,
    null,
    'post'
  );
});

newClickHandler("search", function() {
  ajaxCall(
    './post.php',
    { QuestionDesc: $("question_desc").val() },
    null,
    null,
    'post'
  );
});

newClickHandler("button1", function() {
  alert("click me");
});

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
