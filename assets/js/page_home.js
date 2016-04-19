function loginDialogPopup() {
  $("#loginForm").modal("show");
}

function registerDialogPopup() {
  $("#loginForm").modal("hide");
  $("#registerForm").modal("show");
}

function registerFacebook(uid, email, fname, lname, picture, bio, role) {

  var params = { 'login': email, 'password': QBApp.authKey, 'full_name': fname+" "+lname, 'email': email };
  
  var filters = {filter: { field: 'email', param: 'eq', value: email }};
  QB.users.listUsers(filters, function(err, result){
    if (result && result.items.length> 0) {
      console.log("----------------linkedin register: old user");
      var user = result.items[0];
      // console.log(user.user);return;
      $.ajax({
       url: site_url + 'home/link',
       data: {
          email: user.user.email
       },
       success: function(data) {
          if (data == "yes") {
              $("#loginForm").modal("hide");
              $("#lir_id").val(user.user.id);
              $("#lir_login").val(user.user.login);
              $("#lir_fname").val(fname);
              $("#lir_lname").val(lname);
              $("#lir_email").val(user.user.email);
              $("#lir_photo").val(picture);
              $("#lir_bio").val(bio);
              
              $("#linkedinForm").modal("show");
          } else {
              $("#li_id").val(user.user.id);
              $("#li_login").val(user.user.login);
              $("#li_fname").val(fname);
              $("#li_lname").val(lname);
              $("#li_email").val(user.user.email);
              $("#li_photo").val(picture);
              $("#li_bio").val(bio);
              $("#linkedin_form").submit();     
          }
       },
       type: 'POST'
      });
    } else if (result && result.items.length == 0) {
      console.log("----------------linkedin register: new user");
      
      $("#loginForm").modal("hide");
      QB.users.create(params, function(err, user){
        if (user) {
          $("#lir_id").val(user.id);
          $("#lir_login").val(user.login);
          $("#lir_fname").val(fname);
          $("#lir_lname").val(lname);
          $("#lir_email").val(user.email);
          $("#lir_photo").val(picture);
          $("#lir_bio").val(bio);
          
          $("#linkedinForm").modal("show");
//          $("#linkedin_form").submit();
        } else  {
          alert("***********************" + JSON.stringify(err));
        }
      }); 
    } else {
      console.log(result);
    }
  });

}

$(document).ready(function() {

  // First of all create a session and obtain a session token
  // Then you will be able to run requests to Users
  //
  QB.createSession(function(err,result){
    console.log('Session create callback', err, result);
  });

  // Create user
  //
  $('#sign_up').on('click', function() {
  	$("#load-users").addClass("visible");
  	$("#load-users").attr('disabled', true);

    var login = $('#usr_reg_n_lgn').val();
    var password = $('#usr_reg_n_pwd').val();
    var fname = $('#usr_reg_n_fname').val();
    var lname = $('#usr_reg_n_lname').val();
    var user_role = $('#user_role').val();

      var filters = {filter: { field: 'email', param: 'eq', value: login }};
      QB.users.listUsers(filters, function(err, result){
        if (result && result.items.length> 0) {
          console.log("----------------linkedin register: old user");
          var user = result.items[0];
          $("#user_id").val(user.id);
          $("#register_form").submit();

        } else if (result && result.items.length == 0) {
          var params = { 'login': login, 'password': QBApp.authKey, 'full_name': fname+" "+lname, 'email': login };

            QB.users.create(params, function(err, user){
              if (user) {
                //alert(JSON.stringify(user));
                $("#user_id").val(user.id);
                $("#register_form").submit();
              } else  {
                alert(JSON.stringify(err));
              }

              $("#load-users").removeClass("visible");
                $("#load-users").attr('disabled', false);
              //$("#progressModal").modal("hide");
              //$("html, body").animate({ scrollTop: 0 }, "slow");
            }); 
        } else {
          console.log(err);
        }
      });
  });


  // Login user
  //
  $('#sign_in').on('click', function() {
    var login = $('#usr_sgn_n_lgn').val();
    var password = $('#usr_sgn_n_pwd').val();

    var params = { 'login': login, 'password': QBApp.authKey};

    QB.login(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Login user with social provider
  //
  $('#sign_in_social').on('click', function() {

    var provider = $('#usr_sgn_n_social_provider').val();
    var token = $('#usr_sgn_n_social_token').val();
    var secret = $('#usr_sgn_n_social_secret').val();

    var params = { 'provider': provider, 'keys[token]': token, 'keys[secret]': secret};

    QB.login(params, function(err, user){
      if (user) {
        $('#output_place').val(JSON.stringify(user));
      } else  {
        $('#output_place').val(JSON.stringify(err));
      }

      $("#progressModal").modal("hide");

      $("html, body").animate({ scrollTop: 0 }, "slow");
    });
  });

  // Update user
  //
//  $('#update').on('click', function() {
//    var user_id = $('#usr_upd_id').val();
//    var user_fullname = $('#usr_upd_full_name').val();
//
//      if (user) {
//        $('#output_place').val(JSON.stringify(user));
//      } else  {
//        $('#output_place').val(JSON.stringify(err));
//      }
//
//      $("#progressModal").modal("hide");
//
//      $("html, body").animate({ scrollTop: 0 }, "slow");
//    });
//  });
});
