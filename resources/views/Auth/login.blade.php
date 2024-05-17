<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* ROBOTO FONT */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        /* POPPINS FONT */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alexandria:wght@500&display=swap');


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Alexandria', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            position: relative;
            width: 470px;
            height: 400px;
            padding: 10px 30px;
            background: #FFF;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .login-header {
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 20px 0 50px 0;
        }

        .login-header header {
            font-family: 'Alexandria', sans-serif;
            color: #333;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .login-header p {
            color: #555;
        }

        .input-box {
            position: relative;
            width: 100%;
            margin-top: 12px;
        }

        .input-box label {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #555;
            transition: .15s ease-in-out;
        }

        .input-box input {
            width: 100%;
            height: 50px;
        }

        .input-box .input-field {
            font-size: 1em;
            color: #333;
            padding-left: 15px;
            margin-bottom: 25px;
            border: 1px solid #ddd;
            border-radius: 3px;
            outline: none;
        }

        .input-box input[type="password"] {
            margin-bottom: 10px;
        }

        .input-box .input-field:focus {
            border: 2px solid #8749F2;
        }

        .input-field:focus~label,
        .input-field:valid~label {
            top: -8px;
            left: 12px;
            font-size: 12px;
            color: #7931F5;
            background: #FFF;
            padding: 0 5px;
        }

        .input-field:valid~label {
            color: #555;
        }

        .forgot {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        section {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #555;
        }

        #check {
            margin-right: 10px;
        }

        section .forgot-link {
            font-weight: 500;
            text-decoration: none;
            color: #7931F5;
        }

        .input-submit {
            font-family: 'Alexandria', sans-serif;
            font-size: 15px;
            color: #FFF;
            background: #337bab;
            border: none;
            height: 63px;
            display: flow;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .middle-text {
            position: relative;
            width: 100%;
            margin: 30px 0;
        }

        .or-text {
            font-family: 'Alexandria', sans-serif;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #FFF;
            color: #777;
            padding: 10px;
        }

        hr {
            border: 1px solid #ddd;
        }

        .social-sign-in {
            display: flex;
            gap: 15px;
        }

        button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 5px;
            cursor: pointer;
        }

        .input-google {
            width: 100%;
            height: 50px;
            padding: 0 30px;
            background: #FFF;
            border: 1px solid #CCC;
        }

        .input-google img {
            width: 25px;
        }

        .input-google p {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            width: 90%;
        }

        .input-twitter {
            justify-content: center;
            width: 70px;
            height: 50px;
            background: #EEE;
            border: none;
        }

        .input-twitter img {
            width: 20px;
        }

        .input-google:hover,
        .input-twitter:hover,
        .input-submit:hover {
            opacity: 0.9;
        }

        .sign-up {
            position: absolute;
            bottom: -30px;
            right: 0;
        }

        .sign-up p {
            font-size: 14px;
            color: #333;
        }

        .sign-up p>a {
            text-decoration: none;
        }

        @media only screen and (max-width: 510px) {
            .login-box {
                padding: 10px 30px;
                margin: 20px;
            }
        }

        @media only screen and (max-width: 415px) {
            .login-box {
                padding: 10px 25px;
                margin: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-header">
            <header>تسجيل الدخول</header>
        </div>
        <form action="{{ route('login.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="input-box">
                <input type="text" class="input-field" id="email" name="email" required>
                <label for="email">الإيميل</label>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" id="password" name="password" required>
                <label for="password">كلمة المرور</label>
            </div>

            <div class="input-box">
                <button class="input-submit" type="submit">تسجيل الدخول</button>
            </div>

        </form>


    </div>
</body>

</html>
