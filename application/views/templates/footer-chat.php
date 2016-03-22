
        </div>
            <script src="<?php echo asset_base_url()?>/libs/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/jquery.nicescroll.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/jquery.timeago.min.js" type="text/javascript"></script>
            <script src="<?php echo asset_base_url()?>/libs/bootstrap.min.js" type="text/javascript"></script>

            <script src="<?php echo asset_base_url()?>/libs/quickblox.min.js"></script>
            <script src="<?php echo asset_base_url()?>/js/bootstrap-dialog.min.js" type="text/javascript"></script>
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

            var DialogUIDS = <?php 
            if (isset($d_occupants) && count($d_occupants)) echo str_replace(array('\"', '"'), "", json_encode($d_occupants));
            else echo "[]";?>;
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
if ($body_class == "users-page") {?>
<script>
function delAction(obj, email) {
    var delObj = $(obj);
    
    BootstrapDialog.confirm({
        title: 'Confirm',
        message: 'Are you sure to delete this user: '+email+' ?',
        type: BootstrapDialog.TYPE_DANGER,
        closable: true,
        draggable: true,
        btnCancelLabel: 'Cancel',
        btnOKLabel: 'Delete',
        btnOKClass: 'btn-danger',
        callback: function(result) {
            if(result) {
                location.href = delObj.data("act");
            }
        }
    });
}

function sendInvite(userType) {
    var sendEmail = $("#invite_txt").val();
    if (sendEmail == '') {
        BootstrapDialog.alert({
            title: 'WARNING',
            message: 'Please input email address to send!',
            type: BootstrapDialog.TYPE_WARNING,
            closable: true,
            draggable: true,
            buttonLabel: 'Cancel'
        });
        return;     
    }
    var roleTxt = "";
    if (userType == 1) roleTxt = "Admin";
    else if (userType == 2) roleTxt = "Advisor";
    else if (userType == 3) roleTxt = "Startup";

    BootstrapDialog.show({
        title: 'You send invite!',
        message: 'Are you sure to send invite email: '+sendEmail+' as '+roleTxt+' ?',
        type: BootstrapDialog.TYPE_INFO,
        buttons: [{
            icon: 'glyphicon glyphicon-send',
            label: ' Send Invite',
            cssClass: 'btn-info',
            autospin: true,
            action: function(dialogRef){
                dialogRef.enableButtons(false);
                dialogRef.setClosable(false);
                $("#invite_txt").val('');

                var params = { 'login': sendEmail, 'password': 'password_relayy', 'email': sendEmail };
                QB.users.create(params, function(err, user){
                  console.log("new user: "+ user);
                  if (user) {
                    location.href = site_url + "users/invite/"+ userType + "/" + encodeURIComponent(sendEmail) + "/"+ user.id + "/<?php echo isset($page)?$page:'0';?>";  
                  } else  {
                    BootstrapDialog.alert({
                        title: 'Error',
                        message: JSON.stringify(err),
                        type: BootstrapDialog.TYPE_DANGER,
                        closable: true,
                        draggable: true,
                        buttonLabel: 'Cancel'
                    });

                  }
                });
            }
        }, {
            label: 'Cancel',
            action: function(dialogRef){
                dialogRef.close();
            }
        }]
    });
}

</script>
<?php 
} else if ($body_class == "allow-page") {?>
<script>
function delAction(obj, did, dname) {
    var delObj = $(obj);
    
    BootstrapDialog.confirm({
        title: 'Confirm',
        message: 'Are you sure to delete this chat room: '+dname+' ?',
        type: BootstrapDialog.TYPE_DANGER,
        closable: true,
        draggable: true,
        btnCancelLabel: 'Cancel',
        btnOKLabel: 'Delete',
        btnOKClass: 'btn-danger',
        callback: function(result) {
            if(result) {
                location.href = delObj.data("act");
            }
        }
    });
}

function createChat(type) {
    var title = "Create New ";
    if (type == 1) title += "1:1 Chat";
    else title += "WorkGroup";
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_PRIMARY,
        title: title,
        message: 'What to do next?',
        buttons: [{
            label: 'Cancel',
            action: function(dialogRef){
                dialogRef.close();
            }
        }, {
            label: 'Create Chat',
            cssClass: 'btn-primary',
            action: function(){
                // You can also use BootstrapDialog.closeAll() to close all dialogs.
                $.each(BootstrapDialog.dialogs, function(id, dialog){
                    dialog.close();
                });
            }
        }]
    });  
}
</script>
<?php }
?>
    </body>
</html>
