<?php
session_start();

// Remove todas as variáveis da sessão,limpando os dados do usuário logado
session_unset();

// Destrói a sessão 
session_destroy();

// Redireciona o usuário para a página de login
session_start(); // Inicia uma nova sessão só para a mensagem de feedback
$_SESSION['mensagem_sucesso'] = "Você saiu com segurança.";
header('Location: index.php');

//Garante que nenhum código adicional seja executado após o redirecionamento
exit;
?>