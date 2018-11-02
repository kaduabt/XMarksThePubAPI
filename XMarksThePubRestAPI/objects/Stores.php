<?php

/**
 * Stores short summary.
 *
 * Stores description.
 *
 * @version 1.0
 * @author kadua
 */

class Store
{

    // database connection and table name
    private $conn;
    private $table_name = "stores";

    // object properties
    public $s_id;
    public $s_name;
    public $s_type;
    public $s_latitude;
    public $s_longitude;
    public $s_address;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){

        // select all query
        $query = "SELECT
                stores.s_name, stores.s_address, stores.s_latitude, stores.s_longitude,stores.s_type, openinghours.oh_day, openinghours.oh_oh, openinghours.oh_ch
            FROM
                " . $this->table_name . " 
                INNER JOIN
                    openinghours
                        ON stores.s_id=openinghours.s_oh_id"


        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}



?>
