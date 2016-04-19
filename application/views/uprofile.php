<div class="user-profile">

  <div class="avatar text-center">

    <div class="upload-image user-type">

  <div class="image-wrap text-center">
    <img class="img-responsive" src="<?= strlen($photo)>0?$photo:asset_base_url().'/images/emp.jpg'?>" width="100">

  </div>

</div>

  </div>

  <div class="account-info">
    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">First Name:</div>
      <div class="col-xs-6 ng-binding">
        <?= $fname?>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">Last Name:</div>
      <div class="col-xs-6 ng-binding">
        <?= $lname?>
      </div>
    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Email:</div>
      <div class="col-xs-6">
        <?= $email?>
      </div>
    </div>
    
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Bio:</div>

      <div class="col-xs-6">
        <?= $bio?>
      </div>
    </div>
  </div>

  <?php if ($editable) {?>
  <div class="misc text-center">
    <a href="<?php echo site_url('profile/useredit/'.$id)?>" class="btn btn-secondary text-danger">Edit User</a>
  </div>
  <?php }?>
  <div class="social">
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">
        User Role:
      </div>

      <div class="col-xs-6">
<?php
  if ($type == 1) echo "Admin";
  else if ($type == 2) echo "Advisor";
  else echo "Startup";
?>
      </div>

    </div>
  </div>

</div>