<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('../app/services/fornecedorService.php');

    $fornecedorService = new FornecedorService();
    $fornecedorService->create($_POST['nome']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Fornecedor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="mb-4">
        <a href="/" class="text-blue-500 hover:underline">&larr; Voltar para a página inicial</a>
    </div>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Adicionar Fornecedor</h2>
        <form method="post" class="space-y-4">
            <div>
                <label for="nome" class="block text-gray-700 font-medium">Nome do Fornecedor:</label>
                <input type="text" id="nome" name="nome" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition-colors font-semibold">
                Adicionar
            </button>
        </form>
    </div>
</body>

</html>