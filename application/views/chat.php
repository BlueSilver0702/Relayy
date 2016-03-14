<!-- <div class="section_wrapper"> -->
  <div class="container" style="height:100%; position:relative;">
    <div id="main_block" style="height:100%; margin:0; padding: 70px 0 100px">

        <a href="#" onclick="showNewDialogPopup(2)" class="btn btn-success pull-right" style="margin-bottom:10px"><span class="glyphicon glyphicon-plus"></span>&nbsp;Group Chat</a>
        <a href="#" onclick="showNewDialogPopup(1)" class="btn btn-danger pull-right" style="margin-bottom:10px;margin-right:10px;"><span class="glyphicon glyphicon-plus"></span>&nbsp;Private Chat</a>

        <div class="panel panel-primary" style="height:100%;position:relative;clear:both;">
          <div class="panel-body">
            <div class="row">
              
              <div id="mcs_container" class="col-md-12 nice-scroll">
                  <div class="customScrollBox">
                    <div class="container del-style">
                      <div class="content list-group <!-- pre-scrollable --> nice-scroll" id="messages-list">
                        <!-- list of chat messages will be here -->
                      </div>
                    </div>
                  </div>
                  <div><img src="<?php echo asset_base_url()?>/images/ajax-loader.gif" class="load-msg"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="position:absolute; bottom:12px; width:100%;">
            <form class="form-inline" role="form" method="POST" action="" onsubmit="return submit_handler(this)" style=" margin:0 15px;">
              <div class="form-group">
                <input id="load-img" type="file">
                <button type="button" id="attach_btn" class="btn btn-default" onclick="">Attach</button>
                <input type="text" class="form-control" id="message_text" placeholder="Enter message">
                <button  type="submit" id="send_btn" class="btn btn-default" onclick="clickSendMessage()">Send</button>
              </div>
              <img src="<?php echo asset_base_url()?>/images/ajax-loader.gif" id="progress">
            </form>
          </div>
        </div>
    </div>

    <!-- Modal (new dialog)-->
    <div id="add_new_dialog" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="new_dialog_title">Choose users to create a group with</h3>
          </div>
          <div class="modal-body">
            <div class="list-group pre-scrollable for-scroll">
              <div id="users_list" class="clearfix"></div>
            </div>
            <div class="img-place"><img src="<?= asset_base_url()?>/images/ajax-loader.gif" id="load-users"></div>
              <input type="text" class="form-control" id="dlg_name" placeholder="Enter Group name">
            <button id="add-dialog" type="button" value="Confirm" class="btn btn-success btn-lg btn-block" onclick="createNewDialog()">Create Group</button>
            <div class="progress">
              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal (update dialog)-->
    <div id="update_dialog" class="modal fade row" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Dialog info</h3>
          </div>
          <div class="modal-body">
            <div class="col-md-12 col-sm-12 col-xs-12 new-info">
              <h5 class="col-md-12 col-sm-12 col-xs-12">Name:</h5>
              <input type="text" class="form-control" id="dialog-name-input">
            </div>
            <h5 class="col-md-12 col-sm-12 col-xs-12 push">Add more user (select to add):</h5>
            <div class="list-group pre-scrollable occupants" id="push_usersList">
              <div id="add_new_occupant" class="clearfix"></div>
            </div>
            <h5 class="col-md-12 col-sm-12 col-xs-12 dialog-type-info"></h5>
            <h5 class="col-md-12 col-sm-12 col-xs-12" id="all_occupants"></h5>
            <button id="update_dialog_button" type="button" value="Confirm" id="" class="btn btn-success btn-ms btn-block"
              onclick="onDialogUpdate()">Update</button>
            <button id="delete_dialog_button" type="button" value="Confirm" id="for_width" class="btn btn-danger btn-ms btn-block"
              onclick="onDialogDelete()">Delete dialog</button>
          </div>
        </div>
      </div>
    </div>