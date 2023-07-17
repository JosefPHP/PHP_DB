<?php
global $con;
echo "<h2>Suchformular2</h2>";

if(isset($_POST['change'])){

    $filmsuche2 = $_POST['suche'];
    ?>
    <form method="post">
        <?php
        $query = 'Select bezeichnung from Produktionsfirma where lower(bezeichnung) LIKE "%'.$filmsuche2.'%"';
        $stmt = $con->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
            echo '<h3>Gesucht wurde nach: '.$filmsuche2.'</h3>';
            $query='Select f.titel AS Titel, f.erscheinungsdatum AS Erscheinungsdatum, p.bezeichnung AS Produktionsfirma from Film f left join Produktionsfirma p on f.produktionsfirma_id = p.produktionsfirma_id where p.bezeichnung LIKE "%'.$filmsuche2.'%"';
            makeTable($query);
        }else{
            echo 'Produktionsfirma wurde nicht gefunden';
            echo '<br>';
            ?>
            <input type="button" name="show" value="Neue Suche" onclick="location.href='index.php?seite=filmsuche2';";
            <?php
        }
}else{
    ?>
    <form method="post">
        <label for="suche">Produktionsfirma Suche (mit filmen):</label>
        <input type="text" id="suche" name="suche">
        <br>
        <input type="submit" name="change" value="suchen">
    </form>
    <?php
}