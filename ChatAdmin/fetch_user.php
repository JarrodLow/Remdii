
<?php


include('includes/database_connection.php');

session_start();

$query = "
SELECT * FROM login 
WHERE user_id != '" . $_SESSION['user_id'] . "' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
 <tr>
 <th width="40%">Username</td>
 <th width="20%">Profile Picture</td>
  <th width="20%">Status</td>
  <th width="20%">Action</td>
 </tr>
';

foreach ($result as $row) {
    if ($row['user_type'] == "user") {
        $status = '';
        $id = $row['user_id'];
        $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
        $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
        $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
        if ($user_last_activity > $current_timestamp) {
            $status = '<span class="label label-success">Online</span>';
        } else {
            $status = '<span class="label label-danger">Offline</span>';
        }
        $output .= '
 <tr>
  <td><a href="userdetail.php?id=' . $id . '">' . $row['username'] . '</a> ' . count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect) . ' ' . fetch_is_type_status($row['user_id'], $connect) . '</td>
  <td><img src=' . '../Chat/profilePic/' . '' . $row['profile_image'] . ' width="90" height="90" alt=""></td>
  <td>' . $status . '</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['user_id'] . '" data-tousername="' . $row['username'] . '">Start Chat</button></td>
 </tr>
 ';
    }
}

$output .= '</table>';

echo $output;

?>