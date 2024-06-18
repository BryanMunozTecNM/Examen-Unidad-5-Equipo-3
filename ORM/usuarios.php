<?php
class Usuario extends Orm
{
    function __construct(PDO $connection)
    {
        parent::__construct('id', 'usuarios', $connection);
    }
}
