<!DOCTYPE html>
<?php
include_once("conexao.php");
session_start();
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <script language="javascript">
            function redirecionar(url) {
                window.location.href = url;
            }

            function mostrarMensagem(mensagem, sucesso) {
                var elemento = document.getElementById("mensagem");
                elemento.innerHTML = mensagem;
                elemento.style.color = sucesso ? "green" : "red";

                if (sucesso) {
                    setTimeout(function () {
                        redirecionar('../../TCC/cursos.html');
                    }, 1000);
                } else {
                    setTimeout(function () {
                        redirecionar('../../TCC/login.html');
                    }, 1000);
                }
            }
        </script>
    </head>
    <body>
        <div id="mensagem" align="center"></div>
        <?php
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $consulta = mysqli_query($conexao, "SELECT email, senha FROM usuario WHERE email = '$email'") or die(mysqli_error($conexao));
            $linhas = mysqli_num_rows($consulta);

            if ($linhas == 0) {
                echo "<br><br><br><br><br><br><p align='center'>Por favor, aguarde&hellip;</p>";
                echo "<script language='javascript'>mostrarMensagem('Login falhou. Usuário não encontrado.', false)</script>";
            } else {
                $row = mysqli_fetch_assoc($consulta);

                // Verifique a senha usando password_verify
                if (password_verify($senha, $row['senha'])) {
                    $_SESSION["email"] = $email;
                    $_SESSION["senha"] = $senha;
                    echo "<br><br><br><br><br><br> <p align='center'>Por favor, aguarde&hellip;</p>";
                    echo "<script language='javascript'>mostrarMensagem('Login bem-sucedido!', true)</script>";
                } else {
                    echo "<br><br><br><br><br><br><p align='center'>Por favor, aguarde&hellip;</p>";
                    echo "<script language='javascript'>mostrarMensagem('Login falhou. Senha incorreta.', false)</script>";
                }
            }
        ?>
    </body>
</html>