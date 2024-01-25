<?php
session_start();
include_once('conexao.php');

// Verifica se o parâmetro 'saida' está presente na URL
if (isset($_GET['saida']) && $_GET['saida'] == 1) {
    // Verifica se uma sessão está iniciada
    if (isset($_SESSION["email"])) {
        // Destroi a sessão
        session_destroy();

        // Redireciona para a página inicial
        header('location: ../index.html');

        // Exibe mensagem com JavaScript
        echo '<script>';
        echo 'alert("Você terminou sessão.");';
        echo 'window.location.href = "../index.html";'; // Redireciona imediatamente para a página inicial
        echo '</script>';
        exit();
    } else {
        // Exibe mensagem se nenhuma sessão estiver iniciada
        echo '<script>';
        echo 'alert("Nenhuma sessão foi logada.");';
        echo 'window.location.href = "../index.html";'; // Redireciona imediatamente para a página inicial
        echo '</script>';
        exit();
    }
}
?>