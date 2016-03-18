<div class="user-profile">
  <form method="post" action="<?= site_url('setting/save')?>">
    <div class="notification-settings">

      <h4>Notifications</h4>

      <div class="setting-block">

        <span>Instant Notifications</span>

        <div class="pull-right fancy-toggle">
  		  <input type="radio" name="setvalue" value="0" <?= $setval==0?'checked':''?>>
  		  <span >
  		    <i class="on gmicon-switch-on"></i>
  		    <i class="off gmicon-switch-off"></i>
  		  </span>
  		</div>

        <p class="help-text text-muted">Send email immediatly whenever you receive message.</p>

      </div>


      <div class="setting-block">

        <span>Notify Once An Hour</span>

        <div class="pull-right fancy-toggle">
  	  <input type="radio" name="setvalue" value="1" <?= $setval==1?'checked':''?>>
  	  <span>
  	    <i class="on gmicon-switch-on"></i>
  	    <i class="off gmicon-switch-off"></i>
  	  </span>
  	</div>

        <p class="help-text text-muted">Send email hourly whenever you receive message.</p>

      </div>

      <div class="setting-block">

        <span>Notify Once A Day</span>

        <div class="pull-right fancy-toggle">
  		  <input type="radio" name="setvalue" value="2" <?= $setval==2?'checked':''?>>
  		  <span>
  		    <i class="on gmicon-switch-on"></i>
  		    <i class="off gmicon-switch-off"></i>
  		  </span>
  		</div>

        <p class="help-text text-muted">Send email daily if you have unread message.</p>

      </div>

      <div class="setting-block">

        <span>Turn off Email Notifications</span>

        <div class="pull-right fancy-toggle">
        <input type="radio" name="setvalue" value="3" <?= $setval==3?'checked':''?>>
        <span>
          <i class="on gmicon-switch-on"></i>
          <i class="off gmicon-switch-off"></i>
        </span>
      </div>

        <p class="help-text text-muted">Unsubscribe all emails from Relayy</p>

      </div>
      

    </div>

    <div class="company-links text-center">
      <a href="<?php echo site_url('tips')?>" target="_blank">Tips</a>
      <a href="<?php echo site_url('terms')?>" target="_blank">Terms of Use</a>
      <a href="<?php echo site_url('policy')?>" target="_blank">Privacy Policy</a>
      <a href="<?php echo site_url('about')?>" target="_blank">About Us</a>
    </div>

    <div class="logout text-center">
      <input type="submit" class="btn btn-primary" value="Save">
    </div>
  </form>
</div>