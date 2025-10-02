<?php
session_start();

// Verifica se a variável de sessão 'usuario_id' NÃO está definida
if (!isset($_SESSION['usuario_id'])) {
    
    // Se não estiver logado, destrói a sessão
    session_destroy();

    // Usamos uma sessão temporária para passar a mensagem
    session_start(); // Reinicia a sessão para armazenar a mensagem
    $_SESSION['mensagem_erro'] = "Acesso negado. Por favor, faça o login para continuar.";
    
    // Redireciona o usuário para a página de login
    header('Location: index.php');
    
    exit;
}
?>