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
                        <img src="IMG/restaurant_cus.png" class="img-responsive"/>
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

        <?php //test php WERKT!
            echo "<h2>PHP is Fun!</h2>";
            echo "Hello world!<br>";
            echo "I'm about to learn PHP!<br>";
        ?>

        <?php // test connectie databank
            $servername = "localhost:3306";
            $username = "root";
            $password = "Kensan1861";
            $dbname = "food";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            //query samenstellen
            $sql = "select ingredient_Name from ingredient
            join ingredient_has_measure on ingredient_ingredient_ID = ingredient_ID
            where ingredient_has_measure_ID = 1";
            //query uitvoeren
            $result = $conn->query($sql);
            //query uitlezen
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo " - Ingredient Name: " . $row["ingredient_Name"]. "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
    </div>

    <script>


    </script>
</body>

<footer> </footer>

</HTML>

