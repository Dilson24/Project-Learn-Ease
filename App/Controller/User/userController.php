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
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user) {

                if (password_verify($password, $user['Password'])) {
                    $userId = $user['User_ID'];
                    $name = $user['Name'];
                    $profileImage = $user['Profile_Image'];

                    $lastCount = $this->userModel->getMaxUserConnectionCount($userId) + 1;

                    $this->userModel->insertUserConnection($userId, $lastCount);

                    $roleId = $user['Role_ID'];
                    if ($roleId == 1) {

                        session_start();
                        $_SESSION['role'] = 'Admin';
                        $_SESSION['name'] = $name;
                        $_SESSION['profileImage'] = $profileImage;
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

                    $message = 'Contraseña incorrecta';
                }
            } else {
                $message = 'Email no encontrado';
            }
        }

        header('Location: ../../../App/View/User/login.php?message=' . urlencode($message));
        exit();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['nameR'];
            $lastName = $_POST['lastNameR'];
            $dateOfBirth = $_POST['dateOfBirthR'];
            $phone = $_POST['phoneR'];
            $country = $_POST['countryR'];
            $city = $_POST['cityR'];
            $studentType = $_POST['studentTypeR'];
            $email = $_POST['emailR'];
            $password = $_POST['passwordR'];
            $nameFormatted = ucfirst(strtolower($name));
            $lastNameFormatted = ucfirst(strtolower($lastName));
            $dateOfBirthFormatted = date('Y-m-d', strtotime(str_replace('/', '-', $dateOfBirth)));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $defaultProfileImage = 'Public/Assets/Img/User-Profile.png';

            $this->userModel->registerUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $studentType, $country, $city, $email, $hashedPassword, $defaultProfileImage);

            $userId = $this->userModel->getLastInsertId();

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