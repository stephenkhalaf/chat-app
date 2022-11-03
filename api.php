<?php
session_start();
$info = (object)[];
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

if (!isset($_SESSION['userid'])) {
    if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type != 'login' && $DATA_OBJ->data_type != 'signup') {
        $info->logged_in = false;
        echo json_encode($info);
        die();
    }
}
require_once "classes/database.php";
$DB = new Database();


$Error = '';

if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'signup') {
    include "includes/signup.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'login') {
    include "includes/login.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'logout') {
    include "includes/logout.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'user_info') {
    include "includes/user_info.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'contacts') {
    include "includes/contacts.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'settings') {
    include "includes/settings.php";
} else if (isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == 'chats' || $DATA_OBJ->data_type == 'chats_refresh')) {
    include "includes/chats.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'save_settings') {
    include "includes/save_settings.php";
} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == 'send_message') {
    include "includes/send_message.php";
}
function message_left($data, $row)
{

    $images = ($row->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
    if (file_exists($row->image)) {
        $images = $row->image;
    }


    return "
        <div class='message_left'>
        <img src=$images alt=''>
        <span><b>$row->username</b></span>
        <p>" . htmlentities($data->message) . "</p>
        <span style='margin-left: 30px; font-size: 10px;'>"  . date("jS M Y H:i:s a", strtotime($data->date)) . "</span>
        <div></div>
        </div>
    
    ";
}


function message_right($data, $row)
{
    $images = ($row->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
    if (file_exists($row->image)) {
        $images = $row->image;
    }

    return  "
        <div class='message_right'>
            <img src='$images' alt=''>
            <span style='margin-left: 30px;'><b>$row->username</b></span>
            <p> " . htmlentities($data->message) . "</p>
            <span style='margin-left: 50%; font-size: 10px;'>" . date("jS M Y H:i:s a", strtotime($data->date)) . "</span>
            <div></div>
        </div>
    
    ";
}


function message_controls()
{

    return  "
    </div>
    <div class='controls'>
    <div style='display: flex; justify-content: space-between;'>
    <label style='flex: 1; cursor: pointer; opacity: 0.6; margin-left: 3px; padding-bottom:0' for='message_file'><img src='ui/icons/clip.png' width='40' height='40' /></label>
    <input type='file' id='message_file' name='file' style=' display:none' />
    <input onkeyup = 'enter_pressed(event)' style='flex: 8' type='text' placeholder='type something...'  id='message_text'/>
    <input style='flex: 1; background: green; color:white; border: none' type='button' value='send' onclick='send_message(event)'  />
    </div>
    </div> 
</div>  
    
    ";
}
