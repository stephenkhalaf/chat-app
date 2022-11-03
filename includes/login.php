<?php
$info = (object)[];
$data = [];

$data['email'] = $DATA_OBJ->email;

if (empty($DATA_OBJ->email)) {
    $Error = 'Please, enter a valid email';
}

if (empty($DATA_OBJ->password)) {
    $Error = 'Please, enter a password';
}


if ($Error == '') {
    $query = "select * from users where email = :email limit 1";
    $result = $DB->read($query, $data);
    if (is_array($result)) {
        $result = $result[0];
        if ($result->password == $DATA_OBJ->password) {
            $info->data_type = 'success';
            $info->message = "You have succesfully logged in<br>";
            $_SESSION['userid'] = $result->userid;
            echo json_encode($info);
        } else {
            $info->message = "Wrong password<br>";
            $info->data_type = 'error';
            echo json_encode($info);
        }
    } else {
        $info->message = "Wrong email<br>";
        $info->data_type = 'error';
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = 'error';
    echo json_encode($info);
}
