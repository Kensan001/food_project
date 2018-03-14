<!DOCTYPE html > <!-- altijd mee beginnen -->

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
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

        <!-- javascript, eerst Jquery dan pas bootstrap anders werkt het niet -->
        <script type="text/javascript" src="LIB/jquery-1.12.1.min.js"></script>
        <script src="LIB/bootstrap-4.0.0-beta-dist/js/bootstrap.min.js"></script>

    </head>

    <link rel="stylesheet" type= "text/css" href="CSS/styles.css"> <!-- link naar onze css file -->

    <body>

        <header> </header> <!-- dient om via css te bewerken, = foto in te laden boven navigatiebalk -->

         <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Page 1</a></li>
                        <li><a href="#">Page 2</a></li>
                        <li><a href="#">Page 3</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

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
            join recipe_has_ingredient on ingredient_ingredient_ID = ingredient_ID
            where recipe_recipe_ID = 1";
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


        <script> </script>
    </body>

    <footer> </footer>

</HTML>
