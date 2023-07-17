<?php
echo '<h2> Neuen Film erfassen</h2>';

if(isset($_POST['save']))
{
    global $con;
    //$film_id = $_POST['film_id'];
    $titel = $_POST['titel'];
    $erscheinung = $_POST['date'];
    $produktionsfirma = $_POST['firma_id'];
    $insertStmt = 'insert into film (titel, erscheinungsdatum, produktionsfirma_id) values (?,?,?)';
    try{
        //$film_id = $con->lastInsertId(); WEGEN AUTO INCREMENT IN DB
        $array = array($titel,$erscheinung, $produktionsfirma);
        $stmt = makeStatement($insertStmt,$array);

        echo '<h3> Film wurde erfasst</h3>';

    }catch(Exception $e)
    {
        echo 'Error- Film: '.$e->getCode().': '.$e->getMessage(). '<br>';
    }

}else {
    ?>
    <form method="post">
        <label for="titel">Filmname: </label>
        <input type="text" id="titel" name="titel" placeholder="z.b Harry Potter" reuqired>
        <input type="date" id="date" name="date">
        <?php

        global $con;
        $query = 'Select produktionsfirma_id, bezeichnung from Produktionsfirma';
        $stmt = $con->prepare($query);
        $stmt->execute();
        echo '<br><select name="firma_id">';
        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[1];
        }
        echo '</select><br>';
        ?>
        <input type="submit" name="save" value="speicher">
    </form>
    <?php
}