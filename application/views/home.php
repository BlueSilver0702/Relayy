<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1175410405803776',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div id="main" class="main">
    <div class="section_wrapper container">
        <div class="text_hero col-sm-6">
            <p class="hi_logo"></p>
            <div class="hi_tit">Talk business, build business relationships.</div>
            <p class="hi_icos"></p>
            <p class="con_text">
            
            <a href="#" class="btn_download" onclick="loginDialogPopup()">Signin to Relayy</a>

            <span class="subtext">Available for iOS &amp; Android</span>
            <a class="appstore" title="download Relayy for iOS"></a>
            <a class="playstore" title="download Relayy for Android" target="_blank"></a>
        </p>

        </div>
        <div class="image_hero col-sm-6">
            <img src="<?php echo asset_base_url()?>/images/mobile.jpg">
        </div>
    </div>

    <div id="loginForm" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Login to Relayy</h3>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo site_url('auth/login') ?>" id="login_form">
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_sgn_n_lgn">Login Email:</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" name="sgn_email" id="usr_sgn_n_lgn" placeholder="Enter email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_sgn_n_pwd">Password:</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="sgn_pwd" id="usr_sgn_n_pwd" placeholder="Enter password">
                </div>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-4 col-sm-6">
                  <button type="submit" class="btn btn-primary  btn-block" id="sign_in" data-toggle="modal">Login</button>
                </div>
              </div>
            </form>
          </div>
          <div class="clear"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-lg btn-block facebook" onclick="registerFacebook()">Login with Facebook</button>
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="registerDialogPopup()">Register to Relayy</button>
          </div>
        </div>
      </div>
    </div>

    <div id="registerForm" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Register to Relayy</h3>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo site_url('auth/register') ?>" id="register_form">
              <input type="hidden" name="reg_id" value="" id="user_id">
              <div class="form-group">
                <label class="col-sm-4 control-label">User Role:</label>
                <div class="col-sm-6 selectContainer">
                  <select class="form-control" name="reg_role" id="user_role">
                    <option value="">Choose a role</option>
                    <option value="1">Admin</option>
                    <option value="2">Advisor</option>
                    <option value="3">Startups & Expert</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_ful">Full Name:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="reg_full" id="usr_reg_n_ful" placeholder="Enter full name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_lgn">Login Email:</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" name="reg_email" id="usr_reg_n_lgn" placeholder="Enter email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_pwd">Password:</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="reg_pwd" id="usr_reg_n_pwd" placeholder="Enter password">
                </div>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-4 col-sm-6">
                  <button type="button" class="btn btn-danger btn-block" id="sign_up" data-toggle="modal">Register</button>
                </div>
              </div>
              <div style="margin-top:5px;">
                <div class="col-sm-offset-4 col-sm-6">
                  <img src="assets/images/ajax-loader.gif" id="load-users">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</div>