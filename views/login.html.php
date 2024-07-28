<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div
            class="absolute inset-0 bg-gradient-to-r from-teal-300 to-teal-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <form action="login" method="post">
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-3xl text-teal-600 text-center left-[150px] font-bold absolute top-6">Ecole 221</h1>
                        <h1 class="text-2xl text-black mt-2 text-center font-semibold">Se connecter</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="relative">
                                <input autocomplete="off" id="username" name="username" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-teal-600" placeholder="Login" />
                                <label for="username" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Login</label>
                                <?php if (isset($errors['username'])): ?>
                                    <span class="text-red-500 text-sm"><?= implode('<br>', $errors['username']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="relative">
                                <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-teal-600" placeholder="Mot de passe" />
                                <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Mot de passe</label>
                                <?php if (isset($errors['password'])): ?>
                                    <span class="text-red-500 text-sm"><?= implode('<br>', $errors['password']) ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="relative top-6 ml-[32%]">
                                <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white mb-6 rounded-md px-2 py-1">Connexion</button>
                            </div>
                            <?php if (isset($error)): ?>
                                <div class=" bg-red-100 p-4 text-red-500 text-sm text-center"><?= $error ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
