<?php 
class Doctor extends Orm{
    function __construct(PDO $connection){
        parent::__construct('id','doctores',$connection);
    }
}
?>