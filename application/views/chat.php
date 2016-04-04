<!-- <div class="section_wrapper"> -->
  <div class="container" style="height:100%; position:relative;">
    <div id="main_block" style="height:100%; margin:0; padding: 70px 0 100px">

        <div class="btn-group pull-right" style="width:350px;margin-bottom:10px;">
            <button type="button" class="btn btn-info dropdown-toggle pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Create Chat <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a onclick="createChat(1)">1:1 Chat</a></li>
              <li><a onclick="createChat(2)">Group Chat</a></li>
            </ul>
        </div>

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