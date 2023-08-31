<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <!-- Inclure les styles de Tailwind CSS -->
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

            // Initialisation des variables de filtrage
            $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
            $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";

            // Requête de sélection avec filtres
            $sql = "SELECT id, firstname, lastname, email FROM users 
                    WHERE firstname LIKE :firstname AND lastname LIKE :lastname AND email LIKE :email
                    LIMIT 200";
            
            $statement = $dbh->prepare($sql);
            $statement->bindValue(":firstname", "%$firstname%");
            $statement->bindValue(":lastname", "%$lastname%");
            $statement->bindValue(":email", "%$email%");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo "<form method='post' class='mb-4'>";
            echo "<div class='grid grid-cols-1 md:grid-cols-3 gap-4'>";
            echo "<input type='text' name='firstname' placeholder='Prénom' class='p-2 border rounded-md' value='$firstname'>";
            echo "<input type='text' name='lastname' placeholder='Nom de famille' class='p-2 border rounded-md' value='$lastname'>";
            echo "<input type='text' name='email' placeholder='Email' class='p-2 border rounded-md' value='$email'>";
            echo "</div>";
            echo "<input type='submit' value='Filtrer' class='mt-2 px-4 py-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600'>";
            echo "</form>";

            echo "<table class='w-full border-collapse'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='border p-2 text-left'>ID</th>";
            echo "<th class='border p-2 text-left'>Nom</th>";
            echo "<th class='border p-2 text-left'>Prénom</th>";
            echo "<th class='border p-2 text-left'>Email</th>";
            echo "<th class='border p-2 text-left'>Fiche</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($users as $user) {
                echo "<tr class='hover:bg-blue-100 transition-all'>";
                echo "<td class='border p-2'>" . $user["id"] . "</td>";
                echo "<td class='border p-2'>" . $user["lastname"] . "</td>";
                echo "<td class='border p-2'>" . $user["firstname"] . "</td>";
                echo "<td class='border p-2'>" . $user["email"] . "</td>";
                echo "<td class='border p-2'>";
                echo "<a href='user.php?id=" . $user["id"] . "' class='text-blue-500 hover:underline'>Voir la fiche</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion à la base de données
            echo "Connexion échouée : " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
