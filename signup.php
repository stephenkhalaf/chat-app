<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <style>
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
            margin: 30px auto;
            font-family: myFont;
            font-size: 13px;
        }

        form {
            margin: auto;
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 2px solid black;
        }

        input[type='text'],
        input[type='password'],
        input[type='submit'],
        input[type='email'] {
            padding: 10px;
            margin: 10px;
            width: 98%;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid grey;
        }

        input[type='submit'] {
            cursor: pointer;
            background-color: darkblue;
            color: white
        }

        input[type='radio'] {
            transform: scale(1.2);
            cursor: pointer
        }

        form div {
            margin-left: 10px;
        }

        form div input {
            margin: 10px
        }

        #header {
            background: darkblue;
            min-height: 70px;
            font-size: 40px;
            text-align: center;
            font-family: headFont;
            margin: auto;
            color: white;
            width: 100%;
            max-width: 430px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="header">
            My Chat
            <div style="font-size: 2rem; font-family:myFont;padding: 10px 0">Register</div>
        </div>
        <form action="/" id="myform">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <div>
                <br>Gender: <br>
                <input type="radio" name="gender" value="Male">Male<br>
                <input type="radio" name="gender" value="Female">Female<br>
            </div>

            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="Retype password"><br>
            <input type="submit" name="submit" value="Sign Up" id="signup">
            <br>
            <div style="text-align:center"><a href="login.php">Already have an account? Log in</a></div>
        </form>
    </div>

    <script>
        function _(id) {
            return document.getElementById(id)
        }

        const signup = _('signup')

        signup.addEventListener('click', e => {
            e.preventDefault()
            // signup.disabled = true
            // signup.value = 'Loading...please,wait'
            collect_data()
        })

        function collect_data() {
            const myform = _('myform')
            const inputs = myform.querySelectorAll('input')
            const data = {}

            for (let i = 0; i < inputs.length; i++) {
                let key = inputs[i].name

                switch (key) {
                    case 'username':
                        data[key] = inputs[i].value
                        break
                    case 'email':
                        data[key] = inputs[i].value
                        break
                    case 'password':
                        data[key] = inputs[i].value
                        break
                    case 'password2':
                        data[key] = inputs[i].value
                        break
                    case 'gender':
                        if (inputs[i].checked) {
                            data[key] = inputs[i].value
                        }
                        break

                }
            }

            send_data(data, 'signup')

        }

        function send_data(data, type) {
            const xhr = new XMLHttpRequest()
            xhr.open('POST', 'api.php')
            xhr.onreadystatechange = function() {
                if (xhr.status == 200 && xhr.readyState == 4) {
                    console.log(xhr.responseText)
                    handle_result(xhr.responseText)
                    // signup.disabled = false
                    // signup.value = 'Sign Up'
                }
            }
            data.data_type = type
            xhr.send(JSON.stringify(data))
        }

        function handle_result(result) {
            let data = JSON.parse(result)
            if (data.data_type == 'success') {
                window.location = 'index.php'
            } else {
                const div = document.createElement('div')
                div.innerHTML = data.message
                div.style.position = 'absolute'
                div.style.minWidth = 30 + '%'
                div.style.minHeight = 50 + 'px'
                div.style.background = 'red'
                div.style.color = 'white'
                div.style.top = 5 + 'px'
                div.style.left = 30 + '%'
                div.style.padding = 10 + 'px'
                div.style.textAlign = 'center'
                div.style.borderRadius = 10 + 'px'
                div.style.opacity = 0.8
                div.style.margin = 'auto'

                document.body.append(div)
            }

        }
    </script>

</body>


</html>