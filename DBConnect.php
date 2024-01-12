<?php

class DBConnect
{
    private static ?DBConnect $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        // Inclusion du fichier db.php
        include 'db.php';

        // Connexion à la base de données MySQL en utilisant les constantes définies dans db.php
        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
        $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    }

    public static function getInstance(): DBConnect
    {
        if (self::$instance === null) {
            self::$instance = new DBConnect();
        }

        return self::$instance;
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
