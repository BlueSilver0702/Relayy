
        </div>
            <script src="<?php echo asset_base_url()?>/libs/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/jquery.nicescroll.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/jquery.timeago.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/bootstrap.min.js" type="text/javascript"></script>

            <script src="<?php echo asset_base_url()?>/libs/quickblox.min.js"></script>
            <script src="<?php echo asset_base_url()?>/js/config.js"></script>

            <script>
            var QBUser = {
                    id: <?php if (isset($u_id)) echo $u_id?>,
                    name: '<?php if (isset($u_name)) echo $u_name?>',
                    login: '<?php if (isset($u_login)) echo $u_login?>',
                    pass: '<?php if (isset($u_password)) echo $u_password?>'
                };
            var site_url = '<?= site_url()?>';
            var DialogID = '<?php if (isset($d_id)) echo $d_id?>';
            var DialogJID = '<?php if (isset($d_jid)) echo $d_jid?>';

            var DialogUIDS = <?php if (isset($d_occupants)) echo str_replace(array('\"', '"'), "", json_encode($d_occupants))?>;
            </script>

            <script src="<?php echo asset_base_url()?>/js/connection.js"></script>
            <script src="<?php echo asset_base_url()?>/js/messages.js"></script>
            <script src="<?php echo asset_base_url()?>/js/ui_helpers.js"></script>
            <script src="<?php echo asset_base_url()?>/js/dialogs.js"></script>
            <script src="<?php echo asset_base_url()?>/js/users.js"></script>
    </body>
</html>
