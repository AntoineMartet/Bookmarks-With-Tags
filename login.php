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
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <title>Login - Bookmarks With Tags</title>
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
        <?php include "includes/header.php";?>
    </div>

    <?php

    // values for the form fields
    $email = $pwd = "";
    // error messages for the form fields
    $emailErr = $pwdErr = "";
    // flags to check form fields validity
    $emailOK = $pwdOK = false;

    // checking validity of all the form fields
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

    function checkAccountInDb($mailAddress, $password)
    {
        // "global" mandatory because we're in a function
        global $pdo;
        global $emailErr;
        global $pwdErr;
        $userRequest = $pdo->query("SELECT * FROM users WHERE mail ='$mailAddress'");
        $user = $userRequest->fetch(PDO::FETCH_ASSOC); // return false if nothing is found

        // if mail found in BDD, check if password entered is the same as in the DB
        if ($user) {
            /* echo '<pre>';
            var_dump($user);
            echo '</pre>'; */

            if ($password == $user['pwd']) {
                $_SESSION["loggedEmail"] = $mailAddress;
                header('Location: reads.php');
                exit();
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
                                <input type="password" name="pwd" placeholder="Your Password"/>
                            </div>
                            <div class="btn_box">
                                <button>
                                    LOG IN
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