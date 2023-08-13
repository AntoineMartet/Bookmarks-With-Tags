<?php
/**
 * @file     reads.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  17.07.2023
 */

session_start();
include "includes/connect_db.php";
include "includes/functions.php";
?>


<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title>Reads - Bookmarks With Tags</title>
    <link rel="icon" href="images/fevicon.png" type="image/gif"/>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet"/>

</head>

<body>

    <div class="hero_area">
        <?php include "includes/header.php" ?>
    </div>

    <?php
    $userRequest = $pdo->query("SELECT * FROM users WHERE mail ='" . $_SESSION['loggedEmail'] . "'");
    $user = $userRequest->fetch(PDO::FETCH_ASSOC); // return false if nothing is found
    ?>


    <h1>Welcome to your reading space, <?= $user['username'] ?>!</h1>

    <section class="about_section layout_padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <a href="add_read.php">
                            Add a Read
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <a href="">
                            Manage your tags
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php include "includes/footer.php";?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>

</body>

</html>