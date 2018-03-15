<!DOCTYPE html >
<!-- altijd mee beginnen -->

<HTML>

<head>

    <title>
        Home
    </title>
    <!-- css -->
    <!-- 2 style sheets voor css -->
    <link rel="stylesheet" href="LIB/bootstrap-3.3.6/css/bootstrap.min.css">
    <!--optional theme !-->
    <link rel="stylesheet" href="LIB/bootstrap-3.3.6/css/bootstrap-theme.min.css">
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- javascript, eerst Jquery dan pas bootstrap anders werkt het niet -->
    <script type="text/javascript" src="LIB/jquery-1.12.1.min.js"></script>
    <script src="LIB/bootstrap-4.0.0-beta-dist/js/bootstrap.min.js"></script>

</head>

<!-- link naar onze css file -->
<link rel="stylesheet" type="text/css" href="CSS/styles.css">

<body>
    <!--blank spacing at the top -->
    <p class="  TopOfPage"></p>

    <!-- in body eerst een container div aanmaken, standaard responsive type -->
    <div class="container">

        <p class="TopOfContainer"></p>

        <div class="navigation">
            <nav class="navbar navbar-inverse navbarCustomized">
                <div class="navbar-header">
                    <!-- Dit is "de hamburger" -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="navbar-brand">
                        <img src="IMG/restaurant_cus.png" class="img-responsive" />
                    </div>

                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="recepten.php">RECEPTEN</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="well">
            <!-- wrap div om gemakkelijk het geheel van de zoekbar & button te restylen in css  -->
            <div class="wrap">
                <input type="text" class="searchTerm" placeholder="Zoek...">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i> <!-- search icon bootstrap -->
                </button>
            </div>
        </div>



    </div>
    <script></script>
</body>

<footer> </footer>

</HTML>
