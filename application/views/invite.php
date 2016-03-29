<div id="main" class="main">
    <div class="section_wrapper container">
        <div class="text_hero">
            <p class="hi_logo"></p>
            <h6 class="hi_tit">Talk business, build business relationships.</h6>
            <p class="hi_icos"></p>
            <form class="form-horizontal" method="post" action="<?php echo site_url('invite/accept') ?>" id="register_form">
              <input type="hidden" name="reg_id" value="<?= $current_id?>" id="user_id">
              <input type="hidden" name="reg_uid" value="" id="user_uid">
              <input type="hidden" name="reg_did" value="<?= $current_did?>" id="user_did">
              <div class="form-group">
                <label class="col-sm-4 control-label">User Role:</label>
                <div class="col-sm-6 selectContainer">
                  <select class="form-control" id="user_role" disabled="disabled">
<?php 
if ($current_type == 1) {
	echo '<option selected>Admin</option>';
} else if ($current_type == 2) {
	echo '<option selected>Advisor</option>';
} else {
	echo '<option selected>Startups & Expert</option>';
}
?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_lgn">Login Email:</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" id="usr_reg_n_lgn" value="<?= $current_email?>" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="usr_reg_n_pwd">Password:</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="reg_pwd" id="usr_reg_n_pwd" placeholder="Enter password" required="true">
                </div>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <div class="col-sm-offset-4 col-sm-6">
                  <input type="button" id="invite_accept" class="btn btn-primary btn-block" value="Register">
                </div>
              </div>
            </form>
        </div>
    </div>
</div>