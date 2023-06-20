<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare('SELECT * FROM user WHERE Email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getMaxUserConnectionCount($userId)
    {
        $stmt = $this->conn->prepare('SELECT MAX(Last_Count) AS MaxCount FROM user_connections WHERE User_ID = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['MaxCount'] ? $result['MaxCount'] : 0;
    }

    public function insertUserConnection($userId, $lastCount)
    {
        $stmt = $this->conn->prepare('INSERT INTO user_connections (User_ID, Last_Login, Last_Activity, Last_Count) VALUES (:userId, NOW(), NOW(), :lastCount)');
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':lastCount', $lastCount);
        $stmt->execute();
    }

    public function registerUser($name, $lastName, $dateOfBirth, $phone, $studentType, $country, $city, $email, $password, $profileImage)
    {
        $stmt = $this->conn->prepare('INSERT INTO user (Name, Last_Name, Date_of_Birth, Phone_Number, Student_Type_ID, Country, City, Email, Password, Profile_image, Role_ID) 
        VALUES (:name, :lastName, :dateOfBirth, :phone, :studentType, :country, :city, :email, :password, :profileImage, 2)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':studentType', $studentType);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':profileImage', $profileImage);
        $stmt->execute();
    }
    public function getLastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
?>
