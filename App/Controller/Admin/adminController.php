<?php
require_once '../../../App/Config/connection.php';
require_once '../../../App/Model/Admin/adminModel.php';

class AdminController
{
    private $conn;
    private $adminModel;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->adminModel = new AdminModel($this->conn);
    }

    //operations
    public function read()
    {
        return $this->adminModel->showAllUsers();
    }

    public function deleteUserById()
    {
        if (isset($_POST['deleteUserId']) && $_POST['deleteUserId'] === 'true') {
            $userId = $_POST['userId'];
            $this->adminModel->deleteUser($userId);
            exit(); 
        }
    }

    public function updateUserById()
    {
        // Procesar la solicitud de actualización
        if (isset($_POST['updateUserId']) && $_POST['updateUserId'] === 'true') {
            $userId = $_POST['userId'];
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
            $dateOfBirth = isset($_POST['dateOfBirth']) ? $_POST['dateOfBirth'] : null;
            $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;
            $studentTypeId = isset($_POST['studentType']) ? $_POST['studentType'] : null;
            $country = isset($_POST['country']) ? $_POST['country'] : null;
            $city = isset($_POST['city']) ? $_POST['city'] : null;

            // Aplicar el formato necesario a los campos
            $nameFormatted = ucfirst(strtolower($name));
            $lastNameFormatted = ucfirst(strtolower($lastName));
            $dateOfBirthFormatted = date('Y-m-d', strtotime(str_replace('/', '-', $dateOfBirth)));

            // Realizar la actualización en la base de datos
            $result = $this->adminModel->updateUserData($userId, $nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phoneNumber, $studentTypeId, $country, $city);

            // Verificar el resultado de la actualización
            if ($result) {
                // La actualización se realizó con éxito
                http_response_code(200); // Establecer el código de respuesta HTTP 200 (OK)
            } else {
                // Ocurrió un error durante la actualización
                http_response_code(500); // Establecer el código de respuesta HTTP 500 (Internal Server Error)
            }

            exit(); // Terminar la ejecución del script después de procesar la actualización
        }
    }

    public function insertNewAdmin()
    {
        // Procesar la solicitud de creación
        if (isset($_POST['insertNewAdmin']) && $_POST['insertNewAdmin'] === 'true') {
            // Obtener los valores ingresados por el usuario
            $name = $_POST['name'];
            $lastName = $_POST['lastName'];
            $dateOfBirth = $_POST['dateOfBirth'];
            $phone = $_POST['phoneNumber']; // Utilizar 'phoneNumber' en lugar de 'phone'
            $country = $_POST['country'];
            $city = $_POST['city'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profileImage = 'Public/Assets/Img/User-Profile.png';

            // Aplicar el formato necesario a los campos
            $nameFormatted = ucfirst(strtolower($name));
            $lastNameFormatted = ucfirst(strtolower($lastName));
            $dateOfBirthFormatted = date('Y-m-d', strtotime(str_replace('/', '-', $dateOfBirth)));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Realizar la inserción en la base de datos
            $result = $this->adminModel->insertUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $country, $city, $email, $hashedPassword, $profileImage);

            // Verificar el resultado de la inserción
            if ($result) {
                // La inserción se realizó con éxito
                http_response_code(200); // Establecer el código de respuesta HTTP 200 (OK)
            } else {
                // Ocurrió un error durante la inserción
                http_response_code(500); // Establecer el código de respuesta HTTP 500 (Internal Server Error)
            }

            exit(); // Terminar la ejecución del script después de procesar la inserción
        }

    }

}
$adminController = new AdminController($conn);

if (isset($_GET['AddNewAdmin'])) {
    $adminController->insertNewAdmin();
}
if (isset($_GET['updateUserId'])) {
    $adminController->updateUserById();
}
if (isset($_GET['deleteUserId'])) {
    $adminController->deleteUserById();
}
?>