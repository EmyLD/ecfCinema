<?php

namespace Model\repository;

use Model\repository\SPDO;

abstract class Dao
{
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = SPDO::getInstance()->getPDO();
        } catch (\Exception $e) {
            echo "Problème de connexion à la base de données ...";
            die();
        }
    }
}
?>
