<?php

// functie connect()
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
// variabele om op te roepen voor de queries
$connection = db_connect();
// charset toevoegen om alle speciale karakters uit de queries te ondersteunen.
$connection->set_charset("utf8");
?>

    <!DOCTYPE html >
    <!-- altijd mee beginnen -->

    <HTML>

    <head>
        <title>
            Recept
        </title>
        <meta charset="UTF-8">
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
                <div class="well well-sm">
                    <!-- recipe div om gemakkelijk het geheel van de zoekbar & button te restylen in css  -->
                    <div class="title">
                        <?php
                        $title = str_replace('%20',' ',$_SERVER["QUERY_STRING"]); // %20 staat voor spatie in url, dit vervangen we !
                        echo $title;
                        //echo str_replace('%20',' ',$_SERVER["QUERY_STRING"]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?php
                    $title = str_replace('%20',' ',$_SERVER["QUERY_STRING"]); // %20 staat voor spatie in url, dit vervangen we !
                    $query = "SELECT * FROM food.recipe WHERE recipe_Name = '$title'";
                    $result = mysqli_query($connection,$query);

                    if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)){ ?>

                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="350" width="350">'; ?>

                        <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        //mysqli_close($connection); MAG NIET GESLOTEN WORDEN, PAS ALS LAATSTE QUERY UITGEVOERD WORDT.
                     ?>
                </div>

                <div class="col-md-4">
                    <?php
                    $title = str_replace('%20',' ',$_SERVER["QUERY_STRING"]); // %20 staat voor spatie in url, dit vervangen we !
                    $query="SELECT * FROM food.ingredient_has_measure
                            INNER JOIN food.measure ON food.ingredient_has_measure.measure_measure_ID = food.measure.measure_ID
                            INNER JOIN food.ingredient ON food.ingredient_has_measure.ingredient_ingredient_ID = food.ingredient.ingredient_ID
                            INNER JOIN food.recipe_has_ingredient
                            ON food.ingredient_has_measure.ingredient_has_measure_ID = food.recipe_has_ingredient.ihm_ingredient_has_measure_ID
                            WHERE recipe_recipe_ID ='1'";

                    $result = mysqli_query($connection,$query);

                    if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)){ ?>

                        <?php echo $row['measure_Amount']; ?>
                        <?php echo $row['measure_Unit']; ?>
                        <?php echo $row['ingredient_Name']; ?>
                        <br>

                        <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        //mysqli_close($connection); MAG NIET GESLOTEN WORDEN, PAS ALS LAATSTE QUERY UITGEVOERD WORDT.
                     ?>
                </div>

                <div class="col-md-4">
                    <?php
                    $title = str_replace('%20',' ',$_SERVER["QUERY_STRING"]); // %20 staat voor spatie in url, dit vervangen we !
                    $query="SELECT * FROM food.instruction
                            INNER JOIN food.recipe ON food.instruction.instruction_ID = food.recipe.instruction_instruction_ID1
                            WHERE recipe_ID ='1'";

                    $result = mysqli_query($connection,$query);

                    if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)){ ?>

                        <p>
                            <?php echo $row['instruction_Description']; ?>
                        </p>

                        <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                     ?>
                </div>

            </div>


        </div>

    </body>

    <footer> </footer>

    </HTML>
