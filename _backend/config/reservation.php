<?php

class Reservation
{
    private $connection;
    private $table_name = 'reservation';


    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function read()
    {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readLimt()
    {
        $limit = $_GET['limit'];
        $page = $_GET['page'];
        $start = ($page - 1) * $limit;
        $query = "SELECT * FROM {$this->table_name} LIMIT {$start}, {$limit}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readCount()
    {
        $query = "SELECT COUNT(id) as id FROM {$this->table_name}";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }


}


?>