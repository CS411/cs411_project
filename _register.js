// This function finds the list of categories and push them into the drop down
// list
$(document).ready(_init);

function _init() {
  $("#signup").validate({
    rules:{
      user_id:"required",
      email:{
        required:true,
      email: true
      },
      passwd:{
        required:true,
        minlength: 8
      },
      conpasswd:{
        required:true,
        equalTo: "#passwd"
      },
      gender:"required"
    },
    errorClass: "help-inline"
  });
}
