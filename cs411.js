(function() {
  $.ajax({
    url: './post.php?request=category',
    dataType: 'json',
    success: function(result) {
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
    },
    error: function() {alert("..");}
  });
})();
