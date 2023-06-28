<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tableau de bord</title>
</head>

<body class="bg-gradient-to-b from-green-500 to-blue-500">
    <main class="px-8 py-6 bg-no-repeat bg-cover">
        <section class="text-center">
            <h2 class="text-2xl mb-4">Hello, <?= $_SESSION['user_firstname'] ?></h2>
            <a href="./logout" class="text-yellow-500 hover:text-yellow-600 text-shadow">Déconnexion</a>
            <br>
            <h2 class="text-2xl mt-8 mb-4">Ajouter un Pokemon !</h2>
            <div class="flex justify-center">
                <form action="" method="POST" class="bg-transparent shadow-none rounded mb-4 text-center">
                    <div class="flex flex-col items-center">
                        <input type="text" name="name" class="px-3 py-2 border-b border-gray-300 rounded focus:outline-none focus:border-blue-500 mb-2">
                        <button type="submit" class="w-36 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="flex flex-col items-center">
            <h2 class="my-10 text-yellow-500 font-bold text-3xl text-shadow text-center">Mon Pokedex</h2>
            <?php if (!empty($errorMessages)) : ?>
            <div class="error-messages bg-red-200 text-red-700 py-2 px-4 rounded mb-4 w-96 text-center">
                <ul>
                    <?php foreach ($errorMessages as $errorMessage) : ?>
                        <li><?php echo $errorMessage; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
            <div class="flex flex-wrap justify-center">
                <?php
                if (!empty($pokemons)) {
                    foreach ($pokemons as $pokemon) {
                ?>
                        <div class="md:w-1/3 lg:w-1/4 xl:w-1/5 mx-4 mb-8 px-4 py-4 border border-gray-500 rounded-xl flex flex-col items-center">
                            <h3 class="text-xl mb-2"><?= $pokemon["name"] ?></h3>
                            <img src="<?= $pokemon['image'] ?>" alt="<?= $pokemon['name'] ?>" class="mb-2">
                            <?php
                            foreach (json_decode($pokemon["type"]) as $type) {
                                echo "<p>Type: " . $type->name . "</p>";
                            }
                            ?>
                            <form action="./deletePoke" method="POST">
                                <div class="flex flex-col items-center">
                                    <input type="hidden" name="id" value="<?= $pokemon['id'] ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 my-8 rounded focus:outline-none focus:shadow-outline">Supprimer</button>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>



</html>