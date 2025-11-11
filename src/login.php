<?php
$loginResult = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require('./app/services/pessoaService.php');

  session_start();

  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $pessoaService = new PessoaService();
  $loginResult = $pessoaService->login($email, $senha);

  if ($loginResult) {
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $loginResult;
    header('Location: index.php');
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
  class="bg-neutral-900 flex h-screen w-screen justify-center items-center">
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
    <div class="flex justify-center mb-6">
      <button class="px-4 py-2 font-semibold text-blue-500">Login</button>
    </div>
    <p class="w-full text-center text-red-500"><? if ($loginResult === false) echo 'Senha incorreta' ?>
      <? if ($loginResult === null) echo 'Email não cadastrado' ?></p>
    <form class="space-y-4" method="post">
      <input
        type="email"
        placeholder="Email"
        name="email"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
      <input
        type="password"
        placeholder="Senha"
        name="senha"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
        Entrar
      </button>
    </form>
  </div>
</body>

</html>