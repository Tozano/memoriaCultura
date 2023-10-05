<?php
require_once dirname(__DIR__).'/config/local.config.php';

    function getConnection() {
        try{
            $pdo = new PDO('mysql:host='.$config['serveur'].';dbname='.$config['bd'],$config['login'],$config['mdp']);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
        } catch(Exception $e) {
            echo "Impossible d'accéder à la base de données mysql : ".$e->getMessage();
            die();
        }
        return $pdo;
    }
    
    function createTables() {
        $pdo = getConnection();
        $pdo->query("CREATE TABLE IF NOT EXISTS USER (
            user_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            pseudo VARCHAR(255) NOT NULL UNIQUE,
            mdp VARCHAR(255) NOT NULL, 
            email VARCHAR(255) NOT NULL,
            nom VARCHAR(255) NOT NULL,
            prenom VARCHAR(255) NOT NULL,
            short_desc VARCHAR(255) NOT NULL,
            long_desc TEXT NULL,
            user_role INTEGER NOT NULL DEFAULT 0)");

        $pdo->query("CREATE TABLE IF NOT EXISTS CONTENT (
            content_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            created_datetime DATETIME NOT NULL,
            title VARCHAR(255) NOT NULL,
            content_desc TEXT NOT NULL,
            content_address VARCHAR(255) NOT NULL,
            startYear VARCHAR(4) NOT NULL,
            user_id INTEGER NOT NULL,
            FOREIGN KEY (`user_id`) REFERENCES `USER` (`user_id`))");

        $pdo = closeConnection($pdo);
    }

    function closeConnection($pdo) {
        $pdo = null;

        return $pdo;
    }
?>