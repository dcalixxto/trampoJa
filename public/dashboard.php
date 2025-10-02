<?php

// Se o usuário não estiver logado, ele será redirecionado para a tela de login.
require_once 'verifica_sessao.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Painel do Usuário</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .dashboard-container { 
            max-width: 800px; 
            margin: 50px auto; 
            padding: 20px; 
            background-color: #fff; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .dashboard-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-bottom: 1px solid #ddd; 
            padding-bottom: 10px; 
            margin-bottom: 20px;
        }
        .logout-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .logout-link:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <div class="dashboard-header">
            
            <h1>
                Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!
            </h1>

            <a href="logout.php" class="logout-link">Sair</a>
        </div>

        <div class="dashboard-content">
            <p>Este é o seu painel de controle.</p>
            <p>Seu perfil de acesso é: <strong><?php echo htmlspecialchars($_SESSION['usuario_perfil']); ?></strong>.</p>
            
            <?php if ($_SESSION['usuario_perfil'] === 'admin'): ?>
                <div class="admin-section" style="margin-top: 20px; padding: 15px; background-color: #e7f3fe; border-left: 5px solid #2196F3;">
                    <h2>Área Administrativa</h2>
                    <p>Você tem permissões de administrador. Aqui você pode gerenciar usuários, ver relatórios, etc.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>
</html>