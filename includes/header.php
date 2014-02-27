<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AirLines</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<!--        <script type="text/javascript" src="js/jquery-1.4.2.js" ></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/cufon-replace.js"></script>
        <script type="text/javascript" src="js/Myriad_Pro_italic_600.font.js"></script>
        <script type="text/javascript" src="js/Myriad_Pro_italic_400.font.js"></script>
        <script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>-->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="js/ie6_script_other.js"></script>
        <script type="text/javascript" src="js/html5.js"></script>
        <![endif]-->
        <link href="css/chosen.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-style.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css" />
    </head>
    <body id="page1">
        <!-- START PAGE SOURCE -->
        <div class="body1">
            <div class="main">
                <header>
                    <div class="wrapper">
                        <h1><a href="index.html" id="logo">AirLines</a>
<!--                            <span id="slogan">International Travel</span>-->
                        </h1>
                        <div class="right">
                            <nav>
                                <ul id="menu">
                                    <li id="menu_active"><a href="index.php">Home</a></li>
                                    <?php if ($isLoggedIn == false) { ?>
                                        <li><a href="login.php">Log In</a></li>
                                    <?php } else { ?>
                                        <li><a href="logout.php">Log Out</a></li>
                                    <?php } ?>
                                    <li><a href="register.php">Register</a></li>
                                    <li><a href="schedule.php">Schedule</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="main">
            <div id="banner">
                <div class="text1"> COMFORT<span>Guaranteed</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <a href="#" class="button_top">Order Tickets Online</a></div>
        </div>
        <div class="main">
            <section id="content">
                <?php
                $currentPageName = pageHelper::getCurrentPageName();

                $hasSideBar = true;

                $hasSideBar = !in_array($currentPageName, array('schedules-display.php'));

                if ($hasSideBar == true) {
                    include('includes/sidebar.php');
                }
                ?>
                <article class="col2 pad_left1">

                    <!-- Site JavaScript -->
                    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
                    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
                    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

                    <script type="text/javascript" src="js/bootstrap.min.js"></script>
                    <script type="text/javascript" src="js/moment-2.4.0.js"></script>
                    <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>

                    <script src="js/chosen/chosen.jquery.min.js" type="text/javascript"></script>                                
                    <script src="js/chosen/chosen.proto.min.js" type="text/javascript"></script>
                    <?php
                    $message = messageHelper::getMessage();

                    if (isset($message)) {
                        echo $message;
                        messageHelper::clearMessage();
                    }
                    ?>