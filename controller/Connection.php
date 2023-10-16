<?php
namespace CRUD;
use PDO;
class Connection
{
    public static function Connection()
    {
        $connection = new PDO("mysql:host=localhost;dbname=crud;", "root", "root");

        return $connection;
    }
}

?>