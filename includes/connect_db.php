<?php
/**
 * @file     connect_db.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  16.07.2023
 */

$dsn = "mysql:host=bwt-database.c1vsmfbbxgh8.eu-west-3.rds.amazonaws.com;dbname=bwt-db"; // Data Source Name
$dbPort = "3306";
$dbUsername = "Admin";
$dbPwd = "KuLo670zH7s8";

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

/* Exemple de requête SQL
// SQL pour récupération et affichage des entrées de la table des users
$usersRequest = $pdo->query('SELECT userFirstName, userLastName FROM users');

while ($data = $usersRequest->fetch(PDO::FETCH_ASSOC)) {
    echo implode(" ", $data);
    echo "<br>";
}
*/


