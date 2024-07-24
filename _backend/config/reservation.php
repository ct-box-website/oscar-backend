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


}


?>