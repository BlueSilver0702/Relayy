<div class="user-profile">
  <div class="notification-settings">

    <h4>Notifications</h4>


    <div class="setting-block">

      <span>In-App Notifications</span>

      <div class="pull-right fancy-toggle">
		  <input type="checkbox">
		  <span >
		    <i class="on gmicon-switch-on"></i>
		    <i class="off gmicon-switch-off"></i>
		  </span>
		</div>

      <p class="help-text text-muted">Display popup notifications in the browser when GroupMe is the active tab</p>

    </div>


    <div class="setting-block">

      <span>Receive Messages via SMS</span>

      <div class="pull-right fancy-toggle">
	  <input type="checkbox">
	  <span>
	    <i class="on gmicon-switch-on"></i>
	    <i class="off gmicon-switch-off"></i>
	  </span>
	</div>

    </div>

    <div class="setting-block">

      <span>Multichat</span>

      <div class="pull-right fancy-toggle">
		  <input type="checkbox">
		  <span>
		    <i class="on gmicon-switch-on"></i>
		    <i class="off gmicon-switch-off"></i>
		  </span>
		</div>

      <p class="help-text text-muted">When browser width allows for it, display up to 3 chats at a time.</p>

    </div>

    <div class="setting-block">
      <p class="help-text text-muted">
        <span>By default, when you're active on the web, we will avoid sending you notifications to your device(s).</span>
        <strong>You can disable that feature here.</strong>

        <br><br>

        <em>Note: Your device notification settings are always respected. If you have notifications turned off on a device, you will continue to not recieve notifications, irrespective of your settings here.</em>

      </p>

      <div class="web-pings">

        <span>Don't send notifications to phone when web is active</span>

        <div class="pull-right fancy-toggle">
		  <input type="checkbox">
		  <span>
		    <i class="on gmicon-switch-on"></i>
		    <i class="off gmicon-switch-off"></i>
		  </span>
		</div>

      </div>
    </div>

  </div>

  <div class="company-links text-center">
    <a href="<?php echo site_url('tips')?>" target="_blank">Tips</a>
    <a href="<?php echo site_url('terms')?>" target="_blank">Terms of Use</a>
    <a href="<?php echo site_url('policy')?>" target="_blank">Privacy Policy</a>
    <a href="<?php echo site_url('about')?>" target="_blank">About Us</a>
  </div>

  <div class="logout text-center">
    <a class="btn btn-danger" href="<?php echo site_url('auth/logout')?>">Log out</a>
  </div>

</div>