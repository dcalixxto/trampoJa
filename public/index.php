<?php
session_start(); // Inicia a sessão para poder acessar as mensagens

$mensagem = '';
$tipo_mensagem = '';

// Verifica se há mensagem de erro na sessão
if (isset($_SESSION['mensagem_erro'])) {
    $mensagem = $_SESSION['mensagem_erro'];
    $tipo_mensagem = 'erro';
    unset($_SESSION['mensagem_erro']); // Limpa a mensagem da sessão para que não apareça novamente
}
// Verifica se há mensagem de sucesso na sessão
elseif (isset($_SESSION['mensagem_sucesso'])) {
    $mensagem = $_SESSION['mensagem_sucesso'];
    $tipo_mensagem = 'sucesso';
    unset($_SESSION['mensagem_sucesso']); // Limpa a mensagem da sessão
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Login — Trampo-já</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>
    <header>
        <div class="logo-box">
            <img src="logo4.png" alt="Logo Trampo-já">
            <p class="slogan">.</p>
        </div>
    </header>

    <div class="container">
        <div class="login-box">

            <?php if (!empty($mensagem)): ?>
                <div class="alert alert-<?php echo ($tipo_mensagem === 'erro') ? 'danger' : 'success'; ?>">
                    <?php echo htmlspecialchars($mensagem); ?>
                </div>
            <?php endif; ?>
            <h1>Entrar</h1>
            
            <form action="autentica.php" method="POST">
                <div class="field">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
                    <div id="emailFeedback" class="feedback"></div>
                </div>
                <div class="field">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                </div>

                <div class="options">
                    <a href="#">Esqueceu a senha?</a>
                    <label><input type="checkbox"> Mantenha-me conectado</label>
                </div>

                <button type="submit" class="btn">Entrar</button>
            </form>

            <div class="signup">
                Ainda não tem conta? <a href="#">Cadastre-se agora</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p class="copyright">TrampoJa© 2025</p>
            <div class="footer-links">
                <a href="#" class="footer-link">Contrato do Usuário</a>
                <a href="#" class="footer-link">Política de Privacidade do TrampoJa</a>
                <a href="#" class="footer-link">Política de Cookies</a>
                <a href="#" class="footer-link">Enviar feedback</a>
            </div>
        </div>
    </footer>
    
    <script src="../assests/js/script.js"></script>
</body>
</html>