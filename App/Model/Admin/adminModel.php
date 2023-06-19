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
        $stmt = $this->conn->prepare('DELETE FROM user WHERE User_ID = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function updateUserData($userId, $nameFormatted, $lastNameFormatted, $dateOfBirthFormatted, $phoneNumber, $studentType, $country, $city)
    {
        // Crear una cadena para almacenar las cláusulas SET de la consulta UPDATE
        $updateFields = "";

        // Verificar cada campo y agregarlo a la cadena si tiene un valor
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
        if ($studentType) {
            $updateFields .= "Student_Type_ID = :studentType, ";
        }
        if ($country) {
            $updateFields .= "Country = :country, ";
        }
        if ($city) {
            $updateFields .= "City = :city, ";
        }

        // Eliminar la coma y el espacio final de la cadena
        $updateFields = rtrim($updateFields, ", ");

        // Verificar si se proporcionaron datos para actualizar
        if (!empty($updateFields)) {
            // Consulta SQL para actualizar los datos del usuario
            $sql = "UPDATE user SET $updateFields WHERE User_ID = :userId";

            $stmt = $this->conn->prepare($sql);

            // Vincular los parámetros
            $stmt->bindParam(':userId', $userId);
            if ($nameFormatted)
                $stmt->bindParam(':name', $nameFormatted);
            if ($lastNameFormatted)
                $stmt->bindParam(':lastName', $lastNameFormatted);
            if ($dateOfBirthFormatted)
                $stmt->bindParam(':dateOfBirth', $dateOfBirthFormatted);
            if ($phoneNumber)
                $stmt->bindParam(':phoneNumber', $phoneNumber);
            if ($studentType)
                $stmt->bindParam(':studentType', $studentType);
            if ($country)
                $stmt->bindParam(':country', $country);
            if ($city)
                $stmt->bindParam(':city', $city);

            if ($stmt->execute()) {
                return true; // Actualización exitosa
            } else {
                return false; // Error al actualizar
            }
        } else {
            return false; // No se proporcionaron datos para actualizar
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
            return true; // Insert exitoso
        } else {
            return false; // Error
        }
    }
}
?>