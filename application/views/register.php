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
    

    <div id="registerForm">
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
<!-- footer.php -->
            <script src="<?= asset_base_url()?>/libs/jquery.min.js" type="text/javascript"></script>
            <script src="<?= asset_base_url()?>/libs/bootstrap.min.js" type="text/javascript"></script>

            <script src="<?= asset_base_url()?>/libs/quickblox.min.js"></script>
            <script src="<?= asset_base_url()?>/js/config.js"></script>
            <script src="<?= asset_base_url()?>/js/page_home.js"></script>
            
    </body>
</html>