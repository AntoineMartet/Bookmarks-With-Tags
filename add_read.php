<?php
/**
 * @file     add_read.php
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Add a Read - Bookmarks With Tags</title>
    <link rel="icon" href="images/fevicon.png" type="image/gif" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

    <div class="hero_area">
        <?php include "includes/header.php" ?>
    </div>

    <?php
    $userRequest = $pdo->query("SELECT * FROM users WHERE mail ='" . $_SESSION['loggedEmail'] . "'");
    $user = $userRequest->fetch(PDO::FETCH_ASSOC); // Return false if nothing is found

    // define variables and set to empty values
    $url = $title = $description = $length = "";
    $urlErr = $titleErr = $descriptionErr = $lengthErr = "";
    $urlOK = $titleOK = $descriptionOK = $lengthOK = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... Checker tous les inputs avant d'envoyer à la BDD
        // ...
    }
    ?>

    <section class="contact_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Please enter the details of your Read, <?= $user['username'] ?>!
                </h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div>
                                <span class="error"><?php echo $urlErr;?></span>
                                <input type="url" name="url" placeholder="URL address" value="<?php if($url != ""){ echo $url;}?>"/>
                            </div>
                            <div>
                                <span class="error"><?php echo $titleErr;?></span>
                                <input type="text" name="title" placeholder="Title" value="<?php if($title != ""){ echo $title;}?>"/>
                            </div>
                            <div>
                                <span class="error"><?php echo $descriptionErr;?></span>
                                <input type="text" name="description" placeholder="Description or notes about the Read..." />
                            </div>
                            <div>
                                <span class="error"><?php echo $lengthErr;?></span>
                                <input type="text" name="length" placeholder="Length of the Read (in minutes)" />
                            </div>
                            <div class="btn_box ">
                                <button>
                                    SIGN IN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <?php include "includes/footer.php"?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>