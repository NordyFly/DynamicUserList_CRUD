<?php

try {
    $dbh = new PDO(
        "mysql:host=localhost:9906;dbname=test",
        "diginamic", 
        "diginamic",
        array(PDO::ATTR_PERSISTENT => true)
    );

    if(isset($_GET["id"])){    
   $statement = $dbh->prepare('SELECT * from users where id = :id');
   $statement->execute(['id' => $_GET['id']]);
   $user = $statement->fetch(PDO::FETCH_ASSOC);
// Si le résultat n'est pas vide, affichage du résultat sous la forme de clé => valeur
    if (isset($user) && $user) {
        foreach ($user as $key => $value) {
          echo "<br>$key : $value";
        }
      }}

    

    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}
