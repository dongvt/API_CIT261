<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASSWORD", "Govert@123");
define("DB_DATABASE", "php_api");
define("DB_PORT", 3308);

class Connection {
    public function con() {
        //Database connection
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE,DB_PORT) or die("Connect failed");
        return $conn;
    }
}

?>