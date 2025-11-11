<?php
include('./app/services/produtoService.php');
include('./app/services/fornecedorService.php');

session_start();

if (!isset($_SESSION['email'])) {
  unset($_SESSION['email']);
  header('Location: login.php');
  exit;
}

$email = $_SESSION['email'] ?? null;

$fornecedorService = new FornecedorService();
$produtoService = new ProdutoService();
$produtos = $produtoService->getAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestão de Produtos</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl mt-10 mb-10">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-blue-700">Sistema de Gestão de Produtos</h1>
      <a href="cesta.php" class="text-sm text-gray-600 hover:underline">Ver Cesta</a>
    </div>

    <div class="flex justify-between mb-6 items-center">
      <div>
        <a href="adicionar/produto.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition mr-2">
          Adicionar Produto
        </a>
        <a href="adicionar/fornecedor.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
          Adicionar Fornecedor
        </a>
      </div>

      <p class="text-right text-gray-600 mb-4">
        <span class="font-semibold"><?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></span>
      </p>
      <form action="logout.php" method="post">
        <button type='submit' class="bg-red-500 text-white rounded-md p-2">Logout</button>
      </form>
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
                <td class="px-4 py-2 border-b">
                  <p onclick=""><?php echo $produto['nome_produto']; ?></p>
                </td>
                <td class="px-4 py-2 border-b">
                  <p onclick=""><?php echo $produto['nome_fornecedor']; ?></p>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" class="px-4 py-4 text-center text-gray-500">Nenhum produto cadastrado.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div>
        <button
          id="addToCestaBtn"
          onclick="handleCesta()"
          disabled
          class="bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition"
          type="button">
          Adicionar na cesta
        </button>
      </div>
    </div>
  </div>

  <script>
    const selected = new Set();

    function updateSummary() {
      const btn = document.getElementById('addToCestaBtn');
      btn.disabled = (selected.size === 0);
    }

    function saveRow(id) {

      if (selected.has(id)) {
        selected.delete(id);
      } else {
        selected.add(id);
      }
      updateSummary();
    }

    async function handleCesta() {
      const ids = Array.from(selected)

      const resp = await fetch('cesta.php', {
        method: 'POST',
        body: JSON.stringify({
          ids
        })
      });

      const data = await resp.text();

      console.log(data)

      if (data && data.success) {
        selected.clear();
        ids.forEach(id => {
          const el = document.getElementById('prod_' + id);
          if (el && el.checked) el.checked = false;
        });
        updateSummary();

      }
    }

    (function init() {
      const inputs = document.querySelectorAll('input[id^="prod_"]');
      inputs.forEach(input => {
        const idMatch = input.id.replace('prod_', '');
        if (input.checked) {
          selected.add(Number(idMatch));
        }
      });
      updateSummary();
    })();
  </script>
</body>

</html>