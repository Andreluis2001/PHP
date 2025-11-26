# Sistema de Livraria Online

Sistema completo de gerenciamento de livraria desenvolvido em Laravel com todas as funcionalidades solicitadas.

## 🚀 Funcionalidades

### ✅ CRUD Completo
- **Categorias**: Criar, listar, editar, visualizar e excluir categorias de livros
- **Livros**: Gerenciamento completo com título, autor, descrição, preço, estoque, ISBN e categoria

### ✅ Banco de Dados Relacional
- **MySQL** configurado como banco principal
- Relacionamentos entre categorias e livros
- Migrations estruturadas e seeders com dados de exemplo

### ✅ Gerenciamento de Sessão
- Sistema de autenticação completo (login/registro/logout)
- Proteção de rotas com middleware de autenticação
- Sessões armazenadas no banco de dados

### ✅ Upload de Arquivos
- Upload de capas de livros apenas em formatos PNG e JPG
- Validação de tipo e tamanho (máximo 2MB)
- Armazenamento em `storage/app/public`
- Preview da imagem antes do upload

### ✅ Uso de Cookies
- Cookie para lembrar a última categoria visualizada
- Exibição no dashboard da última categoria acessada
- Duração de 7 dias

### ✅ Organização e Boas Práticas
- Estrutura MVC respeitada
- Validações completas em português
- Mensagens de sucesso e erro
- Interface responsiva em Bootstrap

## 📋 Pré-requisitos

- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js (opcional, para assets)

## 🔧 Instalação

1. **Clone o repositório e navegue para a pasta do projeto:**
   ```bash
   cd Projeto_Final
   ```

2. **Instale as dependências do Composer:**
   ```bash
   composer install
   ```

3. **Configure o banco de dados no arquivo `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=livraria_db
   DB_USERNAME=root
   DB_PASSWORD=sua_senha
   ```

4. **Execute as migrações e seeders:**
   ```bash
   php artisan migrate --seed
   ```

5. **Crie o link simbólico para o storage:**
   ```bash
   php artisan storage:link
   ```

6. **Inicie o servidor de desenvolvimento:**
   ```bash
   php artisan serve
   ```

7. **Acesse o sistema em:** `http://localhost:8000`

## 👤 Acesso ao Sistema

**Usuário padrão criado pelos seeders:**
- **Email:** admin@livraria.com
- **Senha:** password

Ou crie uma nova conta através da tela de registro.

## 📊 Dados de Exemplo

O sistema vem com dados pré-cadastrados:

### Categorias:
- Ficção
- Não-ficção  
- Técnico
- Auto-ajuda
- História
- Ciência
- Fantasia
- Mistério

### Livros:
- Dom Casmurro (Machado de Assis)
- Algoritmos e Estruturas de Dados (Thomas Cormen)
- Como Fazer Amigos e Influenciar Pessoas (Dale Carnegie)
- Uma Breve História do Tempo (Stephen Hawking)
- O Senhor dos Anéis (J.R.R. Tolkien)
- E mais 5 livros de exemplo!

## 🎯 Principais Recursos

### Dashboard
- Estatísticas gerais (total de livros, categorias, valor do estoque)
- Livros adicionados recentemente
- Categorias mais populares
- Indicação da última categoria visualizada (via cookie)
- Ações rápidas para gerenciamento

### Gerenciamento de Livros
- Listagem com filtros por categoria e busca
- Formulários completos com validação
- Upload de imagem de capa
- Visualização detalhada
- Cards responsivos com informações

### Gerenciamento de Categorias  
- CRUD completo
- Visualização de livros por categoria
- Estatísticas da categoria
- Proteção contra exclusão de categorias com livros

### Sistema de Autenticação
- Login e registro de usuários
- Proteção de rotas
- Logout seguro
- Validações de formulário

## 🔒 Segurança

- Validação server-side de todos os dados
- Proteção CSRF em formulários
- Middleware de autenticação
- Validação de tipos de arquivo para upload
- Sanitização de dados de entrada

## 🎨 Interface

- Interface moderna e responsiva com Bootstrap 5
- Ícones do Bootstrap Icons
- Layout consistente e intuitivo
- Mensagens de feedback para o usuário
- Preview de imagens
- Cards e tabelas organizadas

## 📁 Estrutura do Projeto

```
app/
├── Http/Controllers/     # Controllers do sistema
├── Models/              # Models Categoria e Livro
database/
├── migrations/          # Migrations das tabelas
├── seeders/            # Seeders com dados de exemplo
resources/
├── views/              # Views Blade organizadas
routes/
├── web.php             # Rotas do sistema
```

## 🛠️ Tecnologias Utilizadas

- **Laravel 11** - Framework PHP
- **MySQL** - Banco de dados
- **Bootstrap 5** - Framework CSS
- **Bootstrap Icons** - Ícones
- **Blade** - Template engine

## 📝 Funcionalidades Detalhadas

### Cookies Implementados
- **ultima_categoria**: Armazena ID da última categoria visualizada por 7 dias

### Validações
- Formulários com validação completa em português
- Upload apenas PNG/JPG com tamanho máximo
- Campos obrigatórios e únicos onde necessário
- Relacionamentos preservados (não permite excluir categoria com livros)

### Upload de Arquivos
- Apenas imagens PNG e JPG
- Tamanho máximo de 2MB
- Armazenamento em `storage/app/public/livros`
- Preview antes do upload
- Remoção de arquivo antigo ao atualizar

### Sessões
- Gerenciadas pelo Laravel
- Armazenadas no banco de dados
- Timeout configurável
- Regeneração segura após login

Este sistema atende completamente aos requisitos solicitados, fornecendo uma solução robusta e profissional para gerenciamento de livraria! 🎉