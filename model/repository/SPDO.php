<?php

namespace Model\repository;

class SPDO
{
    private $PDOInstance = null;
    private static $instance = null;

    private function __construct()
    {
        try {
            $this->PDOInstance = new \PDO("mysql:host=localhost:3306;dbname=offres", "root", "");
            $this->PDOInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDOInstance->exec("SET NAMES UTF8");
        } catch (\PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function getPDO()
    {
        return $this->PDOInstance;
    }
}
?>
