<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>

<body class="login h-screen bg-no-repeat bg-cover">
    <main class="mt-16 flex flex-col items-center">
    <h2 class="my-8 text-yellow-500 font-bold text-3xl text-shadow">Connexion</h2>
        <?php if (!empty($errorMessages)) : ?>
            <div class="error-messages bg-red-200 text-red-800 py-2 px-4 rounded mb-4">
                <ul>
                    <?php foreach ($errorMessages as $errorMessage) : ?>
                        <li><?php echo $errorMessage; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="bg-transparent shadow-none rounded px-8 py-6 mb-4">
            <div class="mb-4">
                <label for="email" class="block text-gray-300 mb-2">Email:</label>
                <input type="text" name="email" class="w-full px-3 py-1 border-b border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-300 mb-2">Mot de passe:</label>
                <input type="password" name="password" class="w-full px-3 py-1 border-b border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Envoyer</button>
            </div>
        </form>
    </main>
</body>


</html>