<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <title><?php if(isset($page_title)) echo $page_title; ?></title>
      <link rel="shortcut icon" href="<?= asset_base_url()?>/images/favicon.png">
      <!--reset styles-->
      <link rel="stylesheet" href="<?= asset_base_url()?>/libs/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/chat.css" type="text/css">
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/bootstrap-dialog.min.css" type="text/css">
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/main.css" type="text/css">

<?php 
    if (isset($profile_js)) {?>
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/jquery.fileupload.css" type="text/css">
<?php  }
?>
   </head>
   <body class="<?php if(isset($body_class)) echo $body_class; ?>">
      <div id="header">
        <img src="<?= asset_base_url()?>/images/logo-inverse.png">
        <div id="user-info" class="pull-right">
          <a href="<?php echo site_url('profile')?>" title="Chat"><img src="<?= strlen($u_photo)>0?$u_photo:asset_base_url().'/images/emp-sm.jpg'?>" width="30"><?= isset($u_name)?$u_name:'' ?></a>
        </div>
        <form class="pull-right search" method="post" action="<?php echo site_url('search')?>">
          <span class="glyphicon glyphicon-search"></span>
          <input type="text" placeholder="search contact" class="search-box" name="search">
        </form>
        <div id="icon-list" class="pull-right">
<?php if ($u_status < 2) {?>
          <a class="menu-chat <?= $body_class=='chat-page'?'current':''?>" href="<?php echo site_url('chat')?>" title="Chat Room"><span class="glyphicon glyphicon-comment"></span></a>
<?php }
      if ($u_type == 1 && $u_status < 2) { ?>
          <a class="menu-invite <?= $body_class=='invite-page'?'current':''?>" href="<?php echo site_url('invite')?>" title="Invite Management"><span class="glyphicon glyphicon-send"></span></a>
          <a class="menu-users <?= $body_class=='users-page'?'current':''?>" href="<?php echo site_url('users')?>" title="User Management"><span class="glyphicon glyphicon-user"></span></a>
          <a class="menu-allow <?= $body_class=='allow-page'?'current':''?>" href="<?php echo site_url('allow')?>" title="Chat Management"><span class="glyphicon glyphicon-flag"></span></a>
<?php }?>
          <a class="menu-setting <?= $body_class=='setting-page'?'current':''?>" href="<?php echo site_url('setting')?>" title="Settings"><span class="glyphicon glyphicon-cog"></span></a>
          <a class="menu-logoff" href="<?php echo site_url('auth/logout')?>" title="Sign Out"><span class="glyphicon glyphicon-off"></span></a>
        </div>
      </div>
      <div id="content-wrapper">