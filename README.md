# Trampo-já

## Requisitos

- Servidor web (Apache/Nginx ou Live Server)
- MySQL 5.7+ ou MariaDB
- Navegador web moderno

## Passos para rodar o projeto

1. **Clone o repositório**
   ```bash
   git clone https://github.com/dcalixxto/trampoJa.git
   cd trampoJa
   ```

2. **Configure o banco de dados**
   ```sql
   CREATE DATABASE trampo_ja;
   USE trampo_ja;
   SOURCE banco.sql;
   ```

3. **Execute o projeto**
   - Abra o arquivo `public/index.html` em um servidor web
   - Ou use Live Server: `http://localhost:5500/public/index.html`

## Usuário/senha de teste

```
Admin:
Email: admin@trampo-ja.com
Senha: admin123

Usuário:
Email: joao@email.com
Senha: user123
```

## Breve descrição do fluxo implementado

O sistema implementa uma tela de login com validação em tempo real de e-mail. O usuário acessa a página principal, insere suas credenciais (e-mail e senha), e o sistema valida o formato do e-mail com feedback visual instantâneo. Inclui opções de "Esqueceu a senha?" e "Mantenha-me conectado", além de um link para cadastro de novos usuários. A interface é responsiva e utiliza um design system com paleta de cores amarelo/preto/cinza.
