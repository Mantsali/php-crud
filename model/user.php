<?php
include_once "../db/database.php";

class User
{

    public $userId;
    public $fullname;
    public $username;
    public $email;
    public $passwd;
    private $table = "users";
    public function __construct()
    {
    }

    public function userExists()
    {
        $conn = $this->getConn();
        $sql = "SELECT userId, username, passwd FROM " . $this->table . " WHERE username = ? OR email = ?";

        $stmt = $conn->prepare($sql);


        $stmt->bind_param("ss", $this->username, $this->email);

        $stmt->execute();
        $stmt->store_result();
        //$result = $stmt->get_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($this->userId, $this->username, $this->passwd);
            $stmt->fetch();
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
        $conn->close();
    }

    public  function createUser()
    {
        $conn = $this->getConn();

        $sql = "INSERT INTO " . $this->table . " (fullname, username, email, passwd)
        VALUES (?,?,?,?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $this->fullname, $this->username, $this->email,  $this->passwd);

            $stmt->execute();
            $stmt->close();
            $conn->close();
            return "New record created successfully";
        } catch (Exception $e) {
            if ($conn->errno === 1062) return 'Username / email already exists';
        }
    }


    private function getConn()
    {
        $db = new Database();
        return $db->connection();
    }
}
