<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat app</title>

    <style>
        * {
            box-sizing: border-box;
        }

        @font-face {
            font-family: myFont;
            src: url(ui/fonts/OpenSans-Regular.ttf);
        }

        @font-face {
            font-family: headFont;
            src: url(ui/fonts/Summer-Vibes-OTF.otf);
        }

        #wrapper {
            max-width: 900px;
            min-height: 500px;
            max-height: 650px;
            display: flex;
            margin: 30px auto;
            color: white;
            font-family: myFont;
            font-size: 13px;
            overflow: hidden;
        }


        #left_pannel {
            min-height: 500px;
            max-height: 650px;
            background: #27344b;
            flex: 2;
            text-align: center
        }

        #profile_img {
            max-width: 50%;
            width: 100px;
            height: 100px;
            max-height: 50%;
            border-radius: 50%;
            margin: 10px;
            border: 2px solid white;
        }

        #left_pannel label {
            width: 100%;
            display: block;
            min-height: 20px;
            background: #404b56;
            border-bottom: 2px solid #fffff555;
            cursor: pointer;
            padding: 5px;
            transition: all 1s ease
        }

        #left_pannel label:hover {
            background: #778593;
        }

        #left_pannel label img {
            float: right;
            max-width: 25px;
        }

        #right_pannel {
            min-height: 400px;
            max-height: 530px;
            flex: 6;
        }

        #header {
            background: #485b6c;
            min-height: 50px;
            max-height: 70px;
            font-size: 40px;
            text-align: center;
            font-family: headFont;
            position: relative;
        }

        .loader_on {
            position: absolute;
            width: 30%;
        }

        .loader_off {
            display: none;
        }

        .loader_on img {
            width: 70px;
        }

        #container {
            display: flex;
            height: 530px;
        }

        #inner_left_pannel {
            background: #383e48;
            flex: 1;
            min-height: 430px;
            max-height: 530px;
            text-align: center
        }


        #inner_right_pannel {
            background: #f2f7f8;
            flex: 2;
            min-height: 430px;
            max-height: 530px;
            transition: all 2s ease;
        }


        #radio_contacts:checked~#inner_right_pannel {
            flex: 0;
        }

        #radio_settings:checked~#inner_right_pannel {
            flex: 0;
        }


        .contact {
            width: 100px;
            height: 120px;
            display: inline-block;
            margin: 5px;
            vertical-align: top;
        }

        .contact img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .active_contact {
            height: 100px;
            margin: 10px;
            background: #f2f7f8;
            color: green;
            border: 1px solid black;
            border-radius: 0 0 50px 0;
            cursor: pointer;
        }

        .active_contact img {
            width: 100px;
            height: 100px;
            float: left;
            object-fit: cover;
        }

        .message_left {
            min-height: 50px;
            width: 80%;
            margin: 15px;
            background: white;
            border: 1px solid black;
            float: left;
            color: black;
            border-radius: 40px 0;
            box-shadow: 0 0 2px black;
            position: relative;
            max-width: 400px;
            word-wrap: break-word;

        }

        .message_left img {
            width: 60px;
            height: 60px;
            float: left;
            object-fit: cover;
            border-radius: 50%;
            padding-right: 10px
        }

        .message_left div {
            position: absolute;
            width: 20px;
            height: 20px;
            background: green;
            bottom: 0px;
            left: 0px;
            border-radius: 50%;
        }


        .message_right {
            min-height: 50px;
            width: 80%;
            margin: 15px;
            background: lightgreen;
            border: 1px solid black;
            float: right;
            color: black;
            border-radius: 0 40px;
            box-shadow: 0 0 2px black;
            position: relative;
            word-wrap: break-word;
            max-width: 400px;

        }

        .message_right img {
            width: 60px;
            height: 60px;
            float: right;
            object-fit: cover;
            border-radius: 50%;
            padding-left: 10px
        }

        .message_right div {
            position: absolute;
            width: 20px;
            height: 20px;
            background: green;
            bottom: 0px;
            right: 0px;
            border-radius: 50%;
        }

        .message_right p {
            margin-left: 20px;
        }

        .messages_container {
            min-height: 400px;
            overflow-y: auto;
            /* max-width: 450px; */
        }

        .messages_container_box {
            display: flex;
            flex-direction: column;
            max-height: 460px;
            overflow: auto;
        }

        .controls {
            height: 50px;
        }

        .controls input {
            min-height: 30px;
            margin: 5px;
            margin-bottom: 0
        }

        .controls input[type='button'] {
            cursor: pointer
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="left_pannel">
            <div style="padding: 10px;" id="user_info">
                <img src="ui/images/male_profile.png" alt="" id="profile_img">
                <br>
                <span id="username">Username</span>
                <br>
                <span style="font-size: 12px; opacity: 0.5" id="email">email@email.com</span>
                <br>
                <br>
                <br>

                <div>
                    <label id="label_chat" for="radio_chat"> Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                    <label id="logout" for="radio_settings">Logout <img src="ui/icons/logout.png" alt=""></label>
                </div>
            </div>

        </div>
        <div id="right_pannel">
            <div id="header">
                <div id="loader" class="loader_off"><img src="ui/icons/giphy.gif" alt=""></div>
                My Chat

            </div>
            <div id="container">
                <div id="inner_left_pannel">
                </div>
                <input type="radio" name="box" id="radio_chat" style="display:none ;">
                <input type="radio" name="box" id="radio_contacts" style="display:none ;">
                <input type="radio" name="box" id="radio_settings" style="display:none ;">

                <div id="inner_right_pannel"></div>
            </div>
        </div>
    </div>

</body>


<script>
    let CURRENT_CHAT_USER = ''

    function _(elem) {
        return document.getElementById(elem)
    }

    let logout = _('logout')
    let label_chat = _('label_chat')
    let label_contacts = _('label_contacts')
    let label_settings = _('label_settings')
    let inner_left_pannel = _('inner_left_pannel')
    let inner_right_pannel = _('inner_right_pannel')
    let loader = _('loader')

    logout.addEventListener('click', logout_user)
    label_contacts.addEventListener('click', get_contacts)
    label_chat.addEventListener('click', get_chats)
    label_settings.addEventListener('click', get_settings)


    function get_data(find, type) {
        const xhr = new XMLHttpRequest()
        loader.className = 'loader_on'
        xhr.open('POST', 'api.php')
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                loader.className = 'loader_off'
                handle_result(xhr.responseText, type)
            }
        }

        const data = {}
        data.find = find
        data.data_type = type
        xhr.send(JSON.stringify(data))
    }

    function handle_result(data, type) {
        // alert(data)
        if (data.trim() != '') {
            let obj = JSON.parse(data)
            if (typeof(obj.logged_in) != 'undefined' && !obj.logged_in) {
                window.location = 'login.php'
            } else {
                switch (obj.data_type) {

                    case 'user_info':
                        let username = _('username')
                        let email = _('email')
                        let profile_img = _('profile_img')
                        username.innerHTML = obj.username
                        email.innerHTML = obj.email
                        profile_img.src = obj.images

                        break
                    case 'contacts':
                        inner_left_pannel.innerHTML = obj.message
                        inner_right_pannel.style.overflow = 'hidden'
                        break

                    case 'chats':
                        inner_left_pannel.innerHTML = obj.user
                        inner_right_pannel.innerHTML = obj.messages
                        let messages_container = document.querySelector('.messages_container')
                        setTimeout(() => {
                            messages_container.scrollTo(0, messages_container.scrollHeight)
                            let message_text = _('message_text')
                            message_text.focus()
                        }, 500)
                        break

                    case 'chats_refresh':
                        messages_container = document.querySelector('.messages_container')
                        messages_container.innerHTML = obj.messages
                        break


                    case 'settings':
                        inner_left_pannel.innerHTML = obj.message
                        break
                    case 'save_settings':
                        alert(obj.message)
                        get_settings()
                        get_data({}, 'user_info')
                        break
                }
            }
        }
    }

    function logout_user() {
        let result = confirm('Are you sure, you want to logout?')
        if (result) {
            get_data({}, 'logout')
        }

    }

    function get_contacts() {
        get_data({}, 'contacts')
    }

    function get_chats() {
        get_data({}, 'chats')
    }

    function get_settings() {
        get_data({}, 'settings')
    }


    function send_message() {
        let message_text = _('message_text')
        if (message_text.value.trim() == '') {
            alert('Please, type in something...')
            return
        }

        get_data({
            userid: CURRENT_CHAT_USER,
            message: message_text.value.trim()
        }, 'send_message')


    }

    let radio_contacts = _('radio_contacts')
    radio_contacts.checked = true
    get_data({}, 'user_info')
    get_contacts()

    setInterval(() => {
        if (CURRENT_CHAT_USER != '') {
            get_data({
                userid: CURRENT_CHAT_USER
            }, 'chats_refresh')
        }
    }, 5000)
</script>



<script>
    function collect_data(e) {
        e.preventDefault()
        const myform = _("myform")
        const inputs = myform.querySelectorAll("input")
        const data = {}

        for (let i = 0; i < inputs.length; i++) {
            let key = inputs[i].name

            switch (key) {
                case "username":
                    data[key] = inputs[i].value
                    break
                case "email":
                    data[key] = inputs[i].value
                    break
                case "password":
                    data[key] = inputs[i].value
                    break
                case "password2":
                    data[key] = inputs[i].value
                    break
                case "gender":
                    if (inputs[i].checked) {
                        data[key] = inputs[i].value
                    }
                    break

            }
        }

        send_data(data, "save_settings")

    }

    function send_data(data, type) {
        const xhr = new XMLHttpRequest()
        xhr.open("POST", "api.php")
        xhr.onreadystatechange = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                handle_result(xhr.responseText)
            }
        }
        data.data_type = type
        xhr.send(JSON.stringify(data))
    }

    function upload_profile_image(files) {
        let label_image = document.querySelector('.label_image')
        label_image.innerHTML = 'Uploading Image...'
        const myForm = new FormData()

        const xhr = new XMLHttpRequest()
        xhr.open("POST", "uploader.php")
        xhr.onreadystatechange = function() {
            if (xhr.status == 200 && xhr.readyState == 4) {
                get_data({}, 'user_info')
                get_settings()

            }
        }
        myForm.append('file', files[0])
        myForm.append('data_type', 'change_profile_image')
        xhr.send(myForm)
    }

    function handle_drag_drop(e) {
        e.preventDefault()
        if (e.type == 'dragover') {
            e.target.className = 'dragging'
        } else if (e.type == 'drop') {
            e.target.className = ''
            upload_profile_image(e.dataTransfer.files)
        } else if (e.type == 'dragleave') {
            e.target.className = ''
        } else {
            e.target.className = ''
        }
    }

    function start_chat(e) {
        let radio_chat = _('radio_chat')
        radio_chat.checked = true
        CURRENT_CHAT_USER = e.target.parentElement.getAttribute('userid')
        get_data({
            userid: CURRENT_CHAT_USER
        }, 'chats')
    }

    function show_password() {
        let hide_show1 = document.querySelector('.hide_show1')
        let password1 = document.querySelector('.password1')
        let hide_show2 = document.querySelector('.hide_show2')
        let password2 = document.querySelector('.password2')
        if (hide_show1.checked) {
            password1.type = 'text'
        } else {
            password1.type = 'password'
        }

        if (hide_show2.checked) {
            password2.type = 'text'
        } else {
            password2.type = 'password'
        }

    }


    function enter_pressed(e) {
        if (e.key == 'Enter') send_message()
    }
</script>

</html>