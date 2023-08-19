<?php
/**
 * @file     manage_tags.php
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

    <title>Manage tags - Bookmarks With Tags</title>
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
    $tag = "";
    $tagErr = "";
    $noTagsMessage = "";
    $tagOK = false;

    $userRequest = $pdo->query("SELECT * FROM users WHERE mail ='" . $_SESSION['loggedEmail'] . "'");
    $user = $userRequest->fetch(PDO::FETCH_ASSOC); // return false if nothing is found

    $tagsRequest = $pdo->query("SELECT * FROM tags WHERE userFK ='" . $user['id'] . "'");
    $tags = $tagsRequest->fetch(PDO::FETCH_ASSOC); // return false if nothing is found

    if(!$tags){
        $noTagsMessage = "For the moment, you don't have any tags.";
    }

    // checking that the tag is indeed new
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newTag = $_POST['tag'];
    }

    foreach ($tags as $tag) {
        echo "<pre>";
        var_dump($tag);
        echo "</pre>";
    }
    ?>

    <section class="contact_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    You can add or delete tags here, <?= $user['username'] ?>!<br>
                </h2>
                <p>
                    <?= $noTagsMessage ?>
                </p>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div>
                                <span class="error"><?php echo $tagErr;?></span>
                                <input type="text" name="tag" placeholder="New tag name" value=""/>
                            </div>
                            <div class="btn_box">
                                <button>
                                    ADD THIS TAG
                                </button>
                            </div>
                        </form>
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
