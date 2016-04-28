            <div class="footer_wrapper">
                <footer id="globalfooter" class="footer_global container">
                    <ul class="footer_links pull-right">
                        <li><a href="<?php echo site_url('tips') ?>">Tips</a></li>
                        <li><a href="<?php echo site_url('terms') ?>">Terms of Use</a></li>
                        <li><a href="<?php echo site_url('policy') ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo site_url('about') ?>" class="last">About Us</a></li>
                    </ul>
                    <p class="footer_copyright col-md-5 clear">Copyright &copy; 2016 Relayy, Inc</p>
                </footer>
            </div>

            <script src="<?= asset_base_url()?>/libs/jquery.min.js" type="text/javascript"></script>
            <script src="<?= asset_base_url()?>/libs/bootstrap.min.js" type="text/javascript"></script>

            <script src="<?= asset_base_url()?>/libs/quickblox.min.js"></script>
            <script src="<?= asset_base_url()?>/js/config.js"></script>
            <script src="<?= asset_base_url()?>/js/page_home.js"></script>
            
            <script>
                function startChat() {
                  window.location.href = "<?= site_url('chat')?>";
                }
            </script>

<?php       if (isset($js_home) && $js_home == 2) { ?>
            <script>
              $("#loginForm").modal("show")
            </script>
<?php       }
        
        if ($body_class == 'invite-page') {
?>
<script>    
$("#invite_accept").click(function(){
    var email = $("#usr_reg_n_lgn").val();
    
     var filters = {filter: { field: 'email', param: 'eq', value: email }};
      QB.users.listUsers(filters, function(err, result){
        if (result && result.items.length> 0) {
          console.log("----------------linkedin register: old user");
          var user = result.items[0];
          $("#user_uid").val(user.id);
          $("#register_form").submit();
        } else if (result && result.items.length == 0) {
          console.log("----------------linkedin register: new user");
            var params = { 'login': email, 'password': QBApp.authKey, 'email': email };
            QB.users.create(params, function(err, user){
                if (user) {
                  $("#user_uid").val(user.id);
                  $("#register_form").submit();
                } else  {
                  alert(JSON.stringify(err));
                }
            }); 
        } else {
          console.log(result);
        }
      });
})
</script>
<?php
        }
?>
    </body>
</html>