<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <title><?php if(isset($page_title)) echo $page_title; ?></title>
      <link rel="shortcut icon" href="<?= asset_base_url()?>/images/favicon.png">

      <!--reset styles-->
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/style.css" type="text/css">
      <link rel="stylesheet" href="<?= asset_base_url()?>/libs/bootstrap.min.css" type="text/css">
      <script>var site_url = "<?php echo site_url() ?>";</script>
   </head>
   <body class="<?php if(isset($body_class)) echo $body_class; ?>">
<!-- header end -->

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
    

    <div id="loginForm">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Login to Relayy</h3>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo site_url('auth/login') ?>" id="login_form">
    <?php if (isset($did)){
        echo "<input type='hidden' name='did' value='$did'>";
    } ?>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_sgn_n_lgn">Login Email:</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" name="sgn_email" id="usr_sgn_n_lgn" placeholder="Enter email" value="<?= isset($email)?$email:""?>" <?= isset($email)?"readonly":""?>>
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
            <a class="btn btn-success btn-lg btn-block" href="<?= site_url('register')?>">Register to Relayy</a>
          </div>
        </div>
      </div>
    </div>

    <div id="linkedinForm" class="modal fade" data-keyboard="false" data-backdrop="static" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Register to Relayy with LinkedIn</h3>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="post" action="<?php echo site_url('auth/linkedin') ?>" id="linkedin_register_form">
              <input type="hidden" id="lir_id" name="li_id" value="">
              <input type="hidden" id="lir_email" name="li_email" value="">
              <input type="hidden" id="lir_login" name="li_login" value="">
              <input type="hidden" id="lir_fname" name="li_fname" value="">
              <input type="hidden" id="lir_lname" name="li_lname" value="">
              <input type="hidden" id="lir_photo" name="li_photo" value="">
              <input type="hidden" id="lir_bio" name="li_bio" value="">
              <div class="form-group">
                <label class="col-sm-4 control-label">I'm a </label>
                <div class="col-sm-6 selectContainer">
                  <select class="form-control" name="li_role" id="user_role">
                    <option value="3" selected="selected">Startup</option>
                    <option value="2">Advisor</option>
                  </select>
                </div>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-4 col-sm-6">
                  <input type="submit" class="btn btn-danger btn-block" data-toggle="modal" value="Register">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
</div>
<!-- footer.php -->
            <script src="<?= asset_base_url()?>/libs/jquery.min.js" type="text/javascript"></script>
            <script src="<?= asset_base_url()?>/libs/bootstrap.min.js" type="text/javascript"></script>

            <script src="<?= asset_base_url()?>/libs/quickblox.min.js"></script>
            <script src="<?= asset_base_url()?>/js/config.js"></script>
            <script src="<?= asset_base_url()?>/js/page_home.js"></script>
            
    </body>
</html>