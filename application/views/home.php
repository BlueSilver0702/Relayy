<script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key: 75yg45wf5h9itq
    authorize: true
</script>

<script type="text/javascript">
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
    }

    function onLinkedInClk() {
        IN.UI.Authorize().place();
        onLinkedInLoad();
    }

    // Handle the successful return from the API call
    function onSuccess(data) {
        //console.log(data);
        var dataObj = data.values[0];
        // console.log(dataObj.id+ dataObj.emailAddress+ dataObj.firstName+ dataObj.lastName);
        registerFacebook(dataObj.id, dataObj.emailAddress, dataObj.firstName, dataObj.lastName, dataObj.pictureUrl, dataObj.headline, 3);
    }

    // Handle an error response from the API call
    function onError(error) {
        console.log(error);
    }

    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        IN.API.Profile("me").fields("id", "pictureUrl", "first-name", "last-name", "email-address", "headline").result(onSuccess).error(onError);
        // IN.API.Raw("/people/~").result(onSuccess).error(onError);
    }

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
            <form method="post" action="<?php echo site_url('auth/linkedin') ?>" id="linkedin_form">
              <input type="hidden" id="li_id" name="li_id" value="">
              <input type="hidden" id="li_email" name="li_email" value="">
              <input type="hidden" id="li_login" name="li_login" value="">
              <input type="hidden" id="li_fname" name="li_fname" value="">
              <input type="hidden" id="li_lname" name="li_lname" value="">
              <input type="hidden" id="li_photo" name="li_photo" value="">
              <input type="hidden" id="li_bio" name="li_bio" value="">
              <button type="button" class="btn btn-primary btn-lg btn-block facebook"  onclick="onLinkedInClk()">Login with LinkedIn</button>
            </form>
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
                <label class="control-label col-sm-4" for="usr_reg_n_fname">First Name:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="reg_fname" id="usr_reg_n_fname" placeholder="Enter first name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_lname">Last Name:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="reg_lname" id="usr_reg_n_lname" placeholder="Enter last name">
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