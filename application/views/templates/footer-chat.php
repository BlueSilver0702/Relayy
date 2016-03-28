
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
                    id: <?php if (isset($u_uid)) echo $u_uid?>,
                    name: '<?php if (isset($u_name)) echo $u_name?>',
                    email: '<?php if (isset($u_login)) echo $u_login?>',
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
                location.href = site_url + "users/invite/"+ userType + "/" + encodeURIComponent(sendEmail) + "/<?php echo isset($page)?$page:'0';?>";  
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
    if (type == 1) {
        title += "1:1 Chat";
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_PRIMARY,
            title: title,
            message: '<div id="channel_edit">'+
                      '<label class="d-label">'+
                        '<span>CHAT WITH</span>'+
                          '<input type="text" placeholder="Search email" onkeypress="handle(event, this, 1)">'+
                      '</label>'+

                      '<ul id="selected">'+
                      '</ul>'+

                      '<ul id="contacts">'+
                      '</ul>'+
                      '</div>',
            buttons: [{
                label: 'Cancel',
                action: function(dialogRef){
                    dialogRef.close();
                }
            }, {
                label: 'Create Chat',
                cssClass: 'btn-primary',
                icon: 'glyphicon glyphicon-send',
                autospin: true,
                action: function(dialogRef){
                  var params = {
                    type: 1,
                    name: "Private"
                  };

//                  QB.chat.dialog.create(params, function(err, createdDialog) {
//                    if (err) {
//                      console.log(err);
//                      alert(err);
//                    } else {
                        var dialogId = "abcd";
                        var occupants = [];
//                                          
                        $.ajax({
                           url: site_url + 'allow/newChat',
                           data: {
                              did: dialogId,
                              jid: "",
                              type: <?= CHAT_TYPE_PRIVATE?>,
                              dname: 'Private',
                              ddesc: '',
                              occupants: occupants.push([$("#selected li").data("email"), $("#selected li").data("uid")])
                           },
                           success: function(data) {
                              if (data == "success")
                                location.reload();
                              else
                                alert(data);
                           },
                           type: 'POST'
                        });
//                    }
//                  });
                }
            }]
        });
        
        getUsers('', function(data) {
          buildUsersHTML(data, '', 1);
        });
    } else {
        title += "WorkGroup";
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_PRIMARY,
            title: title,
            message: '<div id="channel_edit">'+
                     '<label class="d-label">'+
                        '<span>DETAILS</span>'+
                        '<input type="text" placeholder="Workgroup name" id="groupname">'+
                        '<input type="text" placeholder="Tell members the purpose of the workgroup" id="groupdesc" style="border-top: 0">'+
                      '</label>'+
                      '<label class="d-label">'+
                        '<span>ADD TEAM MEMBERS</span>'+
                          '<input type="text" placeholder="Search email" onkeypress="handle(event, this, 2)">'+
                      '</label>'+

                      '<ul id="selected">'+
                      '</ul>'+

                      '<ul id="contacts">'+
                      '</ul>'+
                      '</div>',
            buttons: [{
                label: 'Cancel',
                action: function(dialogRef){
                    dialogRef.close();
                }
            }, {
                label: 'Create Chat',
                cssClass: 'btn-primary',
                icon: 'glyphicon glyphicon-send',
                autospin: true,                
                action: function(dialogRef) {
                  var params = {
                    type: 1,
                    name: $("#groupname").val()
                  };

                  QB.chat.dialog.create(params, function(err, createdDialog) {
                    if (err) {
                      console.log(err);
                      alert(err);
                    } else {
                      var dialogId = createdDialog._id;

                      var occupants = [];
                      $("#selected li").each(function(){
                        occupants.push([$(this).data("email"), $(this).data("uid")]);
                      });
                      
                      $.ajax({
                           url: site_url + 'allow/newChat',
                           data: {
                              did: dialogId,
                              jid: createdDialog.xmpp_room_jid,
                              type: <?= CHAT_TYPE_GROUP?>,
                              dname: $("#groupname").val(),
                              ddesc: $("#groupdesc").val(),
                              occupants: occupants
                           },
                           success: function(data) {
                              if (data == "success")
                                location.reload();
                              else
                                alert(data);
                           },
                           type: 'POST'
                      });
                    }
                  });
                }
            }]
        });

        getUsers('', function(data) {
          buildUsersHTML(data, '', 2);
        });
    }  
}

function handle(e, object, type) {
    var key=e.keyCode || e.which;
    if (key==13){
        //alert(+type);
        var emailStr = $(object).val();
        emailStr = emailStr.trim();
        getUsers(emailStr, function(data) {
          buildUsersHTML(data, emailStr, type);
        });
    }
}

// var chatusers = [];
function getUsers(email, callback) {
    $.ajax({
       url: site_url + 'allow/users',
       data: {
          email: email
       },
       success: function(data) {
          var jsonObj = JSON.parse(data);
          // if (email == '' && chatusers.length == 0) chatusers = jsonObj;
          console.log(jsonObj);
          callback(jsonObj);
       },
       type: 'POST'
    });
}

function buildUsersHTML(json, email, type) {
    $(".modal-open ul#contacts").html("");
    if (json.length == 0 && email) {
        json.push({email:email, fname:"", lname:"", photo:"", uid:""});
    }
    json.forEach(function(item, index) {
        // console.log("#####################");
        // console.log(item);
        var userName = item.fname+' '+item.lname;
        if (userName.trim() == '') {
            var nameArr = item.email.split('@');
            userName = nameArr[0];
        }

        if (!item.id) item.id = '';
        var htmlTxt = '<li onclick="clkSelect(this, '+type+',\''+userName+'\', \''+item.email+'\', \''+item.id+'\')"><span class="glyphicon glyphicon-ok pull-right text-primary" aria-hidden="true"></span>';
        if (item.photo) htmlTxt += '<img class="avatar avatar_small" src="'+item.photo+'">';
        else htmlTxt += '<img class="avatar avatar_small" src="<?= asset_base_url()."/images/emp-sm.jpg"?>">';                        
        htmlTxt = htmlTxt +       '<span class="contacts_name">'+userName+'</span>'+
                        '<span class="contacts_email">'+item.email+'</span>'+
                    '</li>';
        // alert(htmlTxt);
        $("#contacts").append(htmlTxt);
    });
}

function clkSelect(obj, type, uname, email, uid) {
    if (type == 1) {
        $(".selected").removeClass("selected");
        $(obj).addClass('selected');
        var htmlTxt = '<li data-email="'+email+'" data-uid="'+uid+'">'+uname+'<a class="close x" onclick="tagClose(this)">&times;</a></li>';
        $(".modal-open #selected").html(htmlTxt);
    } else {
        if ($(obj).hasClass('selected')) {
            $(obj).removeClass('selected');
            $("#selected li").each(function(){
                if ($(this).text().indexOf(uname) == 0) {
                    $(this).remove();
                }
            })
        } else {
            $(obj).addClass('selected');
            var htmlTxt = '<li data-email="'+email+'" data-uid="'+uid+'">'+uname+'<a class="close x" onclick="tagClose(this)">&times;</a></li>';
            $("#selected").append(htmlTxt);
        }
    }
}

function tagClose(obj) {
    var strTxt = $(obj).parent().text();
    $("#contacts li.selected").each(function(){
        if(strTxt.indexOf($(this).find(".contacts_name").text())==0) {
            $(this).removeClass("selected");
            $(obj).parent().remove();
        }
    })
}
</script>
<?php 
}
?>
    </body>
</html>
