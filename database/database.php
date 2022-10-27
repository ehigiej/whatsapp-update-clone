<?php 
$confiq = require_once "confiq/confiq.php"; //Get Database configuration files;
/* DATABASE CONNECTION CLASS */
class Connection {
    public static function make($confiq) {
        /* takes database configuration and try a connection to database */
        try {
            return new PDO(
                "mysql:host=" . $confiq["host"] . ";port=" . $confiq["port"] . ";dbname=" . $confiq["dbname"],
                $confiq["username"],
                $confiq["password"]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

return Connection::make($confiq["database"]);
?>