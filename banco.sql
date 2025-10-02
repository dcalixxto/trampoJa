CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Senha: "admin123" (hash fictício - usar biblioteca de hash real)
INSERT INTO usuarios (nome, email, senha_hash, perfil) VALUES 
('Administrador', 'admin@trampo-ja.com', '$2y$10$exemplo_hash_senha_admin', 'admin');

-- Senha: "user123" (hash fictício - usar biblioteca de hash real)
INSERT INTO usuarios (nome, email, senha_hash, perfil) VALUES 
('João Silva', 'joao@email.com', '$2y$10$exemplo_hash_senha_user', 'user');