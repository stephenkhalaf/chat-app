<?php
sleep(1);
$id = $_SESSION['userid'];
$sql = "select * from users where userid != '$id' limit 10";
$myusers = $DB->read($sql, []);
$mydata = '
<style>
@keyframes animate{
    0%{opacity: 0; transform: translateY(50px) scale(1.2);}
    100%{opacity: 1; transform: translateY(0px) scale(1);}
}

.contact{
    pointer: cursor;
    transition: all 1s;
}
.contact:hover{
    transform: scale(1.1);
}
</style>
<div style="text-align: center;animation: animate 1s ease">
';
if (is_array($myusers)) {
    foreach ($myusers as $row) {
        $images = ($row->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
        if (file_exists($row->image)) {
            $images = $row->image;
        }
        $mydata .= "
        <div class='contact' onclick = 'start_chat(event)' userid = '$row->userid' id='contact'>
            <img src=$images alt=''>
            <br>
            <span>$row->username</span>
        </div>";
    }
}

$mydata .= '</div>';

$info->data_type = "contacts";
$info->message = $mydata;
echo json_encode($info);

die();

$info->message = 'No message was found!';
$info->data_type = 'error';
echo json_encode($info);
