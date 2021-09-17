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


        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            //connnection to database
            $this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit('Error connecting to database');
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
