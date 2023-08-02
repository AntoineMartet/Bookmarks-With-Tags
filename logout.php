<?php
/**
 * @file     logout.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  02.08.2023
 */

session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
header('Location: index.php');
?>

</body>
</html>