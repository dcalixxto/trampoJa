CREATE DATABASE trampo_ja_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE trampo_ja_db;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `tipo_perfil` enum('adim','freelancer', 'empresa') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `nome_fantasia` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `area_atuacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `id_usuario_unico` (`id_usuario`),
  UNIQUE KEY `cnpj_unico` (`cnpj`),
  CONSTRAINT `fk_empresa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `freelancers` (
  `id_freelancer` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `habilidades` text DEFAULT NULL,
  `formacao` text DEFAULT NULL,
  `portfolio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_freelancer`),
  UNIQUE KEY `id_usuario_unico` (`id_usuario`),
  CONSTRAINT `fk_freelancer_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- USUÁRIOS DE TESTE (SENHA: senha123)

-- ADM
INSERT INTO `usuarios` (`nome`, `email`, `senha_hash`, `tipo_perfil`) VALUES
('Daniel Calixto', 'danielcalixto@email.com', '$2y$10$QEgxc/e87ZN5zOelOF1LB.U0vsOIkHDuNmkU4JHiZsz3maTZP8wXO', 'admin');

-- USER
INSERT INTO `usuarios` (`nome`, `email`, `senha_hash`, `tipo_perfil`) VALUES
('Lucas Eduardo', 'lucaseduardo@email.com', '$2y$10$QEgxc/e87ZN5zOelOF1LB.U0vsOIkHDuNmkU4JHiZsz3maTZP8wXO', 'freelancer');
SET @id_usuario_freelancer = LAST_INSERT_ID();
INSERT INTO `freelancers` (`id_usuario`, `habilidades`, `formacao`, `portfolio`) VALUES
(@id_usuario_freelancer, 'PHP, MySQL, JavaScript, React', 'Ciência da Computação - USP', 'http://portfolio.joaosilva.dev');