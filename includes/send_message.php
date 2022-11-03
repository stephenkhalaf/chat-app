<?php

$arr['userid'] = null;
if (isset($DATA_OBJ->find->userid)) {
    $arr['userid'] = $DATA_OBJ->find->userid;
}

$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql, $arr);


if (is_array($result)) {
    $arr['message'] = $DATA_OBJ->find->message;
    $arr['sender'] = $_SESSION['userid'];
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['msgid'] = get_random_string(60);


    $arr2['sender'] = $_SESSION['userid'];
    $arr2['receiver'] = $arr['userid'];

    $query = "select * from messages where (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) limit 1";
    $result2 = $DB->read($query, $arr2);



    if (is_array($result2)) {
        $arr['msgid'] = $result2[0]->msgid;
    }

    $query = 'insert into messages (sender, receiver, message, date, msgid) values (:sender, :userid, :message, :date, :msgid)';

    $DB->write($query, $arr);


    $result = $result[0];
    $images = ($result->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
    if (file_exists($result->image)) {
        $images = $result->image;
    }
    $row = $result;
    $row->images = $images;
    $mydata = "
            <span style=' font-size: 18px;font-family: headFont'> Now chatting with </span>
        <div class='active_contact'>
            <img src='$images' alt=''>
            <br>
            <span>$result->username</span>
        </div>";

    $messages = "
    <div class='messages_container_box'>
        <div class='messages_container'>

        ";

    $a['msgid'] = $arr['msgid'];
    $query = 'select * from messages where msgid = :msgid order by id desc ';
    $result = $DB->read($query, $a);

    if (is_array($result)) {
        $result = array_reverse($result);
        foreach ($result as $data) {
            $myuser = $DB->get_user($data->sender);
            if ($_SESSION['userid'] == $myuser->userid) {
                $messages .= message_right($data, $myuser);
            } else {
                $messages .= message_left($data, $myuser);
            }
        }
    }

    $messages .=  message_controls();

    $info->user = $mydata;
    $info->messages = $messages;
    $info->data_type = "chats";
    echo json_encode($info);
} else {
    $info->user = 'No contact found';
    $info->messages = "";
    $info->data_type = 'chats';
    echo json_encode($info);
}



function get_random_string($length)
{
    $array = array(
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    );

    $text = '';

    $length = rand(4, $length);

    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, 35);
        $text .= $array[$random];
    }
    return $text;
}
