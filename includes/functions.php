<?php
/**
 * @file     functions.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  22.07.2023
 */

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}