<?php
class AdminModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function showAllUsers()
    {
        $stmt = $this->conn->prepare('SELECT * FROM user');
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function deleteUser($userId)
    {
        $stmt = $this->conn->prepare('DELETE FROM user_connections WHERE User_ID = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare('DELETE FROM user WHERE User_ID = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function updateUserData($userId, $nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phoneNumber, $studentTypeId, $country, $city)
    {
        $updateFields = "";

        if ($nameFormatted) {
            $updateFields .= "Name = :name, ";
        }
        if ($lastNameFormatted) {
            $updateFields .= "Last_Name = :lastName, ";
        }
        if ($dateOfBirthFormatted) {
            $updateFields .= "Date_of_Birth = :dateOfBirth, ";
        }
        if ($phoneNumber) {
            $updateFields .= "Phone_Number = :phoneNumber, ";
        }
        if ($studentTypeId) {
            $updateFields .= "Student_Type_ID = :studentType, ";
        }
        if ($country) {
            $updateFields .= "Country = :country, ";
        }
        if ($city) {
            $updateFields .= "City = :city, ";
        }

        $updateFields = rtrim($updateFields, ", ");

        if (!empty($updateFields)) {

            $sql = "UPDATE user SET $updateFields WHERE User_ID = :userId";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':userId', $userId);
            if ($nameFormatted)
                $stmt->bindParam(':name', $nameFormatted);
            if ($lastNameFormatted)
                $stmt->bindParam(':lastName', $lastNameFormatted);
            if ($dateOfBirthFormatted)
                $stmt->bindParam(':dateOfBirth', $dateOfBirthFormatted);
            if ($phoneNumber)
                $stmt->bindParam(':phoneNumber', $phoneNumber);
            if ($studentTypeId)
                $stmt->bindParam(':studentType', $studentTypeId);
            if ($country)
                $stmt->bindParam(':country', $country);
            if ($city)
                $stmt->bindParam(':city', $city);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function insertUser($nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phone, $country, $city, $email, $hashedPassword, $profileImage)
    {
        $stmt = $this->conn->prepare('INSERT INTO user (Name, Last_Name, Date_of_Birth, Phone_Number, Student_Type_ID, Country, City, Email, Password, Profile_image, Role_ID) 
        VALUES (:name, :lastName, :dateOfBirth, :phone, 4, :country, :city, :email, :password, :profileImage, 1)');
        $stmt->bindParam(':name', $nameFormatted);
        $stmt->bindParam(':lastName', $lastNameFormatted);
        $stmt->bindParam(':dateOfBirth', $dateOfBirthFormatted);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':profileImage', $profileImage);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>