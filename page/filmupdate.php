<?php
echo '<h2>Filmnamen ändern</h2>';
global $con;
if(isset($_POST['save'])) {
    $filmId = $_POST['film_id'];
    $film = $_POST['filmneu'];
    $updateStmt1 = 'update Film set titel = ? where film_id = ?';
    try{
        $array=array($film, $filmId);
        $stmt = makeStatement($updateStmt1, $array);
        echo '<h3>Film wurde umbenannt</h3>';
    } catch (Exception $e) {
        switch($e->getCode()) {
            case 23000:
                echo '<h4>Der Film name existiert bereits!</h4>';
                break;
            default:
                echo 'Error - Film: ' .$e->getCode(). ': ' . $e->getMessage() . '<br>';
        }
    }
}else {
    ?>
    <form method="post">
        <label for="filmalt">Filmname auswählen:</label>
        <?php
        $query = 'Select film_id, titel from film';
        $stmt = $con->prepare($query);
        $stmt->execute();
        echo '<select name="film_id">';
        while($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<option value = "' . $row[0] . '">' . $row[1];
        }
        ?>
        </select>
        <label for="filmneu">Neuer Filmname:</label>
        <input type="text" id="filmneu" name="filmneu" placeholder="z.b. Harry Potter"><br>
        <input type="submit" name="save" value="speichern"><br>
    </form>
    <?php
}