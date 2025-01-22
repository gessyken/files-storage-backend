<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation API KenFile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200 font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gray-800 py-4 shadow-md">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold">API KenFile - Documentation</h1>
                <a href="#examples" class="text-teal-400 hover:underline">Exemple d'intégration</a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Description</h2>
                <p class="text-gray-400">
                    Cette API permet de gérer le stockage de fichiers en ligne. Vous pouvez l'utiliser pour uploader, consulter, mettre à jour ou supprimer des fichiers via des requêtes HTTP.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Routes Disponibles</h2>
                <div class="space-y-8">
                    <!-- Route: Lister les fichiers -->
                    <div class="bg-gray-800 p-4 rounded-md">
                        <h3 class="text-lg font-bold text-teal-400">1. Lister les fichiers</h3>
                        <p>Route : <span class="text-teal-400">GET /api/files</span></p>
                        <p>Réponse :
                            <pre class="bg-gray-700 text-sm p-2 rounded mt-2">{
    "status": "success",
    "message": "List of files retrieved successfully.",
    "data": [
        { "id": 1, "path": "files/file1.png", "created_at": "2023-01-01" },
        ...
    ]
}</pre>
                        </p>
                        <h4 class="text-teal-400 font-semibold mt-4">Exemple Flutter :</h4>
                        <pre class="bg-gray-700 text-sm p-2 rounded">
import 'package:http/http.dart' as http;
import 'dart:convert';

Future<void> listFiles() async {
    final response = await http.get(Uri.parse('https://votre-api.com/api/files'));

    if (response.statusCode == 200) {
        var data = json.decode(response.body);
        print('Fichiers: \${data["data"]}');
    } else {
        print('Erreur: \${response.statusCode}');
    }
}
                        </pre>
                    </div>

                    <!-- Route: Ajouter un fichier -->
                    <div class="bg-gray-800 p-4 rounded-md">
                        <h3 class="text-lg font-bold text-teal-400">2. Ajouter un fichier</h3>
                        <p>Route : <span class="text-teal-400">POST /api/files</span></p>
                        <p>Paramètres :
                            <pre class="bg-gray-700 text-sm p-2 rounded mt-2">{
    "file": "Fichier à uploader (max: 2 Mo)"
}</pre>
                        </p>
                        <p>Réponse :
                            <pre class="bg-gray-700 text-sm p-2 rounded mt-2">{
    "status": "success",
    "message": "File uploaded successfully.",
    "data": { "id": 1, "path": "files/file1.png" }
}</pre>
                        </p>
                        <h4 class="text-teal-400 font-semibold mt-4">Exemple Flutter :</h4>
                        <pre class="bg-gray-700 text-sm p-2 rounded">
import 'package:http/http.dart' as http;

Future<void> uploadFile(String filePath) async {
    var request = http.MultipartRequest(
        'POST', Uri.parse('https://votre-api.com/api/files'));
    request.files.add(await http.MultipartFile.fromPath('file', filePath));

    var response = await request.send();
    if (response.statusCode == 201) {
        print('Fichier uploadé avec succès');
    } else {
        print('Erreur: \${response.statusCode}');
    }
}
                        </pre>
                    </div>

                    <!-- Route: Voir un fichier -->
                    <div class="bg-gray-800 p-4 rounded-md">
                        <h3 class="text-lg font-bold text-teal-400">3. Voir un fichier</h3>
                        <p>Route : <span class="text-teal-400">GET /api/files/{id}</span></p>
                        <p>Réponse :
                            <pre class="bg-gray-700 text-sm p-2 rounded mt-2">{
    "status": "success",
    "message": "File retrieved successfully.",
    "data": { "id": 1, "path": "files/file1.png" }
}</pre>
                        </p>
                        <h4 class="text-teal-400 font-semibold mt-4">Exemple Flutter :</h4>
                        <pre class="bg-gray-700 text-sm p-2 rounded">
import 'package:http/http.dart' as http;
import 'dart:convert';

Future<void> getFile(int fileId) async {
    final response = await http.get(Uri.parse('https://votre-api.com/api/files/\$fileId'));

    if (response.statusCode == 200) {
        var data = json.decode(response.body);
        print('Fichier récupéré : \${data["data"]}');
    } else {
        print('Erreur: \${response.statusCode}');
    }
}
                        </pre>
                    </div>

                    <!-- Ajouter les autres routes avec leurs exemples Flutter de manière similaire -->
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 py-4 text-center">
            <p class="text-gray-400">&copy; 2025 KenFile API. Tous droits réservés.</p>
        </footer>
    </div>
</body>
</html>
