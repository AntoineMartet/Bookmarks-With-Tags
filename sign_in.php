<?php
/**
 * @file     sign_in.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  19.07.2023
 */
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>Sign in - Bookmarks With Tags</title>
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

<div class="hero_area">
    <?php include "includes/header.php";?>
</div>

<?php

include "includes/connect_db.php";

// define variables and set to empty values
$username = $email = $pwd = $pwdRepeat = "";
$usernameErr = $emailErr = $pwdErr = $pwdRepeatErr = "";
$usernameOK = $emailOK = $pwdOK = $pwdRepeatOK = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        // check if name only contains letters and numbers
        if (!preg_match("/^[a-zA-Z0-9_\-]{2,20}$/", $username)) {
            $usernameErr = "Needs 2 to 20 characters. Only letters, numbers, - and _ allowed.";
        } else {
            $usernameOK = true;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.";
        } else {
            $emailOK = true;
        }
    }

    if (empty($_POST["pwd"])) {
        $pwdErr = "Password is required.";
    } else {
        // check if password meets requirements
        $pwd = $_POST["pwd"];
        var_dump($pwd);
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$^&*()_-]).{8,18}$/", $pwd)) {
            $pwdErr = "Needs at least 8 characters and at least 1 small letter, 1 capital letter and 1 number.";
        } else {
            $pwdOK = true;
        }
    }

    if (empty($_POST["pwdRepeat"])) {
        $pwdRepeatErr = "Repeating password is required.";
    } else {
        // check if password meets requirements
        $pwdRepeat = $_POST["pwdRepeat"];
        var_dump($pwdRepeat);
        if ($pwdRepeat != $pwd) {
            $pwdRepeatErr = "The two passwords must be the same.";
        } else {
            $pwdRepeatOK = true;
        }
    }

    if ($usernameOK && $emailOK && $pwdOK && $pwdRepeatOK) {
        $sqlInsertNewUser = "insert into users (mail,username,pwd,creationDate) values ('".$email."','".$username."','".$pwd."','".date("Y-m-d H:i:s")."')";
        $pdo->exec($sqlInsertNewUser);
    }


}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

    <section class="contact_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Sign in to use Bookmarks With Tags
                </h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div>
                                <span class="error"><?php echo $usernameErr;?></span>
                                <input type="text" name="username" placeholder="Your Username" value="<?php if($username != ""){ echo $username;}?>"/>
                            </div>
                            <div>
                                <span class="error"><?php echo $emailErr;?></span>
                                <input type="email" name="email" placeholder="Your Email" value="<?php if($email != ""){ echo $email;}?>"/>
                            </div>
                            <div>
                                <span class="error"><?php echo $pwdErr;?></span>
                                <input type="password" name="pwd" placeholder="Your Password" />
                            </div>
                            <div>
                                <span class="error"><?php echo $pwdRepeatErr;?></span>
                                <input type="password" name="pwdRepeat" placeholder="Repeat Password" />
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

<?php include "includes/footer.php";?>