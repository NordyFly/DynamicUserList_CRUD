<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <?php
        try {
            // Connexion à la base de données MySQL
            $dbh = new PDO(
                "mysql:host=localhost:9906;dbname=test",
                "diginamic", 
                "diginamic"
            );

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $id = $_POST["id"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                
                $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id";
                $statement = $dbh->prepare($sql);
                $statement->bindParam(":id", $id);
                $statement->bindParam(":firstname", $firstname);
                $statement->bindParam(":lastname", $lastname);
                $statement->bindParam(":email", $email);
                $statement->execute();
                
                echo "<p class='text-green-500'>Mise à jour réussie !</p>";
            }

            $id = $_GET["id"];
            $sql = "SELECT id, firstname, lastname, email FROM users WHERE id = :id";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(":id", $id);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            echo "<div class='text-center'>";
            echo "<h1 class='text-xl font-bold mb-2'>".$user["firstname"]." ".$user["lastname"]."</h1>";
            echo "<p class='mb-4'>Email : ".$user["email"]."</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='id' value='".$user["id"]."'>";
            echo "<input type='text' name='firstname' placeholder='Prénom' value='".$user["firstname"]."' class='p-2 border rounded-md mb-2'>";
            echo "<input type='text' name='lastname' placeholder='Nom de famille' value='".$user["lastname"]."' class='p-2 border rounded-md mb-2'>";
            echo "<input type='text' name='email' placeholder='Email' value='".$user["email"]."' class='p-2 border rounded-md mb-2'>";
            echo "<input type='submit' value='Mettre à jour' class='bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600'>";
            echo "</form>";
            echo "<a href='filterUser.php' class='bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 mt-2 inline-block'>Retour</a>";
            echo "</div>";

        } catch (PDOException $e) {
            echo "Connexion échouée : ". $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
