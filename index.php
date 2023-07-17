<?php
/**
 * @file     index.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  14.07.2023
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Login</title>
    <!--<link rel="stylesheet" href="css/style.css">-->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
</head>
<body>
    <div>
        <h2>Bienvenue sur Bookmarks With Tags :</h2>
    </div>
</body>
</html>

<?php
include 'connect_db.php';


// SQL pour récupération de la table des users
$usersRequest = $pdo->query('SELECT * FROM users');

while ($data = $usersRequest->fetch(PDO::FETCH_ASSOC)) {
    echo implode(" ", $data);
    echo "<br>";
}
?>