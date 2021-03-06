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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
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
                        <form action="recepten.php" method="GET">
                            <input type="text" class="searchTerm" name="trefwoord" placeholder="Zoek">
                            <!-- al deze input velden slaan de waarde van de dropdown selectie op voor verdere POST actie, deze tekstvelden worden gehide via class "hide"("unhide")-->
                            <div class="hide">
                                <input type="text" class="form-control" id="categorieText" name="categorie" readonly>
                                <input type="text" class="form-control" id="seizoenText" name="seizoen" readonly>
                                <input type="text" class="form-control" id="keukenText" name="keuken" readonly>
                                <input type="text" class="form-control" id="gelegenheidText" name="gelegenheid" readonly>
                                <input type="text" class="form-control" id="gerechtText" name="gerecht" readonly>
                                <input type="text" class="form-control" id="moeilijkheidText" name="moeilijkheid" readonly>
                                <input type="text" class="form-control" id="duurText" name="duur" readonly>
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
                            <!-- caret toont een pijltje om aan te tonen dat het dropdown button is -->
                            <ul class="dropdown-menu" id="myTab">
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

            <br>
            <!-- Code om de zoekhistoriek weer te geven-->
            <div class="zoekhistoriek">
                Uw laatste zoekcriteria was: <br>
                <?php echo isset($_GET['trefwoord']) ? $_GET['trefwoord']:'' ?> &nbsp;
                <?php echo isset($_GET['gelegenheid']) ? $_GET['gelegenheid'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['keuken']) ? $_GET['keuken'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['categorie']) ? $_GET['categorie'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['seizoen']) ? $_GET['seizoen'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['gerecht']) ? $_GET['gerecht'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['moeilijkheid']) ? $_GET['moeilijkheid'] : ' ' ?> &nbsp;
                <?php echo isset($_GET['duur']) ? $_GET['duur'] : ' ' ?>
            </div>
            <br>



            <!-- tweede manier om de zoekhistoriek weer te geven, momenteel niet gebruikt = display: none-->
            <div id="criteria" style="display:none">
                <div class="row">
                    <div class="col-md-3">
                        <p>Uw laatste zoekcriteria was:</p>
                    </div>

                    <div class="col-md-9">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="trefwoord" placeholder="geen trefwoord gekozen" value="<?php echo isset($_POST['trefwoord']) ? $_POST['trefwoord'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="categorie" placeholder="geen categorie gekozen" value="<?php echo isset($_POST['categorie']) ? $_POST['categorie'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="seizoen" placeholder="geen seizoen gekozen" value="<?php echo isset($_POST['seizoen']) ? $_POST['seizoen'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="keuken" placeholder="geen keuken gekozen" value="<?php echo isset($_POST['keuken']) ? $_POST['keuken'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="gelegenheid" placeholder="geen gelegenheid gekozen" value="<?php echo isset($_POST['gelegenheid']) ? $_POST['gelegenheid'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="gerecht" placeholder="geen gerecht gekozen" value="<?php echo isset($_POST['gerecht']) ? $_POST['gerecht'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="moeilijkheid" placeholder="geen moeilijkheid gekozen" value="<?php echo isset($_POST['moeilijkheid']) ? $_POST['moeilijkheid'] : '' ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="duur" placeholder="geen duur gekozen" value="<?php echo isset($_POST['duur']) ? $_POST['duur'] : '' ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- database bevragen en resultaten weergeven -->
            <div class="resultQuery">
                <div class="row">

                    <?php

                        //alle velden checken of ze wel ingevuld/geselecteerd werden, de variabelen tussen de '' komen van de hidden tekstvelden in div class "hide" lijn 98
                        //we gebruiken de GET methode ipv POST omdat we de input value & gekozen selecties in de url querystring willen zien om nadien te gebruiken bij de navigatieknoppen van de //pagination

                        if (empty($_GET['trefwoord'])){
                        $trefwoord="%";}
                        if (!empty($_GET['trefwoord'])){
                        $trefwoord = mysqli_real_escape_string($connection, $_GET['trefwoord']);}

                        if (empty($_GET['gelegenheid'])){
                        $gelegenheid="%";}
                        if (!empty($_GET['gelegenheid'])){
                        $gelegenheid = mysqli_real_escape_string($connection, $_GET['gelegenheid']);}

                        if (empty($_GET['keuken'])){
                        $keuken="%";}
                        if (!empty($_GET['keuken'])){
                        $keuken = mysqli_real_escape_string($connection, $_GET['keuken']);}

                        if (empty($_GET['categorie'])){
                        $categorie="%";}
                        if (!empty($_GET['categorie'])){
                        $categorie = mysqli_real_escape_string($connection, $_GET['categorie']);}

                        if (empty($_GET['seizoen'])){
                        $seizoen="%";}
                        if (!empty($_GET['seizoen'])){
                        $seizoen = mysqli_real_escape_string($connection, $_GET['seizoen']);}

                        if (empty($_GET['gerecht'])){
                        $gerecht="%";}
                        if (!empty($_GET['gerecht'])){
                        $gerecht = mysqli_real_escape_string($connection, $_GET['gerecht']);}

                        if (empty($_GET['moeilijkheid'])){
                        $moeilijkheid="%";}
                        if (!empty($_GET['moeilijkheid'])){
                        $moeilijkheid = mysqli_real_escape_string($connection, $_GET['moeilijkheid']);}

                        if (empty($_GET['duur'])){
                        $duur="%";}
                        if (!empty($_GET['duur'])){
                        $duur = mysqli_real_escape_string($connection, $_GET['duur']);}

                        // beginning pagination code
                        if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                        } else {
                        $pageno = 1;
                        }

                        // max aantal treffers per pagina
                        $no_of_records_per_page = 10;

                        // om de index bij te houden vanaf welke records weer te geven (pag1 = 0 | pag2 = 16 | pag3= 32 ...)
                        $offset = ($pageno-1) * $no_of_records_per_page;

                        // query om het aantal hits/resultaten later te berekenen in variabele $hits
                        $hits_sql = "SELECT * FROM food.recipe
                                    INNER JOIN food.season ON season_season_ID1 = season_ID
                                    INNER JOIN food.category ON category_category_ID1 = category_ID
                                    INNER JOIN food.kitchen ON kitchen_kitchen_ID1 = kitchen_ID
                                    INNER JOIN food.theme ON theme_theme_ID1 = theme_ID
                                    INNER JOIN food.course ON course_course_ID1 = course_ID
                                    INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID

                                    WHERE recipe_Name LIKE '%".$trefwoord."%'
                                    AND season_Description LIKE '$seizoen'
                                    AND category_Name LIKE '$categorie'
                                    AND kitchen_Description LIKE '$keuken'
                                    AND theme_Description LIKE '$gelegenheid'
                                    AND course_Description LIKE '$gerecht'
                                    AND instruction_Difficulty LIKE '$moeilijkheid'
                                    AND instruction_Duration LIKE '$duur'";

                        // geeft het aantal hits/resultaten terug van de query hierboven => wordt gebruikt steeds het aantal treffers te echo'en op de site.
                        $hits = mysqli_query($connection,$hits_sql);

                        // het aantal hits in een int variabele steken waarmee we de aantal pagina's kunnen berekenen
                        $count = mysqli_num_rows($hits);

                        // totale pagina's:
                        $total_pages = ceil($count / $no_of_records_per_page); // ceil = roundup

                        // echo $offset;
                        // end pagination code

                        $query = "SELECT * FROM food.recipe
                                    INNER JOIN food.season ON season_season_ID1 = season_ID
                                    INNER JOIN food.category ON category_category_ID1 = category_ID
                                    INNER JOIN food.kitchen ON kitchen_kitchen_ID1 = kitchen_ID
                                    INNER JOIN food.theme ON theme_theme_ID1 = theme_ID
                                    INNER JOIN food.course ON course_course_ID1 = course_ID
                                    INNER JOIN food.instruction ON instruction_instruction_ID1 = instruction_ID

                                    WHERE recipe_Name LIKE '%".$trefwoord."%'
                                    AND season_Description LIKE '$seizoen'
                                    AND category_Name LIKE '$categorie'
                                    AND kitchen_Description LIKE '$keuken'
                                    AND theme_Description LIKE '$gelegenheid'
                                    AND course_Description LIKE '$gerecht'
                                    AND instruction_Difficulty LIKE '$moeilijkheid'
                                    AND instruction_Duration LIKE '$duur'
                                    LIMIT $offset, $no_of_records_per_page";


                        $result = mysqli_query($connection,$query);

                        if ($result->num_rows > 0) { ?>

                        <div class="col-md-12 aantalRecepten">
                            <?php // Return the number of rows in result set => aantal resultaten dat gevonden werd weergeven?>
                            <?php $rowcount=mysqli_num_rows($hits);
                        printf("%d recept(en)",$rowcount); //%d - Take the next argument and print it as an int => betekent dat hij de variabele $rowcount hierin stopt als int?>
                        </div>

                        <?php

                        while ($row = mysqli_fetch_array($result)){ ?>

                            <div class="col-md-3 mdStyle">
                                <?php// door de eerste lijn hieronder eerst te zetten, wordt er een link gemaakt op de foto & receptnaam; de "recipe_Name wordt in de url geplaatst = Querystring! ?>
                                    <?php echo '<a href="recept.php?'.$row['recipe_Name'].'">';?>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['recipe_Image']).'" height="auto" width="100%">'; // auto & 100% = responsive!?>
                                    <div class="href">
                                        <?php echo$row['recipe_Name']; ?>
                                    </div>
                            </div>


                            <?php }
                        } else { ?>
                            <div class="col-md-12">
                                <?php echo "Geen resultaten gevonden."; ?>
                            </div>
                            <?php
                        }
                        mysqli_close($connection);
                        ?>
                </div>
            </div>


            <!-- navigatieknoppen onderaan de pagina-->
            <div class="row">
                <div class="col-md-12 pagination">
                    <ul class="pagination">
                        <br>
                        <br>
                        <br>


                        <!-- 1. extra lege <li> dient om de ongewilde link van het laatste recept weg te werken  -->
                        <li class="hide"><a href=""></a></li>

                        <!-- 2. PREV BUTTON-->
                            <!-- disable button als de paginanummer kleiner / gelijk is aan 1 (initiele status van de variabele)-->
                        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">

                            <!-- variabele queryString -->
                            <?php $queryString = $_SERVER["QUERY_STRING"]; // fetch current query string in url before clicking on NEXT button ?>

                            <!-- Deze href versie met pageno vooraan in de querystring werkt niet !! -->
                            <!-- <a href="<?php// if($pageno <= 1){ echo '#'; } else { echo " ?pageno=".($pageno - 1)," & ",$queryString; } ?>">Prev</a> -->

                            <!-- als de paginanummer kleiner / gelijk is aan 1, voeg "#" toe aan query string -->
                            <!-- else: voeg paginanummer toe + de huidige querystring (anders vergeet de pagina de huidige zoekopdracht door op de button te drukken en geeft hij terug alle resultaten weer zoals bij het begin van het laden van de pagina) -->
                            <!-- OPMERKING ! Deze href versie werkt wel, maar hij telt de pagina's wel op in de querystring en gebruikt tenslotte de laatste: vb: &pageno=2&pageno=3&pageno=2&pageno=1 !! -->
                            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?",$queryString, "&pageno=".($pageno - 1) ; } ?>">Prev</a>

                        </li>

                        <!-- 3. NEXT BUTTON-->
                            <!-- disable button als de paginanummer groter / gelijk aan de totaal aan pagina's is -->
                        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">

                            <!-- variabele queryString -->
                            <?php $queryString = $_SERVER["QUERY_STRING"]; // fetch current query string in url before clicking on NEXT button ?>

                            <!-- als de paginanummer groter / gelijk aan de totaal aan pagina's is, voeg "#" toe aan query string -->
                            <!-- else: voeg paginanummer toe + de huidige querystring (anders vergeet de pagina de huidige zoekopdracht door op de button te drukken en geeft hij terug alle resultaten weer zoals bij het begin van het laden van de pagina) -->

                            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?",$queryString, "&pageno=".($pageno + 1) ; } ?>">Next</a>

                        </li>

                        <br>
                        <br>
                        <br>
                    </ul>
                </div>

            </div>
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
                        //$('#moeilijkheidLabel').text($.trim($(this).html())); // tekst in label om de gebruikte zoekcriteria te tonen na de zoekopdracht.
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
                        $('#duurLabel').text($.trim($(this).html())); // tekst in label om de gebruikte zoekcriteria te tonen na de zoekopdracht.
                    });
                });
            });

        </script>

        <!-- testfunctie show queryString van de url (niet meer nodig) -->
        <script>
            var url = window.location.search;
            url = url.replace("?", ''); // remove the ? with nothing
            //alert(url); // show

        </script>

    </body>

    <footer> </footer>

    </HTML>
