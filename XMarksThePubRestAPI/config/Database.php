<?php

/**
 * database short summary.
 *
 * database description.
 *
 * @version 1.0
 * @author kadua
 */
class Database
{
    // specify your own database credentials
    private $server = "xmarksthepub.database.windows.net";
    private $db_name = "XMarksThePub";
    private $username = "drinknsmoke@xmarksthepub";
    private $password = "1Tb4pgOO5XdG";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("sqlserver:server=" . $this->server. ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }
        catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>