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
    $_SESSION['loggedUser'] = $user;

    /* The fetch() method retrieves only one row from the result set at a time.
    By using the fetchAll() method, you'll get an array containing all the rows from the result set.
    Then, you can iterate through this array using a loop (in this case, a foreach loop) to display each row's data. */
    $readsRequest = $pdo->query("SELECT * FROM `reads` WHERE userFK ='" . $user['id'] . "'");
    $reads = $readsRequest->fetchAll(PDO::FETCH_ASSOC); // return false if nothing is found

    foreach ($reads as $read) {
        echo "<pre>";
        var_dump($read);
        echo "</pre>";
    }
    ?>




    <section class="about_section layout_padding-bottom">
        <div class="container">
            <h1>Welcome to your reading space, <?= $user['username'] ?>!</h1>
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
                        <a href="manage_tags.php">
                            Manage your tags
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Length</th>
                    <th scope="col">Link</th>
                    <th scope="col">Tags</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($reads as $read) {
                    echo '<tr>';
                    echo '  <td>' . $read["creationDate"] . '</td>
                            <th scope="row">' . $read["title"] . '</th>
                            <td>' . $read["description"] . '</td>
                            <td>' . $read["length"] . '</td>
                            <td><a href="' . $read["url"] . '" target="_blank">' . $read["url"] . '</a></td>
                            <td>tags...</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>


    <?php include "includes/footer.php";?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>

</body>

</html>