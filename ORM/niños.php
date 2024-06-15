<?php
class Niño extends Orm
{
    private $conn;

    function __construct(PDO $connection)
    {
        parent::__construct('id', 'niños', $connection);
        $this->conn = $connection;  // Fix the variable name here
    }

    public function getByPadreId($padreId)
    {
        $query = "SELECT * FROM niños WHERE id_padre = :padreId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':padreId', $padreId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
