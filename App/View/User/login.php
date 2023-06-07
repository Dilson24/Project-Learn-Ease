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
                <div class="alert alert-danger alert-white rounded" id="error-alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="close-btn">×</button>
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
            <form class="form" method="post" action="../../../App/Controller/User/userController.php?register">
                <label for="chk" aria-hidden="true">Registrarse</label>
                <div class="inputBoxSignUp name">
                    <input type="text" required="required" name="nameR">
                    <span>Nombre</span>
                </div>
                <div class="inputBoxSignUp lastName">
                    <input type="text" required="required" name="lastNameR">
                    <span>Apellido</span>
                </div>
                <div class="inputBoxSignUp dateofBirth">
                    <input id="boxdate" class="date" type="date" required="required" name="dateOfBirthR">
                    <span>Fecha de nacimiento</span>
                </div>
                <div class="inputBoxSignUp phone">
                    <input type="tel" id="phone" required="required" name="phoneR">
                    <span>Número de telefono</span>
                </div>
                <div class="inputBoxSignUp">
                    <select id="country" class='form-control' requiered="required" name="countryR">
                        <option value="">-- País --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="region" class='form-control' required="required">
                        <option value="">-- Región --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="city" class='form-control' required="required" name="cityR">
                        <option value="">-- Ciudad --</option>
                    </select>
                </div>
                <div class="inputBoxSignUp">
                    <select id="studentType" class='form-control' required="required" name="studentTypeR">
                        <option value="">-- ¿Qué tipo de estudiante eres? --</option>
                        <option value="1">Estudiante universitario/a</option>
                        <option value="2">Estudiante de segundaria</option>
                        <option value="2">Estudiante tecnico o tecnologo</option>
                    </select>
                </div>
                <div class="inputBoxSignUp email2">
                    <input type="email" required="required" name="emailR">
                    <span>Email</span>
                </div>
                <div class="inputBoxSignUp password2">
                    <input type="password" required="required" name="passwordR">
                    <span>Contraseña</span>
                </div>
                <button class="SignUpBtn">Registrarse</button>
            </form>
        </div>
    </div>
    <script src="../../../Public/Js/Home/Login/login.js"></script>
</body>

</html>