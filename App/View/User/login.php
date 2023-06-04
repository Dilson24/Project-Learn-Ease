<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/Css/Home/Login/login.css">
    <title>Login</title>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="login">
            <form class="form">
                <label for="chk" aria-hidden="true">Iniciar Sesion</label>
                <div class="inputBox">
                    <input type="text" required="required">
                    <span class="user">Username</span>
                </div>
                <div class="inputBox">
                    <input type="password" required="required">
                    <span>Password</span>
                </div>

                <button class="enter">Enter</button>
            </form>
        </div>
        <div class="register">
            <form class="form">
                <label for="chk" aria-hidden="true">Registrarse</label>
                <div class="inputBox1">
                    <input type="text" required="required">
                    <span class="user">Email</span>
                </div>
                <div class="inputBox">
                    <input type="text" required="required">
                    <span>Username</span>
                </div>
                <div class="inputBox">
                    <input type="password" required="required">
                    <span>Password</span>
                </div>
                <button class="enter">Enter</button>
            </form>
        </div>
    </div>
    <script src="../../../Public/Js/Home/Login/login.js"></script>
</body>

</html>