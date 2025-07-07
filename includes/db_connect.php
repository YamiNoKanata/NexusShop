<?php
// Project/includes/db_connect.php
$envFile = __DIR__ . '/../db-con.env';

if (file_exists($envFile)) {
    $env = parse_ini_file($envFile);
} else {
    die("Datenbank-Konfigurationsdatei nicht gefunden");
}

try {
    $dsn = "pgsql:host={$env['host']};port={$env['port']};dbname={$env['dbname']}";
    $pdo = new PDO($dsn, $env['user'], $env['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}
?>
