<div class="pull-right" id="r-side">
  <div class="col-md-12 owner" id="information">
    <div id="information_holder">
	    <h4>
	      <span class=""><?= $d_name?></span>
	    </h4>

	    <h5 class="text-muted">Created by <?= $d_owner?></h5>
	    <div class="information_actions">
<?php if ($d_noti == 10) {?>	    
	      <a id="chat-noti" class="icon-noti-off text-muted" onclick="notifyAction('<?= $d_id?>')">
	        Notifications 
	        <span class="">
	          OFF
	        </span>
	      </a>
<?php } else {?>
		  <a id="chat-noti" class="icon-noti-on text-muted" onclick="notifyAction('<?= $d_id?>')">
	        Notifications 
	        <span class="">
	          ON
	        </span>
	      </a>
<?php }?>	     
	      
<?php if ($d_owner == "Me") {?>
	      <a class="" onclick="deleteAction('<?= $d_id?>')">
		      <span class="text-danger">Delete</span>
		  </a>
<?php } else {?>		  
		  <a class="" onclick="leaveAction('<?= $d_id?>')">
	        <span class="text-warning">Leave</span>
	      </a>
<?php }?>
	    </div>

	    <div class="information_members">
	      <h5 class="">
	        <?= count($d_occupants);?> Members
<?php if ($d_owner == "Me" && $d_type == 2) {?>
	        <a class="" onclick="showDialogInfoPopup()">+ Add Members</a>
<?php }?>
	      </h5>
	      
	      <ul>
<?php   foreach ($d_users as $user) {
$username = '';
if ($user['fname']) $username = $user['fname'];
else {
    $str_arr = explode("@", $user['email']);
    $username = $str_arr[0];
}
?>
			<li class="" id="remove-<?= $user['id']?>">
	          <a class="" href="<?= site_url("profile/user/".$user['id'])?>">
	            <img class="avatar avatar_small" src="<?= strlen($user['photo'])>0?$user['photo']:asset_base_url().'/images/emp-sm.jpg'?>">
<?= $username ?>
	          </a>
<?php if ($d_owner == "Me") {?>
	          <a class="information_remove_user" onclick="removeAction('<?= $d_id?>', '<?= $user['id']?>', '<?= $username?>')"></a>
<?php }?>
	          <span class="">
	            <lastseen data-user-id="4513703"><span class="lastseen">offline</span></lastseen>
	          </span>
	        </li>
<?php	}?>
	      </ul>

	    </div>
	  </div>
    
    </div>
  </div>
</div>