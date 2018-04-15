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
            Recepten
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
                <div class="well">
                    <!-- wrap div om gemakkelijk het geheel van de zoekbar & button te restylen in css  -->
                    <div class="wrap">
                        <form action="recepten.php" method="post">
                            <input type="text" class="searchTerm" name="trefwoord" placeholder="Zoek">
                            <!-- al deze input velden slaan de waarde van de dropdown selectie op voor verdere POST actie, deze tekstvelden worden gehide via class "hide"-->
                            <div class="unhide">
                                <input type="text" id="categorieText" name="categorie">
                                <input type="text" id="seizoenText" name="seizoen">
                                <input type="text" id="keukenText" name="keuken">
                                <input type="text" id="gelegenheidText" name="gelegenheid">
                                <input type="text" id="gerechtText" name="gerecht">
                                <input type="text" id="moeilijkheidText" name="moeilijkheid">
                                <input type="text" id="duurText" name="duur">
                            </div>
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
                        <div class="dropdownGelegenheid">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gelegenheid
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $query=mysqli_query ($connection,'select * from food.theme');
                        while($row=mysqli_fetch_assoc($query)){
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
                        <div class="dropdownKeuken">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Keuken
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $query=mysqli_query ($connection,'select * from food.kitchen');
                        while($row=mysqli_fetch_assoc($query)){
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
                        <div class="dropdownCategorie">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Categorie
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                                    $query=mysqli_query ($connection,'select * from food.category');
                                    while($row=mysqli_fetch_assoc($query)){
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
                        <div class="icon">
                            <img src="IMG/leaf_cus.png" class="img-responsive" />
                        </div>
                        <div class="dropdownSeizoen">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Seizoen
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                                        $query=mysqli_query ($connection,'select * from food.season');
                                        while($row=mysqli_fetch_assoc($query)){
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
                        <div class="dropdownGerecht">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Gerecht
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <?php
                        $query=mysqli_query ($connection,'select * from food.course');
                        while($row=mysqli_fetch_assoc($query)){
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
                        <div class="dropdownMoeilijkheid">
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
                        <div class="dropdownDuur">
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

            <!-- database bevragen en resultaten weergeven -->
            <div class="resultQuery">
                <div class="row">

                    <?php //CASE 1: indien enkel trefwoord (zoekveld) is ingevuld (TODO VERDER AFWERKEN VOOR 3 COMBO'S !!!)
                        if (!empty($_POST['trefwoord'])&&(empty($_POST ['gelegenheid'])&&(empty($_POST ['keuken'])&&(empty($_POST ['categorie'])&&(empty($_POST ['seizoen'])&&(empty($_POST ['gerecht'])&&(empty($_POST ['moeilijkheid'])&&(empty($_POST ['duur']))))))))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $query = "SELECT * FROM food.recipe WHERE recipe_Name LIKE '%".$trefwoord."%'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 2: indien het trefwoord (zoekveld) leeg is EN enkel een SEIZOEN werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['seizoen']))) {

                        $seizoen = mysqli_real_escape_string($connection, $_POST['seizoen']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.season ON season_season_ID1 = season_ID WHERE season_Description = '$seizoen'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                        <div class="col-md-3 mdStyle">
                            <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                            <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                            <div class="href"><?php echo $row['recipe_Name']; ?></div>
                        </div>

                        <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 3: indien het trefwoord (zoekveld) leeg is EN enkel een CATEGORIE werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['categorie']))) {

                        $categorie = mysqli_real_escape_string($connection, $_POST['categorie']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.category ON category_category_ID1 = category_ID WHERE category_Name = '$categorie'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 4: indien het trefwoord (zoekveld) leeg is EN enkel een KEUKEN werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['keuken']))) {

                        $keuken = mysqli_real_escape_string($connection, $_POST['keuken']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.kitchen ON kitchen_kitchen_ID1 = kitchen_ID WHERE kitchen_Description = '$keuken'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 5: indien het trefwoord (zoekveld) leeg is EN enkel een GELEGENHEID werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['gelegenheid']))) {

                        $gelegenheid = mysqli_real_escape_string($connection, $_POST['gelegenheid']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.theme ON theme_theme_ID1 = theme_ID WHERE theme_Description = '$gelegenheid'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 6: indien het trefwoord (zoekveld) leeg is EN enkel een GERECHT werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['gerecht']))) {

                        $gerecht = mysqli_real_escape_string($connection, $_POST['gerecht']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.course ON course_course_ID1 = course_ID WHERE course_Description = '$gerecht'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 7: indien het trefwoord (zoekveld) leeg is EN enkel een MOEILIJKHEID werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['moeilijkheid']))) {

                        $moeilijkheid = mysqli_real_escape_string($connection, $_POST['moeilijkheid']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID WHERE instruction_Difficulty = '$moeilijkheid'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 8: indien het trefwoord (zoekveld) leeg is EN enkel een DUUR werd geselecteerd
                        if (empty($_POST['trefwoord']) && (!empty($_POST ['duur']))) {

                        $duur = mysqli_real_escape_string($connection, $_POST['duur']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID WHERE instruction_Duration = '$duur'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                <div class="href"><?php echo $row['recipe_Name']; ?></div>
                            </div>

                            <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 9: indien het trefwoord (zoekveld) is ingevuld EN een SEIZOEN werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['seizoen']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $seizoen = mysqli_real_escape_string($connection, $_POST['seizoen']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.season ON season_season_ID1 = season_ID WHERE recipe_Name LIKE '%".$trefwoord."%' AND season_Description = '$seizoen'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 10: indien het trefwoord (zoekveld) is ingevuld EN een CATEGORIE werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['categorie']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $categorie = mysqli_real_escape_string($connection, $_POST['categorie']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.category ON category_category_ID1 = category_ID WHERE recipe_Name LIKE '%".$trefwoord."%' AND category_Name = '$categorie'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php //CASE 11: indien het trefwoord (zoekveld) is ingevuld EN een KEUKEN werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['keuken']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $keuken = mysqli_real_escape_string($connection, $_POST['keuken']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.kitchen ON kitchen_kitchen_ID1 = kitchen_ID WHERE recipe_Name LIKE '%".$trefwoord."%' AND kitchen_Description = '$keuken'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php // CASE 12: indien het trefwoord (zoekveld) is ingevuld EN een GELEGENHEID werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['gelegenheid']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $gelegenheid = mysqli_real_escape_string($connection, $_POST['gelegenheid']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.theme ON theme_theme_ID1 = theme_ID WHERE recipe_Name LIKE '%".$trefwoord."%' AND theme_Description = '$gelegenheid'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php // CASE 13: indien het trefwoord (zoekveld) is ingevuld EN een GERECHT werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['gerecht']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $gerecht = mysqli_real_escape_string($connection, $_POST['gerecht']);
                        $query = "SELECT * FROM food.recipe INNER JOIN food.course ON course_course_ID1 = course_ID WHERE recipe_Name LIKE '%".$trefwoord."%'
                        AND course_Description = '$gerecht'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250"/>'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php // CASE 14: indien het trefwoord (zoekveld) is ingevuld EN een MOEILIJKHEID werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['moeilijkheid']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $moeilijkheid = mysqli_real_escape_string($connection, $_POST['moeilijkheid']);
                        $query = "SELECT * FROM food.recipe  INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID WHERE recipe_Name LIKE '%".$trefwoord."%'
                        AND instruction_Difficulty = '$moeilijkheid'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250">'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
                                </div>

                                <?php }
                        } else {
                            echo "Geen resultaten gevonden.";
                        }
                        mysqli_close($connection);
                        } ?>

                        <?php // CASE 15: indien het trefwoord (zoekveld) is ingevuld EN een DUUR werd geselecteerd
                        if (!empty($_POST['trefwoord']) && (!empty($_POST ['duur']))) {

                        $trefwoord = mysqli_real_escape_string($connection, $_POST['trefwoord']);
                        $duur = mysqli_real_escape_string($connection, $_POST['duur']);
                        $query = "SELECT * FROM food.recipe  INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID WHERE recipe_Name LIKE '%".$trefwoord."%'
                        AND instruction_Duration = '$duur'";
                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)){ ?>

                                <div class="col-md-3 mdStyle">
                                    <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="250" width="250">'; ?>
                                    <div class="href"><?php echo $row['recipe_Name']; ?></div>
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

        </div>

        <!-- Dropdown Gelegenheid-->
        <script>
            $(document).ready(function() {
                $('.dropdownGelegenheid').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#gelegenheidText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>

        <!-- Dropdown Keuken-->
        <script>
            $(document).ready(function() {
                $('.dropdownKeuken').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#keukenText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>

        <!-- Dropdown Categorie-->
        <script>
            $(document).ready(function() {
                $('.dropdownCategorie').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#categorieText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>

        <!-- Dropdown Seizoen-->
        <script>
            $(document).ready(function() {
                $('.dropdownSeizoen').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#seizoenText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                        // TEST met MSGBOX
                        //var szn = $dropdown.find('button').text();
                        //alert(szn); // test met messagebox => hij zit erin !
                    });
                });
            });
        </script>

        <!-- Dropdown Gerecht-->
        <script>
            $(document).ready(function() {
                $('.dropdownGerecht').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#gerechtText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>

        <!-- Dropdown Moeilijkheid-->
        <script>
            $(document).ready(function() {
                $('.dropdownMoeilijkheid').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#moeilijkheidText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>

        <!-- Dropdown Duur-->
        <script>
            $(document).ready(function() {
                $('.dropdownDuur').each(function(key, dropdown) {
                    var $dropdown = $(dropdown); // = data-toggle "dropdown"
                    $dropdown.find('.dropdown-menu a').on('click', function() {
                        $dropdown.find('button').text($(this).text()).append('<span class="caret"></span>'); // tekst in dropdown button updaten
                        $('#duurText').val($.trim($(this).html())); // tekst in hidden tekstveld updaten voor POST naar query PHP.
                    });
                });
            });
        </script>



    </body>

    <footer> </footer>

    </HTML>
