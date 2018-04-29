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
