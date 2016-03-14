<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <title><?php if(isset($page_title)) echo $page_title; ?></title>
      <link rel="shortcut icon" href="<?= asset_base_url()?>/images/favicon.ico">
      <!--reset styles-->
      <link rel="stylesheet" href="<?= asset_base_url()?>/libs/bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="<?= asset_base_url()?>/css/chat.css" type="text/css">
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
          <a class="menu-chat" href="<?php echo site_url('chat')?>" title="Chat"><span class="glyphicon glyphicon-comment"></span></a>
<?php if ($u_type == 1) { ?>
          <a class="menu-users" href="<?php echo site_url('users')?>" title="User Management"><span class="glyphicon glyphicon-user"></span></a>
<?php }?>
          <a class="menu-setting" href="<?php echo site_url('setting')?>" title="Settings"><span class="glyphicon glyphicon-cog"></span></a>
        </div>
      </div>
      <div id="content-wrapper">