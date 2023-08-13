<?php
/**
 * @file     index.php
 * @brief    File description
 * @author   Created by AntoineM
 * @version  14.07.2023
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

    <title>Bookmarks With Tags</title>
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
        <!-- slider section : deleted -->
    </div>

    <!-- service section : deleted -->

    <!-- about section -->
    <section class="about_section layout_padding-bottom">
        <div class="container  ">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                About Bookmarks With Tags
                            </h2>
                        </div>
                        <p>
                            BWT allows you to bookmark your past reads on the internet and to attach to them tags
                            so you can find them later more easily.
                            Filter your reads by date, name, tags, length... Create reading lists based on past, actual or
                            future reads.</p>
                        <a href="">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="img-box">
                        <img src="images/DALL·E 2023-07-18 19.10.46 - truncated.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end about section -->

    <!-- server section : deleted-->

    <!-- price section : deleted -->

    <!-- client section : deleted -->

    <!-- contact section : deleted -->

    <!-- info section -->
    <section class="info_section layout_padding2">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="info_contact">
                        <h4>
                            Address
                        </h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                      Location
                    </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                      Call +01 1234567890
                    </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                      demo@gmail.com
                    </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_link_box">
                        <h4>
                            Links
                        </h4>
                        <div class="info_links">
                            <a class="active" href="index.php">
                                <img src="images/nav-bullet.png" alt="">
                                Home
                            </a>
                            <a class="" href="sign_in.php">
                                <img src="images/nav-bullet.png" alt="">
                                Sign in
                            </a>
                            <a class="" href="login.php">
                                <img src="images/nav-bullet.png" alt="">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_detail">
                        <h4>
                            Info
                        </h4>
                        <p>
                            This website is only a personal project. It has no commercial use.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 mb-0">
                    <h4>
                        Subscribe
                    </h4>
                    <form action="#">
                        <input type="text" placeholder="Enter email"/>
                        <button type="submit">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- end info section -->

    <?php include "includes/footer.php" ?>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>

</body>

</html>