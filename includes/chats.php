<?php

$arr['userid'] = null;
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}
$refresh = false;
if ($DATA_OBJ->data_type == 'chats_refresh') {
    $refresh = true;
}
$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql, $arr);

if (is_array($result)) {
    $result = $result[0];
    $images = ($result->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
    if (file_exists($result->image)) {
        $images = $result->image;
    }
    $row = $result;
    $row->image = $images;

    $mydata = '';
    if (!$refresh) {
        $mydata = "
            <span style=' font-size: 18px;font-family: headFont'> Now chatting with </span>
        <div class='active_contact'>
            <img src=$images alt=''>
            <br>
            <span>$result->username</span>
        </div>";
    }

    $messages = '';
    if (!$refresh) {
        $messages = "
    <div class='messages_container_box'>
        <div class='messages_container'>
         ";
    }

    $a['sender'] = $_SESSION['userid'];
    $a['receiver'] = $arr['userid'];

    $query = "select * from messages where (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) order by id desc limit 10 ";
    $result = $DB->read($query, $a);

    if (is_array($result)) {
        $result = array_reverse($result);
        foreach ($result as $data) {
            $myuser = $DB->get_user($data->sender);
            if ($_SESSION['userid'] == $data->sender) {
                $messages .= message_right($data, $myuser);
            } else {
                $messages .= message_left($data, $myuser);
            }
        }
    }

    if (!$refresh) {
        $messages .=  message_controls();
    }

    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chats";

    if ($refresh) {
        $info->data_type = "chats_refresh";
    }
    echo json_encode($info);
} else {

    $a['userid'] = $_SESSION['userid'];


    $query = "select * from messages where (sender = :userid || receiver = :userid) group by msgid order by id desc limit 10 ";
    $result = $DB->read($query, $a);
    $mydata = "
            <span> Previous chats</span>";
    if (is_array($result)) {
        $result = array_reverse($result);
        foreach ($result as $data) {
            $myuser = $DB->get_user($data->receiver);
            $images = ($myuser->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
            if (file_exists($myuser->image)) {
                $images = $myuser->image;
            }
            $mydata .= "
        <div class='active_contact' onclick = 'start_chat(event)' userid = '$myuser->userid' id='contact'>
    
            <img src='$images' alt=''>
            <br>
            <span>$myuser->username </span><br>
            <span style='font-size: 10px;'> $data->message </span>
        </div>";
        }
    }
    $info->user = $mydata;
    $info->messages = '';
    $info->data_type = "chats";
    echo json_encode($info);
}
