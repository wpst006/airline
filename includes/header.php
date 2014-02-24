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
                <article class="col1">
                    <div class="pad_1">
                        <h2>Your Flight Planner</h2>
                        <form id="form_1" action="#" method="post">
                            <div class="wrapper pad_bot1">
                                <div class="radio marg_right1">
                                    <input type="radio" name="name1">
                                    Round Trip<br>
                                    <input type="radio" name="name1">
                                    One Way </div>
                                <div class="radio">
                                    <input type="radio" name="name1">
                                    Empty-Leg<br>
                                    <input type="radio" name="name1">
                                    Multi-Leg </div>
                            </div>
                            <div class="wrapper"> Leaving From:
                                <div class="bg">
                                    <input type="text" class="input input1" value="Enter City or Airport Code" onBlur="if(this.value=='') this.value='Enter City or Airport Code'" onFocus="if(this.value =='Enter City or Airport Code' ) this.value=''">
                                </div>
                            </div>
                            <div class="wrapper"> Going To:
                                <div class="bg">
                                    <input type="text" class="input input1" value="Enter City or Airport Code" onBlur="if(this.value=='') this.value='Enter City or Airport Code'" onFocus="if(this.value =='Enter City or Airport Code' ) this.value=''">
                                </div>
                            </div>
                            <div class="wrapper"> Departure Date and Time:
                                <div class="wrapper">
                                    <div class="bg left">
                                        <input type="text" class="input input2" value="mm/dd/yyyy " onBlur="if(this.value=='') this.value='mm/dd/yyyy '" onFocus="if(this.value =='mm/dd/yyyy ' ) this.value=''">
                                    </div>
                                    <div class="bg right">
                                        <input type="text" class="input input2" value="12:00am" onBlur="if(this.value=='') this.value='12:00am'" onFocus="if(this.value =='12:00am' ) this.value=''">
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper"> Return Date and Time:
                                <div class="wrapper">
                                    <div class="bg left">
                                        <input type="text" class="input input2" value="mm/dd/yyyy " onBlur="if(this.value=='') this.value='mm/dd/yyyy '" onFocus="if(this.value =='mm/dd/yyyy ' ) this.value=''">
                                    </div>
                                    <div class="bg right">
                                        <input type="text" class="input input2" value="12:00am" onBlur="if(this.value=='') this.value='12:00am'" onFocus="if(this.value =='12:00am' ) this.value=''">
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper">
                                <p>Passenger(s):</p>
                                <div class="bg left">
                                    <input type="text" class="input input2" value="# passengers" onBlur="if(this.value=='') this.value='# passengers'" onFocus="if(this.value =='# passengers' ) this.value=''">
                                </div>
                                <a href="#" class="button2">go!</a> </div>
                        </form>
                        <h2>Recent News</h2>
                        <p class="under"><a href="#" class="link1">Nemo enim ipsam voluptatem quia</a><br>
                            November 5, 2010</p>
                        <p class="under"><a href="#" class="link1">Voluptas aspernatur autoditaut fjugit</a><br>
                            November 1, 2010</p>
                        <p><a href="#" class="link1">Sed quia consequuntur magni</a><br>
                            October 23, 2010</p>
                    </div>
                </article>
                <article class="col2 pad_left1">

                    <!-- Site JavaScript -->
                    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
                    <!--<script type="text/javascript" src="js/jquery.js"></script>-->
                    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
                    <script type="text/javascript" src="js/bootstrap.min.js"></script>
                    
                    <script type="text/javascript" src="js/bootstrap.min.js"></script>
                    <script type="text/javascript" src="js/moment-2.4.0.js"></script>
                    <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
                    <?php
                    $message = messageHelper::getMessage();

                    if (isset($message)) {
                        echo $message;
                        messageHelper::clearMessage();
                    }
                    ?>