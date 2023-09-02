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

if($_SESSION["loggedEmail"] == null){
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title>Add a Read - Bookmarks With Tags</title>
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
    // values for the form fields
    $url = $title = $description = $length = $tags = "";
    // error messages for the form fields
    $urlErr = $titleErr = $lengthErr = $tagsErr = "";
    // flags to check form fields validity
    $urlOK = $titleOK = $lengthOK = $tagsOK = false;

    // checking validity of all the form fields
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... Checker tous les inputs avant d'envoyer à la BDD
        // ...

        // Check presence and validity or URL
        if(empty($_POST['url'])){
            $urlErr = "URL is required";
        } else {
            $url = test_input($_POST['url']);
            if(!filter_var($url, FILTER_VALIDATE_URL)){
                $urlErr = "This is not a valid URL";
            } else {
                $urlOK = true;
            }
        }

        // Check existence of Title
        if(empty($_POST['title'])){
            $titleErr = "Title is required";
        } else {
            $title = test_input($_POST['title']);
            $titleOK = true;
        }

        $description = test_input($_POST['description']);

        // Check a length choice has been made
        if(empty($_POST['length'])){
            $lengthErr = "Length is required";
        } else {
            $length = test_input($_POST['length']);
            $lengthOK = true;
        }

        if(empty($_POST['tags'])){
            $tagsErr = "At least two tags are required";
        } else {
            $tags = explode(',', $_POST['tags']);
            // count($tags) isn't good because user could write "politics," or "politics,,,," to have 2 or 5 tags for example
            $tagCount = 0;
            // counting "real" tags
            foreach ($tags as $tag){
                if($tag != ""){
                    $tagCount += 1;
                    if($tagCount >= 2){
                        break;
                    }
                }
            }
            if($tagCount < 2){
                $tagsErr = "Please add at least a second tag";
            } else {
                $tagsOK = true;
            }
        }

        // inserts the read data in the DB
        if($urlOK && $titleOK && $lengthOK && $tagsOK){
            // Getting User ID from his mail
            $userIdRequest = $pdo->query("SELECT id FROM users WHERE mail ='" . $_SESSION["loggedEmail"] . "'");
            $userId = $userIdRequest->fetch(PDO::FETCH_ASSOC); // Return false if nothing is found
            // "reads" is a reserved keyword in MySQL. By adding the backticks around the table name "reads", we inform MySQL that it's a table name and not a keyword.
            $sqlInsertNewRead = "insert into `reads` (url,title,creationDate,description,length,readingStatus,userFK)
            values ('$url','$title','" . date("Y-m-d H:i:s") . "','$description','$length','read','" . $userId["id"] . "')";
            $pdo->exec($sqlInsertNewRead);
            header('Location: reads.php');
            exit();
        }
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
                                <input type="text" name="description" placeholder="Description or notes about the Read..."/>
                            </div>
                            <div>
                                <span class="error"><?php echo $lengthErr . "<br>";?></span>
                                <select name="length">
                                    <option value="">--Length of the read--</option>
                                    <option value="short">< 10 minutes (short)</option>
                                    <option value="medium">10 - 30 minutes (medium)</option>
                                    <option value="long">30 - 60 minutes (long)</option>
                                    <option value="x-long">> 60 minutes (extra-long)</option>
                                </select>
                            </div>
                            <div>
                                <span class="error"><?php echo "<br>" . $tagsErr;?></span>
                                <input type="text" name="tags" placeholder="Séparez vos tags par des virgules : cinéma, james bond..."
                            </div>
                            <div class="btn_box">
                                <button>
                                    ADD THIS READ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "includes/footer.php";?>

    <!-- jQuery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>

</body>

</html>