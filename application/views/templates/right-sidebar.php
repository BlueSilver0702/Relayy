<div class="pull-right" id="r-side">
  <div class="col-md-12 owner" id="information">
    <div id="information_holder">
	    <h4>
	      <span class=""><?= $d_name?></span>
	    </h4>

	    <h5 class="text-muted">Created by <?= $d_owner?></h5>
	    <div class="information_actions">
	      <a class="icon-noti-on text-muted">
	        Notifications 
	        <span class="">
	          ON
	        </span>
	      </a>
	      <a class="">
	        <span class="text-warning">Leave</span>
	      </a>
<?php if ($d_owner == "Me") {?>
	      <a class="">
		      <span class="text-danger">Delete</span>
		  </a>
<?php }?>
	    </div>

	    <div class="information_members">
	      <h5 class="">
	        <?= count($d_occupants);?> Members
<?php if ($d_owner == "Me") {?>
	        <a class="">+ Add Members</a>
<?php }?>
	      </h5>
	      
	      <ul>
<?php   foreach ($d_users as $user) {?>
			<li class="">
	          <a class="">
	            <img class="avatar avatar_small" src="<?= strlen($user['photo'])>0?$user['photo']:asset_base_url().'/images/emp.jpg'?>">
	            <?= $user['fname']?>
	          </a>
<?php if ($d_owner == "Me") {?>
	          <a class="information_remove_user"></a>
<?php }?>
	          <span class="">
	            <lastseen data-user-id="4513703"><span class="lastseen">offline</span></lastseen>
	          </span>
	        </li>
<?php	}?>
	        
<!-- 	        <li class="">
	          <a class="">
	            <img class="avatar avatar_small" src="<?= asset_base_url()?>/images/emp-sm.jpg">
	            Kevin Yue
	          </a>
	          <a class="information_remove_user"></a>
	          <span class="">
	            <lastseen data-user-id="4537191" class=""><span class="lastseen">online</span></lastseen>
	          </span>
	        </li> -->
	      </ul>

	    </div>
	  </div>
    
    </div>
  </div>
</div>