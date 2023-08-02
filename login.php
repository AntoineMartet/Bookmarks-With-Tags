<?php
/**
 * @file     login.php
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

    <title>Login - Bookmarks With Tags</title>
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
        <?php include "includes/header.php";?>
    </div>

    <?php

    // define variables and set to empty values
    $email = $pwd = "";
    $emailErr = $pwdErr = "";
    $emailOK = $pwdOK = false;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST["pwd"])) {
            $pwdErr = "Password is required.";
        } else {
            $pwd = $_POST["pwd"];
        }

        if ($email != "" && $pwd != "") {
            checkAccountInDb($email, $pwd);
        }
    }

    function checkAccountInDb($mailAddress, $password) {
        global $pdo; // Obligatoire car on est dans une fonction
        global $emailErr;
        global $pwdErr;
        $userRequest = $pdo->query("SELECT * FROM users WHERE mail ='" . $mailAddress . "'");
        $user = $userRequest->fetch(PDO::FETCH_ASSOC); // Return false if nothing is found
        // Si mail found in BDD, check if password entered is the same as in the DB
        if($user){
            /* echo '<pre>';
            var_dump($user);
            echo '</pre>'; */

            if($password == $user['pwd']){
                $_SESSION["loggedEmail"] = $mailAddress;
                header('Location: reads.php');
            } else {
                $pwdErr = "Incorrect password.";
            }
        } else {
            $emailErr = "No account is linked to this address.";
        }
    }

    ?>

    <section class="contact_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Log in to your Bookmarks With Tags account
                </h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div>
                                <span class="error"><?php echo $emailErr;?></span>
                                <input type="email" name="email" placeholder="Your Email" value="<?php if($email != ""){ echo $email;}?>"/>
                            </div>
                            <div>
                                <span class="error"><?php echo $pwdErr;?></span>
                                <input type="password" name="pwd" placeholder="Your Password" />
                            </div>
                            <div class="btn_box ">
                                <button>
                                    Log in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<?php include "includes/footer.php"; ?>