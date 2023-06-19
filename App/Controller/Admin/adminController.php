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

    public function deleteUserById($userId) {
        return $this->adminModel->deleteUser($userId);
    }

    public function updateUserById($userId, $nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phoneNumber, $studentType, $country, $city)
    {
        $result = $this->adminModel->updateUserData($userId, $nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phoneNumber, $studentType, $country, $city);
        return $result;
    }

    public function insertNewUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $country, $city, $email, $hashedPassword, $profileImage){
        $result = $this->adminModel->insertUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $country, $city, $email, $hashedPassword, $profileImage);
        return $result;
    }
    
    
}