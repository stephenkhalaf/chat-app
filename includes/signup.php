<?php
$info = (object)[];
$data = [];
$data['userid'] = $DB->generate_id(20);
$data['date'] = date("Y-m-d H:i:s");

$data['username'] = $DATA_OBJ->username;

if (empty($DATA_OBJ->username)) {
    $Error .= 'Please, enter a valid user name <br>';
} else {
    if (strlen($DATA_OBJ->username) < 3) {
        $Error .= 'username must be at least 3 characters long <br>';
    }

    if (!preg_match("/^[a-zA-z]+/", $DATA_OBJ->username)) {
        $Error .= 'Please, make sure username starts with a character<br>';
    }
}
$data['email'] = $DATA_OBJ->email;

if (empty($DATA_OBJ->email)) {
    $Error .= 'Please, enter a valid email <br>';
} else {

    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email)) {
        $Error .= 'Please, enter a valid email <br>';
    }
}

$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;

if (empty($DATA_OBJ->gender)) {
    $Error .= 'Please, select a gender <br>';
}


$data['password'] = $DATA_OBJ->password;
$password = $DATA_OBJ->password2;

if (empty($DATA_OBJ->password)) {
    $Error .= 'Please, enter a valid password<br>';
} else {
    if ($DATA_OBJ->password != $DATA_OBJ->password2) {
        $Error .= 'Password must match<br>';

        if (strlen($DATA_OBJ->password) < 6) {
            $Error .= 'Password must be at least 6 characters long<br>';
        }
    }
}




if ($Error == '') {
    $query = "insert into users (userid,username,password,email,gender,date) values (:userid,:username,:password,:email,:gender,:date)";
    $result = $DB->write($query, $data);
    // $result = true;
    if ($result) {
        $info->message = "your profile was created";
        $info->data_type = 'success';
        echo json_encode($info);
        // sleep(1);
    } else {
        $info->message = "An error occurred when creating our profile<br>";
        $info->data_type = 'error';
        echo json_encode($info);
    }
} else {
    $info->message = $Error;
    $info->data_type = 'error';
    echo json_encode($info);
}
