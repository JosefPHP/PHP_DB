<?php
global $con;
echo "<h2>Suchformular</h2>";

if(isset($_POST['change'])){

    $filmsuche = $_POST['suche'];
    ?>
    <form method="post">
        <?php
        $query = 'Select bezeichnung from Produktionsfirma where lower(bezeichnung) LIKE "%'.$filmsuche.'%"';
        $stmt = $con->prepare($query);
        $stmt->execute();
        if($stmt->rowCount()>0){
            echo '<h3>Gesucht wurde nach: '.$filmsuche.' </h3>';
            $query='Select produktionsfirma_id, bezeichnung from Produktionsfirma where bezeichnung LIKE "%'.$filmsuche.'%"';
            makeTable($query);
        }else{
            echo 'Produktionsfirma wurde nicht gefunden';
            echo '<br>';
            ?>
            <input type="button" name="show" value="Neue Suche" onclick="location.href='index.php?seite=filmsuche';";
            <?php
        }
}else{
    ?>
    <form method="post">
        <label for="suche">Produktionsfirma Suche (auch teilsuche möglich): </label>
        <input type="text" id="suche" name="suche">
        <br>
        <input type="submit" name="change" value="suchen">
     </form>
     <?php
}