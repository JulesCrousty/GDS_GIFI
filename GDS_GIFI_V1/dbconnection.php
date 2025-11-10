<?php
/**
 * Point d'entrée unique pour préparer la connexion PDO à la base de données.
 *
 * Aucune connexion n'est réalisée si les variables d'environnement ne sont pas
 * renseignées afin de permettre l'utilisation de l'interface en mode déconnecté.
 */

function getDatabaseConnection(): ?PDO
{
    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPass = getenv('DB_PASSWORD');
    $dbPort = getenv('DB_PORT');

    $dbHost = $dbHost !== false && $dbHost !== '' ? $dbHost : '192.168.1.155';
    $dbName = $dbName !== false && $dbName !== '' ? $dbName : 'appdb';
    $dbUser = $dbUser !== false && $dbUser !== '' ? $dbUser : 'root';
    $dbPass = $dbPass !== false ? $dbPass : 'example';
    $dbPort = $dbPort !== false && $dbPort !== '' ? $dbPort : '1001';

    if (!$dbHost || !$dbName || !$dbUser) {
        return null;
    }

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $dbHost, $dbPort, $dbName);

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        return new PDO($dsn, $dbUser, $dbPass ?: '', $options);
    } catch (PDOException $exception) {
        error_log('Connexion à la base impossible : ' . $exception->getMessage());
        return null;
    }
}
