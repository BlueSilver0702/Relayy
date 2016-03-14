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
<?php   if(isset($js_home)) {
            echo '<script src="'.asset_base_url().'/libs/jquery.min.js" type="text/javascript"></script>
                  <script src="'.asset_base_url().'/libs/bootstrap.min.js" type="text/javascript"></script>';

            echo '<script src="'.asset_base_url().'/libs/quickblox.min.js"></script>';
            echo '<script src="'.asset_base_url().'/js/config.js"></script>';
            echo '<script src="'.asset_base_url().'/js/page_home.js"></script>';
            echo '
                <script>
                    function startChat() {
                      window.location.href = "'.site_url('chat').'";
                    }
                </script>
            ';

            if ($js_home == 2) {
              echo '
                <script>
                  $("#loginForm").modal("show")
                </script>
              ';
            }
        }
?>
    </body>
</html>