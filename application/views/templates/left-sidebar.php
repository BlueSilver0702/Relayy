<div class="pull-left" id="l-side">
    <!-- <div class="col-md-12"> -->
    <div class="list-title">
      <h4>
        <span>Chats on Relayy</span>
      </h4>
    </div>
    <div class="list-search">
      <input type="text" placeholder="Search chats" onchange="searchDialogs(this)">
      <span class="icon-search glyphicon glyphicon-search"></span>
      <i class="gmicon-close glyphicon glyphicon-remove" onclick="searchInit()"></i>
    </div>
    <div class="list-group nice-scroll" id="dialogs-list" tabindex="0" style="overflow: hidden; outline: none;">
<?php 
    if (isset($history)) {
        foreach ($history as $dialog) {
    ?>
        <a href="<?= isset($d_current)?'#':site_url('chat/channel/'.$dialog['did']) ?>" class="list-group-item <?php echo $dialog['did'] == $d_id && isset($d_current)?"active":"inactive"; ?>" id="<?= $dialog['did']?>" onclick="triggerDialog('<?= $dialog['did']?>', 1)">
            <span class="pull-right"><?= $dialog[TBL_CHAT_TIME]?></span>
            <span class="badge" style="display: none;">0</span>
            <h5 class="list-group-item-heading"><span><strong class="d_title"><?= $dialog['name']?></strong></span></h5>
            <p class="list-group-item-text last-message text-muted"><?= $dialog['h_message']?></p>
            <div>
<?php 
    foreach ($dialog['d_users'] as $user) {?>
                <img src="<?= $user['photo']?$user['photo']:asset_base_url().'/images/emp-sm.jpg'?>" width="30" height="30" class="round">
<?php }?>            
            </div>
        </a>
    <?php                
              }      
    }
?>
    </div>
  <!-- </div> -->
</div>