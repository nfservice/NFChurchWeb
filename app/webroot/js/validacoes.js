$(document).ready(function() {
  $("#UserAddForm").validate({
    rules: {
      UserNome: {
        minlength: 4
      },
      UserUsername: {
        minlength: 5
      },
      UserPassword: { 
        minlength: 5
      }, 
      UserRepassword: { 
        equalTo: "#UserPassword", minlength: 5
      }, 
      UserTelefone: {
        minlength: 8
      }
    }
  });
});