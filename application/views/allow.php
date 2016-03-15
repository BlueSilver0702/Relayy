<div class="user-manage">
  <!-- <div class=""> -->
	<ul class="nav nav-tabs">
	  <li <?php echo $page==0?'class="active"':''?>>
	    <a href="<?= site_url('allow')?>">All</a>
	  </li>
	  <li <?php echo $page==1?'class="active"':''?>><a href="<?= site_url('allow/pending')?>">Deactivated</a></li>
	  <li <?php echo $page==2?'class="active"':''?>><a href="<?= site_url('allow/activated')?>">Activated</a></li>
	</ul>

	<div class="user-content">

	  
	</div>
  <!-- </div> -->
</div>