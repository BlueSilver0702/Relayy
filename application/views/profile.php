<div class="user-profile">

  <div class="avatar text-center">

    <div class="upload-image user-type">

  <div class="image-wrap text-center">
    <img class="img-responsive" src="<?= strlen($u_photo)>0?$u_photo:asset_base_url().'/images/emp.jpg'?>">

  </div>

</div>

  </div>

  <div class="account-info">
    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">Full Name:</div>
      <div class="col-xs-6 ng-binding">
        <?= $u_name?>
      </div>
    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Email:</div>
      <div class="col-xs-6">
        <?= $u_email?>
      </div>
    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Password:</div>
      <div class="col-xs-6">
        <?php 
          for ($i=0; $i<strlen($u_password); $i++) {
            echo "*";
          }
        ?>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Phone:</div>

      <div class="col-xs-6">
        <?= $u_phone?>
      </div>
    </div>
  </div>

  <div class="misc text-center">
    <a href="<?php echo site_url('profile/edit')?>" class="btn btn-secondary">Edit Profile</a>
  </div>

  <div class="social">
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">
        Facebook:
      </div>

      <div class="col-xs-6">
        <?= $u_facebook?>
      </div>

    </div>
  </div>

</div>