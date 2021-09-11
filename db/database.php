<?php


include_once 'config.php';

class Database extends Config
{
    /*
    function __construct()
    {
    }
*/
    private $conn = null;

    public function connection()
    {
        //$config = new Config();

        // Create connection to database
        $this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

        // Check connection
        if ($this->conn->connect_error) {
            echo "Database does not exist <br>";
            // Create connection
            $this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        return $this->conn;
    }

    public function getDbName()
    {
        return $this->db_name;
    }

    public function close()
    {
        $this->conn->close();
    }
}
