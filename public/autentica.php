<?php
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Define as constantes para o controle de tentativas
define('MAX_LOGIN_ATTEMPTS', 5); // Máximo de tentativas permitidas
define('LOCKOUT_DURATION', 900); // Tempo de bloqueio em segundos (15 minutos)

// Verifica se o usuário está atualmente bloqueado
if (isset($_SESSION['lockout_time']) && time() - $_SESSION['lockout_time'] < LOCKOUT_DURATION) {
    $remaining_time = LOCKOUT_DURATION - (time() - $_SESSION['lockout_time']);
    $_SESSION['mensagem_erro'] = "Muitas tentativas de login falhas. Por favor, aguarde " . ceil($remaining_time / 60) . " minutos para tentar novamente.";
    header("Location: index.php");
    exit;
}

// Limpa o bloqueio se o tempo já expirou
if (isset($_SESSION['lockout_time']) && time() - $_SESSION['lockout_time'] >= LOCKOUT_DURATION) {
    unset($_SESSION['login_attempts']);
    unset($_SESSION['lockout_time']);
}

// Verifica se os dados foram enviados via POST
if (isset($_POST['email']) && isset($_POST['senha'])) {
    
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        $_SESSION['mensagem_erro'] = "E-mail e senha são obrigatórios.";
        header("Location: index.php");
        exit;
    }

    try {
        $sql = "SELECT id_usuario, nome, email, senha_hash, tipo_perfil FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {

            unset($_SESSION['login_attempts']);
            unset($_SESSION['lockout_time']);

            session_regenerate_id(true);

            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_perfil'] = $usuario['tipo_perfil'];
            
            header("Location: dashboard.php");
            exit;

        } else {
            if (!isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts'] = 0;
            }
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
                // Inicia o bloqueio
                $_SESSION['lockout_time'] = time();
                $_SESSION['mensagem_erro'] = "Você excedeu o número de tentativas de login. Acesso bloqueado por 15 minutos.";
            } else {
                // Informa o usuário sobre as tentativas restantes
                $attempts_left = MAX_LOGIN_ATTEMPTS - $_SESSION['login_attempts'];
                $_SESSION['mensagem_erro'] = "Credenciais inválidas. Você tem mais " . $attempts_left . " tentativa(s).";
            }

            header("Location: index.php");
            exit;
        }

    } catch (PDOException $e) {
        die("Erro na autenticação: " . $e->getMessage());
    }

} else {
    $_SESSION['mensagem_erro'] = "Acesso inválido.";
    header("Location: index.php");
    exit;
}