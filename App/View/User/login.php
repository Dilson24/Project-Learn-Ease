<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/Css/Home/Login/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="login">
            <form class="form">
                <label for="chk" aria-hidden="true">Iniciar Sesion</label>
                <div class="inputBoxSignIn email">
                    <input type="email" required="required">
                    <span>Email</span>
                </div>
                <div class="inputBoxSignIn password">
                    <input type="password" required="required">
                    <span>Contraseña</span>
                </div>

                <button class="SignInBtn">Iniciar Sesion</button>
            </form>
        </div>
        <div class="register">
            <form class="form">
                <label for="chk" aria-hidden="true">Registrarse</label>
                <div class="inputBoxSignUp email2">
                    <input type="email" required="required">
                    <span>Email</span>
                </div>
                <div class="inputBoxSignUp name">
                    <input type="text" required="required">
                    <span>Nombre</span>
                </div>
                <div class="inputBoxSignUp lastName">
                    <input type="text" required="required">
                    <span>Apellido</span>
                </div>
                <div class="inputBoxSignUp dateofBirth">
                    <input id="boxdate"class="date" type="date" required="required" placeholder="Fecha de nacimiento">
                    <span>Fecha de nacimiento</span>
                </div>
                <div class="inputBoxSignUp phone">
                    <input type="tel" id="phone" name="phone" required>
                    <span>Número de telefono</span>
                </div>
                <div class="inputBoxSignUp">
                    <select id="country" class='form-control'>
                        <option value="">-- País --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="region" class='form-control' required="required">
                        <option value="">-- Región --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="city" class='form-control' required="required">
                        <option value="">-- Ciudad --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="student_type" class='form-control' required="required">
                        <option value="">-- ¿Qué tipo de estudiante eres? --</option>
                        <option value="">Estudiante universitario/a</option>
                        <option value="">Estudiante de segundaria</option>
                        <option value="">Estudiante tecnico o tecnologo</option>
                    </select>
                </div>

                <div class="inputBoxSignUp password2">
                    <input type="password" required="required">
                    <span>Contraseña</span>
                </div>
                <button class="SignUpBtn">Registrarse</button>
            </form>
        </div>
    </div>
    <script src="../../../Public/Js/Home/Login/login.js"></script>
</body>

</html>