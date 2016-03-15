// build html for messages
function buildMessageHTML(messageText, messageSenderId, messageDateSent, attachmentFileId, messageId, status){
  var messageAttach;
  if(attachmentFileId){
      messageAttach = '<img src="http://api.quickblox.com/blobs/'+attachmentFileId+'/download.xml?token='+token+'" alt="attachment" class="attachments img-responsive" />';
  }
  var delivered = '<img class="icon-small" src="assets/images/delivered.jpg" alt="" id="delivered_'+messageId+'">';
  var read = '<img class="icon-small" src="assets/images/read.jpg" alt="" id="read_'+messageId+'">';

  var messageHtml = '<div class="list-group-item" id="'+messageId+'" onclick="clickToAddMsg('+"'"+messageId+"'"+')">'+'<time datetime="'+messageDateSent+
                    '" class="pull-right">'+jQuery.timeago(messageDateSent)+'</time>'+'<h4 class="list-group-item-heading">'+messageSenderId+'</h4>'+
                    '<p class="list-group-item-text">'+(messageAttach ? messageAttach : messageText)+'</p>'+delivered+read+'</div>';
  return messageHtml;
}

// build html for dialogs
function buildDialogHtml(dialogId, dialogUnreadMessagesCount, dialogIcon, dialogName, dialogLastMessage) {
  var UnreadMessagesCountShow = '<span class="badge">'+dialogUnreadMessagesCount+'</span>';
      UnreadMessagesCountHide = '<span class="badge" style="display: none;">'+dialogUnreadMessagesCount+'</span>';

  var dialogHtml = '<a href="#" class="list-group-item inactive" id='+'"'+dialogId+'"'+' onclick="triggerDialog('+"'"+dialogId+"'"+', 1)">'+
                   (dialogUnreadMessagesCount === 0 ? UnreadMessagesCountHide : UnreadMessagesCountShow)+'<h5 class="list-group-item-heading">'+
                   dialogIcon+'&nbsp;&nbsp;&nbsp;<span><strong>'+dialogName+'</strong></span></h5>'+'<p class="list-group-item-text last-message">'+
                   (dialogLastMessage === null ?  "" : dialogLastMessage)+'</p>'+'</a>';
  return dialogHtml;
}

// build html for typing status
function buildTypingUserHtml(userId, userLogin) {
  var typingUserHtml = '<div id="'+userId+'_typing" class="list-group-item typing">'+'<time class="pull-right">writing now</time>'+'<h4 class="list-group-item-heading">'+
                       userLogin+'</h4>'+'<p class="list-group-item-text"> . . . </p>'+'</div>';

  return typingUserHtml;
}

function buildMetaHtml(jsonData) {
  var jsonObj = JSON.parse(jsonData);
  console.log("###################");
  console.log(jsonObj);
  var retHtml = '<div id="information_holder">'+
    '<h4>'+
      '<span class="">'+jsonObj.d_name+'</span>'+
    '</h4>'+

    '<h5 class="text-muted">Created by '+jsonObj.d_owner+'</h5>'+
    '<div class="information_actions">';
    
    if (jsonObj.notify == "10") {
      retHtml += '<a id="chat-noti" class="text-muted icon-noti-off" onclick="notifyAction(\''+jsonObj.d_id+'\')">Notifications<span class="">OFF</span></a>';
    } else {
      retHtml += '<a id="chat-noti" class="text-muted icon-noti-on" onclick="notifyAction(\''+jsonObj.d_id+'\')">Notifications<span class="">ON</span></a>';
    }
      
  if (jsonObj.d_owner == "Me") {
    retHtml += '<a class="" onclick="deleteAction(\''+jsonObj.d_id+'\')"><span class="text-danger">Delete</span></a>';
  } else {
    retHtml += '<a class="" onclick="leaveAction(\''+jsonObj.d_id+'\')"><span class="text-warning">Leave</span></a>';
  }
    retHtml += '</div><div class="information_members"><h5 class="">'+jsonObj.d_users.length+' Members';
  if (jsonObj.d_owner == "Me" && jsonObj.d_type == "2") {
    retHtml += '<a class="" onclick="showDialogInfoPopup()">+ Add Members</a>';
  }  
    retHtml += '</h5><ul>';
  for (var i=0; i<jsonObj.d_users.length; i++) {
    var d_user = jsonObj.d_users[i];
    if (d_user.photo == "") d_user.photo = site_url + "/assets/images/emp-sm.jpg";
    retHtml += '<li class="" id="remove-'+d_user.uid+'"><a class=""><img class="avatar avatar_small" src="'+d_user.photo+'">'+d_user.fname+'</a>';
   if (jsonObj.d_owner == "Me") {
    retHtml += '<a class="information_remove_user" onclick="removeAction(\''+jsonObj.d_id+'\', \''+d_user.uid+'\')"></a>';
  }
    retHtml += '<span class=""><lastseen data-user-id="4513703"><span class="lastseen">offline</span></lastseen></span></li>';
  }
        
  retHtml += '</ul></div></div>';
  return retHtml;
}

// build html for users list
function buildUserHtml(userLogin, userId, isNew) {
  var userHtml = "<a href='#' id='" + userId;
  if(isNew){
    userHtml += "_new'";
  }else{
    userHtml += "'";
  }
  userHtml += " class='col-md-12 col-sm-12 col-xs-12 users_form' onclick='";
  userHtml += "clickToAdd";
  userHtml += "(\"";
  userHtml += userId;
  if(isNew){
    userHtml += "_new";
  }
  userHtml += "\")'>";
  userHtml += userLogin;
  userHtml +="</a>";

  return userHtml;
}
