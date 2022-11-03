<?php
sleep(1);
$sql = 'select * from users where userid = :userid limit 1';
$id = $_SESSION['userid'];
$data = $DB->read($sql, ['userid' => $id]);

$mydata = '';

if (is_array($data)) {
    $data = $data[0];
    $images = ($data->gender == 'Male') ? 'ui/images/male_profile.png' : 'ui/images/female_profile.png';
    if (file_exists($data->image)) {
        $images = $data->image;
    }

    $gender_male = "";
    $gender_female = "";

    if ($data->gender == 'Male') $gender_male = 'checked';
    else $gender_female = 'checked';

    $mydata = '
    <style>

    @keyframes animate{
        0%{opacity: 0; transform: translateY(50px) scale(1.1);}
        100%{opacity: 1; transform: translateY(0px) scale(1);}
    }
    form {
        margin: auto;
        width: 100%;
        max-width: 400px;
        padding: 10px;
    }

    input[type="text"],
    input[type="password"],
    input[type="submit"],
    input[type="email"] {
        padding: 10px;
        margin: 10px;
        width: 80%;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid grey;
    }

    input[type="submit"] {
        cursor: pointer;
        background-color: #27344b;
        color: white;
        border-radius: 10px
    }

    input[type="radio"] {
        transform: scale(1.2);
        cursor: pointer
    }

    form div {
        margin-left: 10px;
    }

    form div input {
        margin: 10px
    }
    .label_image{
        display: inline-block;
        cursor: pointer;
        background-color: #27344b;
        color: white;
        padding: 10px;
        margin-top: 10px;
        border-radius: 10px;
    }

   #myimg{
        border-radius: 50px 10px;
        width: 200px;
        height:200px;
    }

    .dragging{
        border: 2px dashed red;
    }




    </style>
    <div style="display:flex; animation: animate 1s ease">
    <div style="flex:1; margin:10px">
    <span style="font-size: 12px;font-variant: small-caps;">drag and drop to change picture </span>
    <br>
    <img ondragover = "handle_drag_drop(event)"  ondrop = "handle_drag_drop(event)"  ondragleave = "handle_drag_drop(event)" src="' . "$images" . '"s id="myimg">
    <label for="change_image_btn" class="label_image" > Change Profile Image </label>
    <input type="file" name="submit" onchange = "upload_profile_image(this.files)" style="display: none" id="change_image_btn">
    </div>
    <form action="/" id="myform" style="flex:2">
        <input type="text" name="username" placeholder="Username" value= ' . "$data->username" . '><br>
        <input type="email" name="email" placeholder="Email"  value= ' . "$data->email" . '><br>
        <div>
            <br>Gender: <br>
            <input type="radio" name="gender" value="Male" style="margin-left: 3px; " ' . $gender_male . '> Male<br>
            <input type="radio" name="gender" value="Female" ' . $gender_female . '>Female<br>
        </div>

        <input class="password1" type="password" name="password" placeholder="Password"  value= ' . "$data->password" . '> <input class="hide_show1" type="checkbox" onclick = "show_password()" /><br>
        <input class="password2" type="password" name="password2" placeholder="Retype password"  value= ' . "$data->password" . '> <input class="hide_show2" type="checkbox"  onclick = "show_password()" /><br>
        <input type="submit" name="submit" value="Save Settings" id="save_settings_button" onclick="collect_data(event)">
        <br>
    </form>
    </div>
    </div>
    ';


    $info->data_type = "settings";
    $info->message = $mydata;
    echo json_encode($info);
} else {
    $info->message = 'No message was found!';
    $info->data_type = 'error';
    echo json_encode($info);
}
