<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('./app/models/cursoModel.php');

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cargaHoraria = $_POST['cargaHoraria'];
    $preco = $_POST['preco'];
    $nivel = $_POST['nivel'];

    $cursoModel = new CursoModel();

    $id = $cursoModel->createCurso(
        $nome,
        $descricao,
        $cargaHoraria,
        $preco,
        $nivel
    );

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro de Curso</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-neutral-900 flex h-screen w-screen justify-center items-center py-10">
    <div class="w-full mx-auto max-w-md bg-white rounded-lg shadow-md p-8 overflow-y-auto">
        <div class="mb-4">
            <a href="/" class="text-blue-500 hover:underline">&larr; Voltar para a página inicial</a>
        </div>
        <div class="flex justify-center mb-6">
            <button class="px-4 py-2 font-semibold text-blue-500">Cadastro de Curso</button>
        </div>
        <form class="space-y-4" method="post">
            <input
                type="text"
                placeholder="Nome do Curso"
                name="nome"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <textarea
                placeholder="Descrição do Curso"
                name="descricao"
                rows="3"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            <input
                type="number"
                placeholder="Carga Horária (em horas)"
                name="cargaHoraria"
                min="1"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <input
                type="number"
                placeholder="Preço (ex: 499.90)"
                name="preco"
                min="0"
                step="0.01"
                required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <div>
                <label for="nivel" class="block text-sm font-medium text-gray-700">Nível do Curso</label>
                <select
                    id="nivel"
                    name="nivel"
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    <option value="" disabled selected>Selecione o nível</option>
                    <option value="Básico">Básico</option>
                    <option value="Intermediário">Intermediário</option>
                    <option value="Avançado">Avançado</option>
                </select>
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Cadastrar Curso
            </button>
        </form>
    </div>
</body>

</html>