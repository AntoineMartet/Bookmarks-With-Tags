<?php
/**
 * @file     header.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  18.07.2023
 */
?>

<header class="header_section">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
                <span>Bookmarks With Tags</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" <?php echo (isset($_SESSION["loggedEmail"])) ? 'href="../reads.php"' : 'href="../index.php"';?>>
                            <?php echo (isset($_SESSION["loggedEmail"])) ? "Reads" : "Home";?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Displays either the mail with a link to the account page or "Log in" with a link to the login page -->
                        <a class="nav-link" <?php echo (isset($_SESSION["loggedEmail"])) ? 'href="../account.php"' : 'href="../login.php"';?>>
                            <?php echo (isset($_SESSION["loggedEmail"])) ? $_SESSION["loggedEmail"] : "Log in";?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Displays either "Log out" with a link to the logout page (which redirects to the index page)
                        or "Sign in" with a link to the sign in page -->
                        <a class="nav-link" <?php echo (isset($_SESSION["loggedEmail"])) ? 'href="../logout.php"' : 'href="../sign_in.php"';?>>
                            <?php echo (isset($_SESSION["loggedEmail"])) ? "Log out" : "Sign in";?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>