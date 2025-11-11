<?php
require_once('../app/services/fornecedorService.php');
require_once('../app/services/produtoService.php');

$fornecedorService = new FornecedorService();
$fornecedores = $fornecedorService->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fornecedorId = $_POST['fornecedor'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    $produtoService = new ProdutoService();
    $produtoService->create($nome, $fornecedorId, $preco);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="mb-4">
        <a href="/" class="text-blue-500 hover:underline">&larr; Voltar para a página inicial</a>
    </div>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Adicionar Produto</h2>
        <form method="post" class="space-y-4">
            <div>
                <label for="nome" class="block text-gray-700 font-medium">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="preco" class="block text-gray-700 font-medium">Preço:</label>
                <input type="number" step="any" id="preco" name="preco" required
                    class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="preco" class="block text-gray-700 font-medium">Fornecedor</label>
                <select name="fornecedor" id="fornecedor" required>
                    <?php foreach ($fornecedores as $key): ?>
                        <option selected value="<? echo $key['id'] ?>"><? echo $key['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition-colors font-semibold">
                Adicionar
            </button>
        </form>
    </div>
</body>

</html>