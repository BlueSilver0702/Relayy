<div class="user-manage">

    <div class="user-content">
<?php 
    foreach ($users as $user) {
        if ($user['uid'] == $current) continue;

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

        <div class="col-sm-1"><a class="btn btn-info btn-sm" onclick="searchChat(this, '<?= $user['id']?>')">1:1 Chat</a></div>
      </div>
<?php        
    }
?>
      
    </div>
</div>