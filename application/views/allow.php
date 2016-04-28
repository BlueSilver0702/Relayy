<div class="user-manage">

	<div class="btn-group" style="position:absolute;right:30px;width:350px;">
        <button type="button" class="btn btn-info dropdown-toggle pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Create Chat <span class="caret"></span></button>
		<ul class="dropdown-menu dropdown-menu-right">
          <li><a onclick="createChat(1)">1:1 Chat</a></li>
          <li><a onclick="createChat(2)">Group Chat</a></li>
        </ul>
    </div>

	<ul class="nav nav-tabs">
	  <li <?php echo $page==0?'class="active"':''?>>
	    <a href="<?= site_url('allow')?>">All</a>
	  </li>
	  <li <?php echo $page==1?'class="active"':''?>><a href="<?= site_url('allow')?>/pending">Pending</a></li>
	  <li <?php echo $page==2?'class="active"':''?>><a href="<?= site_url('allow')?>/activated">Activated</a></li>
	</ul>

	<div class="user-content">
<?php
	foreach ($chats as $chat) {

		if ($chat['type'] == CHAT_TYPE_WELCOME) continue;
		if ($chat['status'] != 0 && $page == 1) continue;
		if ($chat['status'] != 1 && $page == 2) continue;

		$emails = json_encode($chat['emails']);
?>
	  <div class="row">
	  	<div class="col-sm-1"><img src="<?= $chat['type']==CHAT_TYPE_PRIVATE?asset_base_url().'/images/ava-single.svg':asset_base_url().'/images/ava-group.svg'?>" width="38"></div>
	    <div class="col-sm-2"><span><?= $chat['name']?></span></div>
	    <div class="col-sm-5"><a href="<?= site_url('chat/channel_admin/'.$chat['did'])?>"><?= str_replace(array("[","]","\""), "", $emails)?></a></div>
	    <div class="col-sm-1"><span><?= $chat['type']==CHAT_TYPE_PRIVATE?'1:1 Chat':'Group'?></span></div>

<?php if ($chat['status'] == 0) {?>
	    <div class="col-sm-1"><span class="text-warning">Pending</span></div>
	    <div class="col-sm-1"><a class="btn btn-success btn-sm" href="<?= site_url('allow')?>/action/<?= $chat['did']."/".$page?>">Active</a></div>
<?php } else if ($chat['status'] == 1) {?>
		<div class="col-sm-1"><span class="text-success">Activated</span></div>
	    <div class="col-sm-1"><a class="btn btn-warning btn-sm" href="<?= site_url('allow')?>/action/<?= $chat['did']."/".$page?>">Deactive</a></div>
<?php }?>
		<div class="col-sm-1"><a class="btn btn-danger btn-sm" onclick="delAction(this, '<?= $chat['did']?>', '<?= $chat['name']?>')" data-act="<?= site_url('allow')?>/delete/<?= $chat['did']."/".$page?>">Delete</a></div>
	  </div>
<?php		
	}
?>
	  
	</div>
</div>