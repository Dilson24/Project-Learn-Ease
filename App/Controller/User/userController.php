<?php
require_once '../../../App/Config/connection.php';
require_once '../../../App/Model/User/userModel.php';

class UserController
{
    private $conn;
    private $userModel;


    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->userModel = new UserModel($this->conn);

    }

    public function login()
    {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los valores ingresados por el usuario
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            // Realizar la consulta para verificar las credenciales
            $user = $this->userModel->getUserByEmail($email);

            // Verificar si se encontró un usuario con el email proporcionado
            if ($user) {
                // Verificar si la contraseña coincide
                if (password_verify($password, $user['Password'])) {
                    // Las credenciales son correctas, el usuario ha iniciado sesión correctamente

                    // Obtener el User_ID, Name y Profile_image del usuario que ha iniciado sesión
                    $userId = $user['User_ID'];
                    $name = $user['Name'];
                    $profileImage = $user['Profile_Image'];

                    // Verificar si ya existe un registro para el usuario en user_connections
                    $lastCount = $this->userModel->getMaxUserConnectionCount($userId) + 1;

                    // Insertar el nuevo registro en la tabla user_connections
                    $this->userModel->insertUserConnection($userId, $lastCount);

                    // Obtener el valor de Role_ID del usuario
                    $roleId = $user['Role_ID'];
                    if ($roleId == 1) {
                        // Iniciar sesión y almacenar la información del usuario en variables de sesión
                        session_start();
                        $_SESSION['role'] = 'Admin';
                        $_SESSION['name'] = $name;
                        $_SESSION['profileImage'] = $profileImage;
                        // Redirigir al perfil del administrador
                        header('Location: ../../../App/View/Admin/profileAdmin.php');
                        exit();
                    } elseif ($roleId == 2) {
                        session_start();
                        $_SESSION['role'] = 'User';
                        $_SESSION['name'] = $name;
                        $_SESSION['profileImage'] = $profileImage;
                        header('Location: ../../../App/View/User/profile.php');
                        exit();
                    }
                } else {
                    // Contraseña incorrecta
                    $message = 'Contraseña incorrecta';
                }
            } else {
                // No se encontró un usuario con el email proporcionado
                $message = 'Email no encontrado';
            }
        }

        // Ejemplo: Pasar $message como una variable en la redirección
        header('Location: ../../../App/View/User/login.php?message=' . urlencode($message));
        exit();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los valores ingresados por el usuario
            $name = $_POST['nameR'];
            $lastName = $_POST['lastNameR'];
            $dateOfBirth = $_POST['dateOfBirthR'];
            $phone = $_POST['phoneR'];
            $country = $_POST['countryR'];
            $city = $_POST['cityR'];
            $studentType = $_POST['studentTypeR'];
            $email = $_POST['emailR'];
            $password = $_POST['passwordR'];
            // "strtolower" se utiliza para convertir la cadena completa en minúsculas antes de aplicar "ucfirst" en caso de que las letras iniciales estén en mayúsculas.
            $nameFormatted = ucfirst(strtolower($name));
            $lastNameFormatted = ucfirst(strtolower($lastName));
            // Convertir el formato de la fecha
            $dateOfBirthFormatted = date('Y-m-d', strtotime(str_replace('/', '-', $dateOfBirth)));
            // Generar el hash de la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Definir la ruta de la imagen predeterminada
            $defaultProfileImage = 'Public/Assets/Img/User-Profile.png';

            $this->userModel->registerUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $studentType, $country, $city, $email, $hashedPassword, $defaultProfileImage);

            // Obtener el ID del usuario recién registrado
            $userId = $this->userModel->getLastInsertId();

            // Establecer las variables de sesión
            session_start();
            $_SESSION['role'] = 'User';
            $_SESSION['name'] = $nameFormatted;
            $_SESSION['userId'] = $userId;
            $_SESSION['profileImage'] = $defaultProfileImage;

            header('Location: ../../../App/View/User/profile.php');
            exit();
        }

    }
}

$userController = new UserController($conn);

if (isset($_GET['register'])) {
    $userController->register();
} else {
    $userController->login();
}
?>