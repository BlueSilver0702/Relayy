
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

<?php 
    if (isset($profile_js)) {?>
<script src="<?php echo asset_base_url()?>/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo asset_base_url()?>/js/jquery.iframe-transport.js"></script>
<script src="<?php echo asset_base_url()?>/js/jquery.fileupload.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?= site_url("profile/upload")?>';
    $('#img-file').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                console.log("###################");
                // thumbnailUrl
                console.log(file);
                $("#user_pic").attr("src", file.thumbnailUrl);
                $("#user_pic_info").val(file.thumbnailUrl);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<?php  }
?>
    </body>
</html>
