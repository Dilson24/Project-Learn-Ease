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
    public function deleteUser($userId) {
        $stmt = $this->conn->prepare('DELETE FROM user WHERE User_ID = :userId');
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
    
    

}
?>