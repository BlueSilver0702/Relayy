<div class="user-profile" <?php if ($u_status != 1) echo 'style="margin-top:78px;"';?>>

<?php 
  if ($u_status == 2) {?>
  <div class="alert alert-info">
    <strong>Congratulations!</strong><br> You've been registered and activated automatically. Please fill your profile details.
  </div>
<?php } else if ($u_status != 1) {?>
  <div class="alert alert-warning">
    <strong>Sorry!</strong> Your account is not approved by admin. Please wait for admin's action.
  </div>
<?php }
?>

  <form method="post" action="<?php echo site_url('profile/save')?>">

  <div class="avatar text-center">

    <div class="upload-image user-type">

  <div class="image-wrap text-center">
    <img id="user_pic" class="img-responsive" src="<?= strlen($u_photo)>0?$u_photo:asset_base_url().'/images/emp.jpg'?>" width="100">

    <input id="user_pic_info" type="hidden" name="picture" value="<?= strlen($u_photo)>0?$u_photo:asset_base_url().'/images/emp.jpg'?>">

    <a id="img-upload" href="#" title="Change Profile Image"><span class="glyphicon glyphicon-plus"></span><input id="img-file" type="file" name="files[]" multiple></a>

  </div>

</div>

  </div>
  <div class="account-info">
    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">First Name:</div>
      <div class="col-xs-5">
        <input type="text" name="fname" class="form-control" placeholder="First Name" required="true" value="<?= $u_fname?>" autocomplete="off"/>
      </div>

    </div>

    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">Last Name:</div>
      <div class="col-xs-5">
        <input type="text" name="lname" class="form-control" placeholder="Last Name" required="true" value="<?= $u_lname?>" autocomplete="off"/>
      </div>
    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Email:</div>

      <div class="col-xs-5">
        <input type="email" class="form-control" placeholder="Email" required="true" value="<?= $u_email?>" disabled="disabled"/>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Password:</div>

      <div class="col-xs-5">
        <input type="password" name="password" class="form-control new-password" placeholder="New Password" required="true" value="<?= $u_password?>" autocomplete="off"/>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Bio:</div>

      <div class="col-xs-5">
        <textarea name="bio" class="form-control" required="true"><?= $u_bio?></textarea>
      </div>

    </div>
  </div>

  <div class="misc-one text-center">
    <div class="row">

      <div class="col-xs-offset-5 col-xs-3 text-left">
        <input type="submit" class="btn btn-primary" value="Save">
      </div>

    </div>
  </div>

<!-- 

  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" ><span aria-hidden="true">×</span></button>
    
  </div>
  <div class="alert alert-success alert-dismissible" role="alert" ng-show="updateSuccess">
    <button type="button" class="close"><span aria-hidden="true">×</span></button>
    <span>Profile saved successfully.</span></div>
 -->
  </form>
</div>

