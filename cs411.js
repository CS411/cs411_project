$(document).ready(function(){
  $("#button1").click(function(){
    $.ajax({
      url: "cs411.php"
      , type: 'post'
      , dataType: 'json'
      , data: {
        FirstName: $( "#firstName" ).val()
	, LastName: $( "#lastName" ).val()
	, Age: $( "#age" ).val() 
      }
      , error: function(response){
      }
      , success:function(result){
        alert("success");
      }
    });
  });
});
