<?php

include('includes/database_connection.php');

session_start();

if (!isset($_SESSION['user_id'])) {
  header('location:login.php');
}
?>

<html>

<head>
  <title>Chat Application using PHP Ajax Jquery</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <!--Import materialize.css-->
      <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">

<!--Main css-->
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
  <div class="container">
    <br />

    <h3 align="center">Remdiii</a></h3><br />
    <br />

    <div class="table-responsive">
      <h4 align="center">Online User</h4>


      <p align="right">Hi - <?php echo $_SESSION['username'];  ?> -
        <img src="<?php echo 'profilePic/' . $_SESSION['profile_image'] ?>" width="90" height="90" alt="">
        <div align="right">
          <a href="questionnaire.php">Questionnaire</a> -
          <a href="updatecondition.php">Update condition</a> -
          <a href="setting.php">Setting</a> -
          <a href="logout.php">Logout</a>
        </div> 
      </p>
      <div id="user_details"></div>
      <div id="user_model_details"></div>
    </div>

            <!-- Modal for rendering the charts, declare this if you want to render charts, 
         else you remove the modal -->
         <div id="modal1" class="modal">
            <canvas id="modal-chart"></canvas>
        </div>

        <!--chatbot widget -->
        <div class="widget">
            <div class="chat_header">

                <!--Add the name of the bot here -->
                <span class="chat_header_title">Remdii</span>
                <span class="dropdown-trigger" href='#' data-target='dropdown1'>
                  <i class="material-icons">
                  more_vert
                  </i>
               </span>

                <!-- Dropdown menu-->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#" id="clear">Clear</a></li>
                    <li><a href="#" id="restart">Restart</a></li>
                    <li><a href="#" id="close">Close</a></li>
                </ul>
            </div>

            <!--Chatbot contents goes here -->
            <div class="chats" id="chats">
                <div class="clearfix"></div>

            </div>

            <!--keypad for user to type the message -->
            <div class="keypad">
                <textarea id="userInput" placeholder="Type a message..." class="usrInput"></textarea>
                <div id="sendButton"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
            </div>
        </div>

        <!--bot profile-->
        <div class="profile_div" id="profile_div">
            <img class="imgProfile" src="../img/botAvatar.png" />
        </div>

        <!-- Bot pop-up intro -->
        <div class="tap-target" data-target="profile_div">
            <div class="tap-target-content">
                <h5 class="white-text">Hey there 👋</h5>
                <p class="white-text">I can help you get started with Rasa and answer your technical questions.</p>
            </div>
        </div>

     

  </div>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>

    <!--Main Script -->
    <script type="text/javascript" src="../js/script.js"></script>

    <!--Chart.js Script -->
    <script type="text/javascript" src="../js/chart.min.js"></script>

</body>

</html>

<script>
  $(document).ready(function() {

    fetch_user();

    setInterval(function() {
      update_last_activity();
      fetch_user();
      update_chat_history_data();
    }, 5000);

    function fetch_user() {
      $.ajax({
        url: "fetch_user.php",
        method: "POST",
        success: function(data) {
          $('#user_details').html(data);
        }
      })
    }

    function update_last_activity() {
      $.ajax({
        url: "update_status.php",
        success: function() {

        }
      })
    }

    function make_chat_dialog_box(to_user_id, to_user_name) {
      var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
      modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
      modal_content += fetch_user_chat_history(to_user_id);
      modal_content += '</div>';
      modal_content += '<div class="form-group">';
      modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control chat_message"></textarea>';
      modal_content += '</div><div class="form-group" align="right">';
      modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button></div></div>';
      $('#user_model_details').html(modal_content);
    }

    $(document).on('click', '.start_chat', function() {
      var to_user_id = $(this).data('touserid');
      var to_user_name = $(this).data('tousername');
      make_chat_dialog_box(to_user_id, to_user_name);
      $("#user_dialog_" + to_user_id).dialog({
        autoOpen: false,
        width: 400
      });
      $('#user_dialog_' + to_user_id).dialog('open');
    });

    $(document).on('click', '.send_chat', function() {
      var to_user_id = $(this).attr('id');
      var chat_message = $('#chat_message_' + to_user_id).val();
      $.ajax({
        url: "insert_chat.php",
        method: "POST",
        data: {
          to_user_id: to_user_id,
          chat_message: chat_message
        },
        success: function(data) {
          $('#chat_message_' + to_user_id).val('');
          $('#chat_history_' + to_user_id).html(data);
        }
      })
    });

    function fetch_user_chat_history(to_user_id) {
      $.ajax({
        url: "fetch_chat_history.php",
        method: "POST",
        data: {
          to_user_id: to_user_id
        },
        success: function(data) {
          $('#chat_history_' + to_user_id).html(data);
        }
      })
    }

    function update_chat_history_data() {
      $('.chat_history').each(function() {
        var to_user_id = $(this).data('touserid');
        fetch_user_chat_history(to_user_id);
      });
    }

    $(document).on('click', '.ui-button-icon', function() {
      $('.user_dialog').dialog('destroy').remove();
    });

    $(document).on('focus', '.chat_message', function() {
      var is_type = 'yes';
      $.ajax({
        url: "update_is_type_status.php",
        method: "POST",
        data: {
          is_type: is_type
        },
        success: function() {

        }
      })
    });

    $(document).on('blur', '.chat_message', function() {
      var is_type = 'no';
      $.ajax({
        url: "update_is_type_status.php",
        method: "POST",
        data: {
          is_type: is_type
        },
        success: function() {

        }
      })
    });

  });
</script>