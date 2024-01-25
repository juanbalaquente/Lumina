<?php

include_once("../TCC/conexoes/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Use password_hash para armazenar senhas com segurança
$hashSenha = password_hash($senha, PASSWORD_DEFAULT);

// Adicione o campo cod_task na inserção

if (!empty($nome) && !empty($email) && !empty($senha)) {
    // Verifica se o e-mail já está cadastrado
    $consulta = mysqli_query($conexao, "SELECT email FROM usuario WHERE email = '$email'");
    $linhas = mysqli_num_rows($consulta);

    if ($linhas > 0) {
        echo "Erro ao cadastrar: E-mail já cadastrado!";
    } else {
        // Se o e-mail não estiver cadastrado, insira o novo usuário
        $cadastrar = mysqli_query($conexao, "INSERT INTO usuario(nome, email, senha, cod_task) VALUES ('$nome', '$email', '$hashSenha', NULL)");

        if ($cadastrar) {
            // Exibe a mensagem e redireciona após um curto intervalo
            echo '<script>';
            echo 'alert("Cadastrado!");';
            echo 'setTimeout(function(){ window.location.href = "../TCC/login.html"; }, 2000);'; // Redireciona após 2 segundos (2000 milissegundos)
            echo '</script>';
            exit(); // Certifica-se de que o script não continua a ser executado após o redirecionamento
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conexao);
        }
    }
} else {
    echo "Preencha todos os campos para cadastrar!";
}
?>