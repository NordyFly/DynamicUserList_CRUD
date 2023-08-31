<?php

try {
    $dbh = new PDO(
        "mysql:host=localhost:9906;dbname=test",
        "diginamic", 
        "diginamic",
        array(PDO::ATTR_PERSISTENT => true)
    );


    $rowCount= $dbh->query('Select * from users')->rowCount();
    echo $rowCount . PHP_EOL;






    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}
