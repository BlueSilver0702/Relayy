<div class="user-manage">

	<div class="input-group" style="position:absolute;right:30px;width:350px;">
      <input id="invite_txt" type="text" class="form-control" placeholder="Email to invite">
      <div class="input-group-btn">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-send" aria-hidden="true"></span>&nbsp;&nbsp;Invite as <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a onclick="sendInvite(1)">Admin</a></li>
          <li><a onclick="sendInvite(2)">Advisor</a></li>
          <li><a onclick="sendInvite(3)">Startup</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->

	<ul class="nav nav-tabs">
	  <li <?php echo $page==0?'class="active"':''?>>
	    <a href="<?= site_url('users')?>">All</a>
	  </li>
	  <li <?php echo $page==1?'class="active"':''?>><a href="<?= site_url('users')?>/pending">Pending (Waiting for Approve)</a></li>
	  <li <?php echo $page==2?'class="active"':''?>><a href="<?= site_url('users')?>/activated">Activated</a></li>
	  <li <?php echo $page==3?'class="active"':''?>><a href="<?= site_url('users')?>/invited">Invited</a></li>
	</ul>

	<div class="user-content">
<?php 
	foreach ($users as $user) {
		if ($user['uid'] == $current) continue;

		if ($user['status'] != 0 && $page == 1) continue;
		if ($user['status'] != 1 && $page == 2) continue;
		if ($user['status'] != 2 && $page == 3) continue;

		if ($user['type'] == 1) $utype = "Admin";
		if ($user['type'] == 2) $utype = "Advisor";
		if ($user['type'] == 3) $utype = "Startup";
        
        $username = '';
        if ($user['fname'].$user['lname']) $username = $user['fname']." ".$user['lname'];
        else {
            $str_arr = explode("@", $user['email']);
            $username = $str_arr[0];
        }
		?>
	  <div class="row">
	  	<div class="col-sm-1"><img src="<?= strlen($user['photo'])>0?$user['photo']:asset_base_url().'/images/emp-sm.jpg'?>" width="38"></div>
	    <div class="col-sm-2"><span><?= $username?></span></div>
	    <div class="col-sm-3"><a href="<?= site_url('profile/user/'.$user['id'])?>"><?= $user['email']?></a></div>
	    <div class="col-sm-2"><span><?= $utype?></span></div>

<?php if ($user['status'] == 0) {?>
	    <div class="col-sm-1 col-sm-offset-1"><span class="text-warning">Pending</span></div>
	    <div class="col-sm-1"><a class="btn btn-success btn-sm" href="<?= site_url('users')?>/action/<?= $user['id']."/".$page?>">Active</a></div>
<?php } else if ($user['status'] == 1) {?>
		<div class="col-sm-1 col-sm-offset-1"><span class="text-success">Activated</span></div>
	    <div class="col-sm-1"><a class="btn btn-warning btn-sm" href="<?= site_url('users')?>/action/<?= $user['id']."/".$page?>">Deactive</a></div>
<?php } else if ($user['status'] == 2) {?>
		<div class="col-sm-1 col-sm-offset-1"><span class="text-primary">Invited</span></div>
	    <div class="col-sm-1"><a class="btn btn-primary btn-sm" href="#" disabled="disabled">Invite</a></div>
<?php }?>
		<div class="col-sm-1"><a class="btn btn-danger btn-sm" onclick="delAction(this, '<?= $user['email']?>')" data-act="<?= site_url('users')?>/delete/<?= $user['id']."/".$page?>">Delete</a></div>
	  </div>
<?php		
	}
?>
	  
	</div>
</div>