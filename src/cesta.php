<?php
include('./app/services/cestaService.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $produtosIds = $data['ids'];

    $userId = $_SESSION['id'];
    $cestaService = new CestaService();

    for ($i = 0; $i < count($produtosIds); $i++) {
        $cestaService->create($_SESSION['id'], $produtosIds[$i]);
    }
    echo json_encode(1);
    exit;
} else {
    $cestaService = new CestaService();
    $produtos = $cestaService->getProdutosByUserId();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-row justify-between p-3">
        <a href="index.php" class="text-sm text-gray-600 hover:underline">- Voltar</a>
        <h1>Quantidade: <?php echo count($produtos) ?></h1>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b"></th>
                    <th class="px-4 py-2 border-b text-left">Nome</th>
                    <th class="px-4 py-2 border-b text-left">Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produtos) && is_array($produtos)): ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b text-center">
                                <input
                                    id="prod_<?php echo $produto['id']; ?>"
                                    onchange='saveRow(JSON.parse(JSON.stringify(<?php echo json_encode($produto['id']); ?>)))'
                                    type="checkbox" />
                            </td>
                            <td class="px-4 py-2 border-b"><?php echo $produto['nome_produto']; ?></td>
                            <td class="px-4 py-2 border-b"><?php echo $produto['nome_fornecedor']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        $precoTotal = 0;
        foreach ($produtos as $produto) {
            $precoTotal += floatval($produto['preco_produto']);
        }
        ?>
        <h1 class="p-2 text-center">Preço total: R$<?php echo number_format($precoTotal, 2, ',', '.'); ?></h1>
    </div>
</body>

</html>