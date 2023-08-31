<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Utilisateur</title>
    <!-- Inclure les styles de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Créer un nouvel utilisateur</h1>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Connexion à la base de données MySQL
                $dbh = new PDO(
                    "mysql:host=localhost:9906;dbname=test",
                    "diginamic", 
                    "diginamic"
                );

                // Récupération des données du formulaire
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];

                // Requête d'insertion dans la base de données
                $sql = "INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";
                $statement = $dbh->prepare($sql);
                $statement->bindParam(":firstname", $firstname);
                $statement->bindParam(":lastname", $lastname);
                $statement->bindParam(":email", $email);
                $statement->execute();

                echo "<p class='text-green-500'>Utilisateur créé avec succès.</p>";
            } catch (PDOException $e) {
                echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
            }
        }
        ?>

        <form method="post" class="mt-4">
            <div class="mb-4">
                <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="firstname" id="firstname" class="mt-1 p-2 border rounded-md w-full" required>
            </div>
            <div class="mb-4">
                <label for="lastname" class="block text-sm font-medium text-gray-700">Nom de famille</label>
                <input type="text" name="lastname" id="lastname" class="mt-1 p-2 border rounded-md w-full" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 border rounded-md w-full" required>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Créer Utilisateur</button>
            <button type="button" onclick="window.location.href='filterUser.php'" class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Retour à la liste</button>

        </form>
    </div>
</body>
</html>
