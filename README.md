
# ✅ README — Sistema de Cadastro e Autenticação

## 🎯 Introdução

Este projeto é um **sistema simples de blog** com funcionalidades de:  
✅ Cadastro de usuários.  
✅ Login.  
✅ Logout.  
✅ Autenticação de páginas.  

**Obs.:** Como sou iniciante, o código pode ter alguns erros ou falhas de boas práticas.  

## ✅ Passo a passo para começar a usar

### ✅ 1. Configurando o ambiente

**Você vai precisar de:**  
- PHP (versão 7.4 ou superior).  
- MySQL (ou MariaDB).  
- Servidor local (XAMPP).  
- Editor de código (VSCode recomendado).  

### ✅ 2. Criando o banco de dados

1. Abra o **phpMyAdmin** ou outro gerenciador MySQL.  
2. Crie um banco de dados chamado:  

```sql
CREATE DATABASE blogdb;
```  

1. Importe o arquivo de script SQL que está no projeto (`blogdb.sql`).  

Esse script cria as tabelas:  
✅ `usuario` — para armazenar nome, email, senha e foto.  
✅ `post` — para armazenar os posts de cada usuário.  

### ✅ 3. Configurando a conexão com o banco

Abra o arquivo:  

```php
/models/Conexao.php
```  

Altere as informações de acordo com o seu ambiente:  

```php
$host = 'localhost';
$db = 'blogdb';
$user = 'root';
$pass = '';
```  

### ✅ 4. Como cadastrar um usuário

1. Acesse a página:  

```
http://localhost/seu-projeto/views/cadastro.php
```

2. Preencha:  
- Nome  
- Email  
- Senha  
- Foto (opcional)  

3. Clique em **Cadastrar**.  

✅ O sistema automaticamente irá:  
- Criptografar sua senha.  
- Armazenar os dados no banco.

### ✅ 5. Como fazer login

1. Acesse:  

```
http://localhost/seu-projeto/login.php
```

2. Preencha:  
- Email  
- Senha  

3. Clique em **Entrar**.  

✅ Se estiver correto:  
- O sistema cria uma `sessão` para manter você logado.  

### ✅ 6. Como acessar as páginas protegidas

- O sistema **verifica automaticamente** se você está logado.  
- Se não estiver, redireciona para o login.  

**Exemplo no código:**  

```php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
```

### ✅ 7. Como fazer logout

- Normalmente terá um botão ou link: **"Sair"**.   

✅ Isso vai:  
- Encerrar sua sessão.  
- Redirecionar para o login.

## ✅ Como funciona o sistema de autenticação?

**Por trás dos panos:**  

✅ Quando você se cadastra:  
- A senha é transformada em um código seguro (`password_hash`).  

✅ Quando você faz login:  
- O sistema verifica o email.  
- Depois checa se a senha está correta com `password_verify`.  

✅ Se tudo der certo:  
- Cria uma `$_SESSION['usuario']`.  
- Você permanece logado enquanto navega.

**Lembre-se:**  
Como sou iniciante, o código pode conter alguns erros ou falhas de boas práticas, mas o objetivo é entregar a funcionalidade.
