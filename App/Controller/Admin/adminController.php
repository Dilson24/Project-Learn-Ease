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

    public function updateUserById($userId, $name, $lastName, $dateOfBirth, $phoneNumber, $studentType, $country, $city)
    {
        $result = $this->adminModel->updateUserData($userId, $name, $lastName, $dateOfBirth, $phoneNumber, $studentType, $country, $city);
        return $result;
    }
    
    
}