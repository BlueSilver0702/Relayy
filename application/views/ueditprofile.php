<div class="user-profile">

  <form method="post" action="<?php echo site_url('profile/saveuser')?>">
  <input type="hidden" name="uid" value="<?= $uid?>">
  <div class="avatar text-center">

    <div class="upload-image user-type">

  <div class="image-wrap text-center">
    <img id="user_pic" class="img-responsive" src="<?= strlen($photo)>0?$photo:asset_base_url().'/images/emp.jpg'?>" width="100">

  </div>

</div>

  </div>
  <div class="account-info">
    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">First Name:</div>
      <div class="col-xs-5">
        <input type="text" name="fname" class="form-control" placeholder="First Name"  value="<?= $fname?>" autocomplete="off"/>
      </div>

    </div>

    <div class="row">
      <div class="col-xs-2 col-xs-offset-3">Last Name:</div>
      <div class="col-xs-5">
        <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?= $lname?>" autocomplete="off"/>
      </div>
    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Email:</div>

      <div class="col-xs-5">
        <input type="email" class="form-control" placeholder="Email" required="true" value="<?= $email?>" disabled="disabled"/>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Password:</div>

      <div class="col-xs-5">
        <input type="password" name="password" class="form-control new-password" placeholder="New Password" value="<?= $pwd?>" autocomplete="off"/>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Bio:</div>

      <div class="col-xs-5">
        <textarea name="bio" class="form-control"><?= $bio?></textarea>
      </div>

    </div>

    <div class="row">

      <div class="col-xs-2 col-xs-offset-3">Type:</div>

      <div class="col-xs-5">
        <select class="form-control" name="reg_role" id="user_role">
          <option value="">Choose a role</option>
          <option value="1" <?= $type==1?'selected':''?>>Admin</option>
          <option value="2" <?= $type==2?'selected':''?>>Advisor</option>
          <option value="3" <?= $type==3?'selected':''?>>Startups & Expert</option>
        </select>
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
  </form>
</div>

