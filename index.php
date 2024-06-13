<?php
include('conexao.php');

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        $error_message = 'Preencha seu e-mail';
    } elseif (empty($_POST['senha'])) {
        $error_message = 'Preencha sua senha';
    } else {
        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        if ($sql_query->num_rows == 1) {
            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            exit();
        } else {
            $error_message = 'Falha ao logar! E-mail ou senha incorretos';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="index.css">

    <title>Login</title>
</head>
<body>
<div class="container">
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">

        <p>
            <label>E-mail</label>
            <input type="text" name="email" class="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha" class="senha">
        </p>
        <p>
            <button type="submit" class="entrar">Entrar</button>
        </p>
    </form>
    </div>

    <script src="login.js"></script>
</body>
</html>
