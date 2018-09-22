<?php

class Task
{
    private $conn;
    private $table_name = "tasks";
    public $id;
    public $name;
    public $deleted;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT t.id, t.name, t.deleted
                  FROM " . $this->table_name . " t
                  ORDER BY t.id DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . 
                $this->table_name . 
                " SET  name=:name;";

        $stmt = $this->conn->prepare($query);
        
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":name", $this->name);
 
        if ($stmt->execute())
        {
            return $this->conn->lastInsertId();
        }

        return false;
    }
    
    function update(){
        $query = "UPDATE " . $this->table_name . 
                " SET deleted = :deleted
                  WHERE id = :id";
 
        $stmt = $this->conn->prepare($query);

        $this->deleted = htmlspecialchars(strip_tags($this->deleted));
        $this->id = htmlspecialchars(strip_tags($this->id));
 
        $stmt->bindParam(':deleted', $this->deleted);
        $stmt->bindParam(':id', $this->id);
 
        if($stmt->execute()){
            return true;
        }
 
        return false;
    }
    
    function delete(){
 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $this->id=htmlspecialchars(strip_tags($this->id));
 
        $stmt->bindParam(1, $this->id);
 
        if($stmt->execute()){
            return true;
        }
 
        return false;
    }
}
