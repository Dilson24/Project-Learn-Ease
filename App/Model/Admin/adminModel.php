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

    public function updateUser($userId, $name = null, $lastName = null, $dateOfBirth = null, $phoneNumber = null, $studentTypeId = null, $country = null, $city = null)
    {
        $sql = 'UPDATE user SET ';
        $params = array();

        if ($name !== null) {
            $sql .= 'Name = :name, ';
            $params[':name'] = $name;
        }

        if ($lastName !== null) {
            $sql .= 'Last_Name = :lastName, ';
            $params[':lastName'] = $lastName;
        }

        if ($dateOfBirth !== null) {
            $sql .= 'Date_of_Birth = :dateOfBirth, ';
            $params[':dateOfBirth'] = $dateOfBirth;
        }

        if ($phoneNumber !== null) {
            $sql .= 'Phone_Number = :phoneNumber, ';
            $params[':phoneNumber'] = $phoneNumber;
        }

        if ($studentTypeId !== null) {
            $sql .= 'Student_Type_ID = :studentTypeId, ';
            $params[':studentTypeId'] = $studentTypeId;
        }

        if ($country !== null) {
            $sql .= 'Country = :country, ';
            $params[':country'] = $country;
        }

        if ($city !== null) {
            $sql .= 'City = :city, ';
            $params[':city'] = $city;
        }

        // Eliminar la última coma y espacio de la consulta SQL
        $sql = rtrim($sql, ', ');

        $sql .= ' WHERE User_ID = :userId';
        $params[':userId'] = $userId;

        // Ejecutar la consulta
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($params)) {
            // La consulta se ejecutó exitosamente
            return true;
        } else {
            // Hubo un error en la ejecución de la consulta
            return false;
        }
    }
}
?>