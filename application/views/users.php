<div class="user-manage">
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
		?>
	  <div class="row">
	  	<div class="col-sm-1"><img src="<?= strlen($user['photo'])>0?$user['photo']:asset_base_url().'/images/emp-sm.jpg'?>" width="38"></div>
	    <div class="col-sm-2"><span><?= $user['fname']." ".$user['lname']?></span></div>
	    <div class="col-sm-3"><span><?= $user['email']?></span></div>
	    <div class="col-sm-1"><span><?= $utype?></span></div>

<?php if ($user['status'] == 0) {?>
	    <div class="col-sm-1 col-sm-offset-1"><span class="text-warning">Pending</span></div>
	    <div class="col-sm-1"><a class="btn btn-success" href="<?= site_url('users')?>/action/<?= $user['uid']."/".$page?>">Active</a></div>
<?php } else if ($user['status'] == 1) {?>
		<div class="col-sm-1 col-sm-offset-1"><span class="text-success">Activated</span></div>
	    <div class="col-sm-1"><a class="btn btn-warning" href="<?= site_url('users')?>/action/<?= $user['uid']."/".$page?>">Deactive</a></div>
<?php } else if ($user['status'] == 2) {?>
		<div class="col-sm-1 col-sm-offset-1"><span class="text-primary">Invited</span></div>
	    <div class="col-sm-1"><a class="btn btn-primary" href="<?= site_url('users')?>/action/<?= $user['uid']."/".$page?>">Invite</a></div>
<?php }?>
		<div class="col-sm-1 col-sm-offset-1"><a class="btn btn-danger" href="<?= site_url('users')?>/delete/<?= $user['uid']?>">Delete</a></div>
	  </div>
<?php		
	}
?>
	  
	</div>
</div>