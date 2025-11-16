<?php
include('./app/models/estudanteModel.php');
include('./app/models/cursoModel.php');

$estudanteModel = new EstudanteModel();
$cursoModel = new CursoModel();

$cursos = $cursoModel->getAllCursos();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nossos Cursos</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl mt-10 mb-10">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-blue-700">Cursos Disponíveis</h1>
    </div>
    <div class="flex justify-between mb-6 items-center">
      <div>
        <a href="cadastrarCurso.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition mr-2">
          Cadastrar Curso
        </a>
        <a href="cadastrarEstudante.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
          Cadastrar Estudante
        </a>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-300">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border-b text-left">Curso</th>
            <th class="px-4 py-2 border-b text-left">Nível</th>
            <th class="px-4 py-2 border-b text-left">Carga Horária</th>
            <th class="px-4 py-2 border-b text-left">Preço</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($cursos) && is_array($cursos)): ?>
            <?php foreach ($cursos as $curso): ?>
              <tr
                class="hover:bg-neutral-500 transition-all cursor-pointer"
                onclick="window.location.href='/curso.php?id=<?php echo $curso['_id']; ?>'">
                <td class="px-4 py-2 border-b">
                  <?php echo $curso['nome']; ?>
                </td>
                <td class="px-4 py-2 border-b">
                  <?php echo $curso['nivel']; ?>
                </td>
                <td class="px-4 py-2 border-b">
                  <?php echo $curso['carga_horaria']; ?>h
                </td>
                <td class="px-4 py-2 border-b">
                  R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="px-4 py-4 text-center text-gray-500">Nenhum curso encontrado.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>