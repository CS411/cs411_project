$(document).ready(function(){
  $("#button1").click(function(){
    $.ajax({
      url: "post.php?request=categories"
      , type: 'get'
      , dataType: 'json'
      , error: function(response){
        alert("fail");
      }
      , success:function(result){
        alert("success");
      }
    });
  });
});
