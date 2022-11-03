<?php
$info = (object)[];
$data = [];

$data['userid'] = $_SESSION['userid'];

if ($Error == '') {
    $query = "select * from users where userid = :userid limit 1";
    $result = $DB->read($query, $data);
    if (is_array($result)) {
        $result = $result[0];
        $result->data_type = "user_info";

        $images = ($result->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
        if (file_exists($result->image)) {
            $images = $result->image;
        }
        $result->images = $images;
        echo json_encode($result);
    }
} else {
    $info->message = $Error;
    $info->data_type = 'error';
    echo json_encode($info);
}
