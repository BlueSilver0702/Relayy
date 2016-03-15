<div class="pull-left" id="l-side">
  <!-- <div class="col-md-12"> -->
    <div class="list-title">
      <h4>
        <span>Chats on Relayy</span>
      </h4>
    </div>
    <div class="list-search">
      <input type="text" placeholder="Search chats" class="">
      <span class="icon-search glyphicon glyphicon-search"></span>
      <i class="gmicon-close glyphicon glyphicon-remove"></i>
    </div>
    <div class="list-group nice-scroll" id="dialogs-list" tabindex="0" style="overflow: hidden; outline: none;">
<?php 
    if (isset($history)) {
        foreach ($history as $dialog) {
    ?>
        <a href="<?= isset($d_current)?'#':site_url('chat/channel/'.$dialog['did']) ?>" class="list-group-item <?php echo $dialog['did'] == $d_id && isset($d_current)?"active":"inactive"; ?>" id="<?= $dialog['did']?>" onclick="triggerDialog('<?= $dialog['did']?>', 1)">
            <span class="badge" style="display: none;">0</span>
            <h5 class="list-group-item-heading">
<?php 
    if ($dialog['type'] == 1) {?>
                <img src="<?= asset_base_url()?>/images/ava-single.svg" width="30" height="30" class="round">&nbsp;&nbsp;&nbsp;<span><strong><?= $dialog['name']?></strong></span>
    <?php } else {?>
                <img src="<?= asset_base_url()?>/images/ava-group.svg" width="30" height="30" class="round">&nbsp;&nbsp;&nbsp;<span><strong><?= $dialog['name']?></strong></span>
    <?php }?>
            </h5>
            <p class="list-group-item-text last-message"><?= $dialog['message']?></p>
        </a>
    <?php                
              }      
    }
?>
    </div>
  <!-- </div> -->
</div>