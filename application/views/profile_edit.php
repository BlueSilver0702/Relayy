

<div class="user-profile">

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
      <div class="col-xs-2 col-xs-offset-3">Full Name:</div>

      <div class="col-xs-5">
        <input type="text" name="fname" class="form-control" placeholder="Full Name" required="true" value="<?= $u_name?>">
      </div>

    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Email:</div>

      <div class="col-xs-5">
        <input type="email" class="form-control" placeholder="Email" required="true" value="<?= $u_email?>" disabled="disabled">
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Password:</div>

      <div class="col-xs-5">
        <input type="password" name="password" class="form-control new-password" placeholder="New Password" required="true" value="<?= $u_password?>">
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Phone:</div>

      <div class="col-xs-5">
        <input type="phone" name="phone" class="form-control" placeholder="Phone Number" required="true" value="<?= $u_phone?>">
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

