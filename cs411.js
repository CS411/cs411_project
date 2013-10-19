(function() {
  var self = this;
  $.ajax({
    url: './post.php?request=category',
    dataType: 'json',
    success: function(result) {
      var cat = $("#category");
      for (var i=0;i<result;i++) {
      var option=document.createElement("option");
      option.text="Kiwi";
      try {
        cat.append(option);
      } catch (e) {
        alert(cat.size);
      }
    }
  });
})();
