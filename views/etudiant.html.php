<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole 221 - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        header {
            background: linear-gradient(135deg, #38b2ac, #319795);
        }
    </style>
</head>
<body class="bg-gray-200 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Fixed header -->
        <header class="text-white py-4 shadow-md fixed w-full z-10">
            <div class="container mx-auto text-center">
                <h1 class="text-2xl font-bold">Ecole 221</h1>
                <form action="/logout" method="post">
                    <button class="absolute top-4 right-10 text-2xl font-bold decoration-none text-destructive hover:text-teal-100" type="submit">Deconnexion</button>
                </form>
            </div>
        </header>
        <!-- Main content area -->
        <div class="flex flex-grow pt-16">
            <!-- Sidebar -->
            <aside class="bg-teal-700 text-white w-12 py-6 px-2 fixed lg:relative lg:translate-x-0 lg:w-1/5 shadow-md sidebar">
                <div class="flex flex-col space-y-4">
                    <a href="#" class="py-2 px-4 mx-4 text-center font-semibold transition-all duration-300 ease-in-out transform scale-105 bg-teal-600 rounded-lg shadow-lg">Cours</a>
                    <form action="/sessionC" method="post">
                        <button type="submit" class="py-2 px-[102px] mx-4 text-center font-semibold transition-all duration-300 ease-in-out transform scale-105 bg-teal-600 rounded-lg shadow-lg">Session</button>
                    </form>
                </div>
            </aside>


            <!-- Main content -->
            <main class="flex-grow p-6 bg-gray-100 transition-opacity duration-500 fade-in">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Étudiant</h3>
                                <p class="text-2xl font-bold text-teal-700"><?= $user->getNomComplet() ?></p>
                                <p class="text-sm text-gray-500">Classe Z</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Total heures d'absence</h3>
                                <p class="text-2xl font-bold text-teal-700">2 heures</p>
                                <p class="text-sm text-gray-500"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div class="bg-white shadow-lg rounded-lg p-4 w-full">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Liste des cours</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-teal-500 text-white font-bold">
                                    <tr>
                                        <th class="py-2 px-4">Cours</th>
                                        <th class="py-2 px-4">Semestre</th>
                                        <th class="py-2 px-4">Professeur</th>
                                        <th class="py-2 px-4">Nbr heures global</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($courses as $cours):?>
                                    <tr class="text-center">
                                        <td class="py-2 px-4 border"><?= $cours['cours_libelle'] ?></td>
                                        <td class="py-2 px-4 border"><?= $cours['semestre_libelle'] ?></td>
                                        <td class="py-2 px-4 border"><?= $cours['professeur_prenom'] . ' ' . $cours['professeur_nom'] ?></td>
                                        <td class="py-2 px-4 border"><?= $cours['nombre_heure_global'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="mt-4 flex justify-center">
                            <form method="post" action="http://www.school.ndiaga.sn:8743/etudiant">
                                <?php if ($currentPage > 1): ?>
                                    <button type="submit" name="page" value="<?= $currentPage - 1 ?>" class="mx-1 px-3 py-1 border rounded bg-teal-500 text-white"><</button>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <button type="submit" name="page" value="<?= $i ?>" class="mx-1 px-3 py-1 border rounded <?= $i == $currentPage ? 'bg-teal-700 text-white' : 'bg-white text-teal-700' ?>"><?= $i ?></button>
                                <?php endfor; ?>
                                <?php if ($currentPage < $totalPages): ?>
                                    <button type="submit" name="page" value="<?= $currentPage + 1 ?>" class="mx-1 px-3 py-1 border rounded bg-teal-500 text-white">></button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
