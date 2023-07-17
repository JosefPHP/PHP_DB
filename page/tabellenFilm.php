<?php
echo '<h2>Tabelle Film </h2>';
$query = 'Select * from Film';

global $con;
makeTable($query);

echo '<h2> Tabelle Produktionsfirma</h2>';

$query2 = 'Select * from Produktionsfirma';
makeTable($query2);

echo '<h2> Join Tabellen</h2>';

$query3 = 'Select f.titel AS Titel, f.erscheinungsdatum AS Erscheinungsdatum, p.bezeichnung AS Produktionsfirma from Film f left join Produktionsfirma p on f.produktionsfirma_id = p.produktionsfirma_id';

makeTable($query3);