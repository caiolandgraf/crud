<?php

namespace SK\DB;

class Sql{

    private $conn;

    public function __construct(){
        $this->conn = new \PDO(
            "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST,
            DB_USER,
            DB_PASS
        );
    }

    private function setParams($stmt, $params = array())
    {
        foreach ($params as $key => $value) {
            $this->bindParam($stmt, $key, $value);
        }
    }

    private function bindParam($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
    }

    public function select($rawQuery, $params = array()) :array
    {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}