<?php
require_once '../../../App/Config/connection.php';

class UserController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function login()
    {
        $message = '';
        // Verificar si se ha enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los valores ingresados por el usuario
            $email = $_POST['Email'];
            $password = $_POST['Password'];
    
            // Realizar la consulta para verificar las credenciales
            $stmt = $this->conn->prepare('SELECT * FROM user WHERE Email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();
    
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
                    $stmt = $this->conn->prepare('SELECT MAX(Last_Count) AS MaxCount FROM user_connections WHERE User_ID = :userId');
                    $stmt->bindParam(':userId', $userId);
                    $stmt->execute();
                    $result = $stmt->fetch();
    
                    if ($result['MaxCount']) {
                        // Ya existe un registro para el usuario en user_connections, obtener el siguiente número de Last_Count
                        $lastCount = $result['MaxCount'] + 1;
                    } else {
                        // No existe un registro para el usuario en user_connections, inicializar Last_Count en 1
                        $lastCount = 1;
                    }
    
                    // Insertar el nuevo registro en la tabla user_connections
                    $stmt = $this->conn->prepare('INSERT INTO user_connections (User_ID, Last_Login, Last_Activity, Last_Count) VALUES (:userId, NOW(), NOW(), :lastCount)');
                    $stmt->bindParam(':userId', $userId);
                    $stmt->bindParam(':lastCount', $lastCount);
                    $stmt->execute();
    
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
        // Verificar si se ha enviado el formulario
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
            // User table
            $stmt = $this->conn->prepare('INSERT INTO user (Name, Last_Name, Date_of_Birth, Phone_Number, Student_Type_ID, Country, City, Email, Password,Profile_image, Role_ID) 
            VALUES (:name, :lastName, :dateOfBirth, :phone, :studentTypeID, :country, :city, :email, :password,:profileImage, 2)');
            $stmt->bindParam(':name', $nameFormatted);
            $stmt->bindParam(':lastName', $lastNameFormatted);
            $stmt->bindParam(':dateOfBirth', $dateOfBirthFormatted);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':studentTypeID', $studentType);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':profileImage', $defaultProfileImage);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
            // Obtener el ID del usuario recién registrado
            $userId = $this->conn->lastInsertId();

            // Establecer las variables de sesión
            session_start();
            $_SESSION['role'] = 'User';
            $_SESSION['name'] = $nameFormatted;
            $_SESSION['userId'] = $userId;
            $_SESSION['profileImage']= $defaultProfileImage;


            header('Location: ../../../App/View/User/profile.php');
            exit();
        }
    }
}

// Ejemplo de uso:
require_once '../../../App/Config/connection.php';
$userController = new UserController($conn);

if (isset($_GET['register'])) {
    $userController->register();
} else {
    $userController->login();
}
?>