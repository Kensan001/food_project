<?php

//$servername = "localhost:3306";
//$username = "root";
//$password = "Kensan1861";
//$dbname = "food";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
//if ($conn->connect_error) { // "if (!$conn)" kan ook ipv connect_error
//    die("Connection failed: " . $conn->connect_error);
//}

    function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once
        static $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
             // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('C:\wamp64\www\brackets\Projectwerk\config.ini');
            $connection = mysqli_connect('localhost:3306',$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if($connection == false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return mysqli_connect_error();
        }
        return $connection;
    }
$connection = db_connect();

?>

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
        <!-- script for dropdown-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

            <!-- deze row maakt dat de well over de volledige breedte van de container gespreid wordt -->
            <div class="row">
                <div class="well">
                    <!-- wrap div om gemakkelijk het geheel van de zoekbar & button te restylen in css  -->
                    <div class="wrap">
                        <form action="recepten.php" method="post">
                            <input type="text" class="searchTerm" name="trefwoord" placeholder="Zoek">
                            <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i> <!-- search icon bootstrap -->
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <!-- de dropdowns grouperen in een sectie om te stylen met border in css -->
            <section>
                <div class="row">
                    <div class="col-md-3">
                        <!-- Theme -->
                        <div class="icon">
                            <img src="IMG/toast_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gelegenheid
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $dropdown=mysqli_query ($connection,'select * from food.theme');
                        while($row=mysqli_fetch_assoc($dropdown)){
                        ?>
                                        <a value="<?php echo $row['theme_ID'];?>">
                                            <?php echo $row['theme_Description'];?>
                                        </a>
                                        <?php
                        }
                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- Kitchen-->
                        <div class="icon">
                            <img src="IMG/italy_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Keuken
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $dropdown=mysqli_query ($connection,'select * from food.kitchen');
                        while($row=mysqli_fetch_assoc($dropdown)){
                        ?>
                                        <a value="<?php echo $row['kitchen_ID'];?>">
                                            <?php echo $row['kitchen_Description'];?>
                                        </a>
                                        <?php
                        }
                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- Categorie-->
                        <div class="icon">
                            <img src="IMG/meat_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categorie
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $dropdown=mysqli_query ($connection,'select * from food.category');
                        while($row=mysqli_fetch_assoc($dropdown)){
                        ?>
                                        <a value="<?php echo $row['category_ID'];?>">
                                            <?php echo $row['category_Name'];?>
                                        </a>
                                        <?php
                        }
                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- Seizoen-->
                        <div class="iconSeizoen">
                            <img src="IMG/leaf_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">

                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Seizoen
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $dropdown=mysqli_query ($connection,'select * from food.season');
                        while($row=mysqli_fetch_assoc($dropdown)){
                        ?>
                                        <a value="<?php echo $row['season_ID'];?>">
                                            <?php echo $row['season_Description'];?>
                                        </a>
                                        <?php
                        }
                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-md-3">
                        <!-- Type gerecht-->
                        <div class="icon">
                            <img src="IMG/cutlery_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gerecht
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $dropdown=mysqli_query ($connection,'select * from food.course');
                        while($row=mysqli_fetch_assoc($dropdown)){
                        ?>
                                        <a value="<?php echo $row['course_ID'];?>">
                                            <?php echo $row['course_Description'];?>
                                        </a>
                                        <?php
                        }
                        ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- Moeilijkheid-->
                        <div class="icon">
                            <img src="IMG/sweat_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Moeilijkheid
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a>Gemakkelijk</a></li>
                                <li><a>Gemiddeld</a></li>
                                <li><a>Moeilijk</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- Duur-->
                        <div class="icon">
                            <img src="IMG/circular-clock_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Duur
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a>1+uur</a></li>
                                <li><a>10-20 min</a></li>
                                <li><a>12+uur</a></li>
                                <li><a>2+uur</a></li>
                                <li><a>20-30min</a></li>
                                <li><a>24+uur</a></li>
                                <li><a>3+uur</a></li>
                                <li><a>30min-1uur</a></li>
                                <li><a>5-10min</a></li>
                                <li><a>6+uur</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- database bevragen op basis van enkel trefwoord - WORKING - and tonen in responsive grid -->
            <div class="resultQuery">
                <div class="row">
                    <?php
                        if (!empty($_POST['trefwoord'])) {
                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $query = "SELECT * FROM food.recipe WHERE recipe_Name LIKE '%".$trefwoord."%' ORDER BY recipe_Name";
                        $result = mysqli_query($connection,$query);
                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                        <div class="col-md-3 mdStyle">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                            <?php echo $row['recipe_Name']; ?>
                        </div>

                        <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>
                </div>
            </div>



            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>


            <div class="select">
                <select name="categorie">
                <option value="">--- Select ---</option>
                    <?php
                        //require('myConn.php'); TODO !!!
                        $dropdown=mysqli_query ($conn,'select * from food.theme');
                        while($row=mysqli_fetch_assoc($dropdown)){
                    ?>
                <option value="<?php echo $row['theme_ID'];?>">
                    <?php echo $row['theme_Description'];?>
                </option>
                <?php
                    }
                ?>
            </select>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('.dropdown').each(function(key, dropdown) {
                    var $dropdown = $(dropdown);
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append(' <span class="caret"></span>');
                    });
                });
            });

        </script>


    </body>

    <footer> </footer>

    </HTML>
