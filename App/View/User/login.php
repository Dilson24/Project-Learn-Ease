<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Public/Css/Home/Login/login.css">
    <link rel="stylesheet" href="../../../Public/Css/Includes/all.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="login">
            <?php if (isset($_GET['message']) && !empty($_GET['message'])): ?>
                <div class="alert alert-danger alert-white rounded" id="errorAlertL">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="closeBtn">×</button>
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>
                    <?= $message = $_GET['message'] ?>
                </div>
            <?php endif; ?>

            <form class="form" method="post" action="../../../App/Controller/User/userController.php">
                <label for="chk" aria-hidden="true">Iniciar Sesion</label>
                <div class="inputBoxSignIn email">
                    <input type="email" required="required" name="Email">
                    <span>Email</span>
                </div>
                <div class="inputBoxSignIn password">
                    <input type="password" required="required" name="Password">
                    <span>Contraseña</span>
                </div>

                <button class="SignInBtn">Iniciar Sesion</button>
            </form>
        </div>
        <div class="register">
            <div id="successAlertR" class="alert alert-success alert-white rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="icon"><i class="fa fa-check"></i></div>
                <strong>Success!</strong> Registro exitoso,¡Bienvenido!
            </div>
            <div id="errorAlertR"class="alert alert-danger alert-white rounded">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="closeBtnR">×</button>
                <div class="icon"><i class="fa fa-times-circle"></i></div>
                <strong>Error!</strong> Los campos no pueden estar vacios.
            </div>

            <div>
                <form id="formRegister"class="form" method="post" action="../../../App/Controller/User/userController.php?register">
                    <label for="chk" aria-hidden="true">Registrarse</label>
                    <div class="inputBoxSignUp name">
                        <input type="text" name="nameR"  required="required">
                        <span>Nombre</span>
                    </div>
                    <div class="inputBoxSignUp lastName">
                        <input type="text" name="lastNameR"  required="required">
                        <span>Apellido</span>
                    </div>
                    <div class="inputBoxSignUp dateofBirth">
                        <input id="boxdate" class="date" type="date" name="dateOfBirthR" required="required">
                        <span>Fecha de nacimiento</span>
                    </div>
                    <div class="inputBoxSignUp phone">
                        <input type="tel" id="phone" name="phoneR"  required="required">
                        <span>Número de teléfono</span>
                    </div>
                    <div class="inputBoxSignUp">
                        <select id="country" class='form-control' name="countryR"  required="required">
                            <option value="">-- País --</option>
                        </select>
                    </div>
                    <div class="inputBoxSignUp">
                        <select id="region" class='form-control'>
                            <option value="">-- Región --</option>
                        </select>
                    </div>
                    <div class="inputBoxSignUp">
                        <select id="city" class='form-control' name="cityR" required="required">
                            <option value="">-- Ciudad --</option>
                        </select>
                    </div>
                    <div class="inputBoxSignUp">
                        <select id="studentType" class='form-control' name="studentTypeR"  required="required">
                            <option value="">-- ¿Qué tipo de estudiante eres? --</option>
                            <option value="1">Estudiante universitario/a</option>
                            <option value="2">Estudiante de secundaria</option>
                            <option value="2">Estudiante técnico o tecnólogo</option>
                        </select>
                    </div>
                    <div class="inputBoxSignUp email2">
                        <input type="email" name="emailR" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBoxSignUp password2">
                        <input type="password" name="passwordR" required="required">
                        <span>Contraseña</span>
                    </div>
                    <button class="SignUpBtn" type="submit">Registrarse</button>
                </form>
            </div>

        </div>
        <script src="../../../Public/Js/Home/Login/login.js"></script>
</body>

</html>