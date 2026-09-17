# API Games

Aplicação em Laravel para cadastro de games (CRUD), desenvolvida como trabalho da disciplina de **Manutenção de Software**, com o tema **Código Limpo**.

## Sobre o trabalho

O objetivo deste trabalho é aplicar, em uma aplicação real, as seis premissas de código limpo apresentadas no Capítulo 2 do livro *Fundamentos de Manutenção de Software*:

1. Use Verificadores de Estilo e Formatadores
2. Escolha Nomes Legíveis
3. Evite Números Mágicos
4. Adote uma Linguagem Ubíqua
5. Implemente Funções Coesas e Desacopladas
6. Separe os Fluxos de Execução

Para isso, o código-fonte foi organizado em **duas branches**, representando o "antes" e o "depois" da refatoração:

| Branch | Descrição |
|---|---|
| `main` | Versão original da aplicação, antes da aplicação das premissas de código limpo. |
| `codigo-limpo` | Versão refatorada, com as 6 premissas aplicadas ao código-fonte. |

A comparação entre as duas versões, premissa por premissa, está detalhada no relatório entregue junto com este trabalho.

## Tecnologias

- PHP / Laravel
- Blade (front-end)
- MySQL
- Docker / Docker Compose (banco de dados)

## Pré-requisitos

- PHP 8.2+
- Composer
- Docker e Docker Compose

## Como rodar o projeto

### 1. Clonar o repositório

```bash
git clone <url-do-repositorio>
cd api-games
```

### 2. Instalar as dependências

```bash
composer install
```

### 3. Configurar o ambiente

Copie o arquivo de exemplo e gere a chave da aplicação:

```bash
cp .env.example .env
php artisan key:generate
```

No `.env`, configure a conexão com o banco de dados de acordo com o `docker-compose.yml` do projeto:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3310
DB_DATABASE=game
DB_USERNAME=user_lbd
DB_PASSWORD=pass_lbd
```

### 4. Subir o banco de dados

O projeto usa Docker Compose apenas para subir o banco de dados MySQL. Com o Docker em execução, rode:

```bash
docker compose up -d
```

Isso vai iniciar um container MySQL na porta `3310`, com o banco `game` já criado e as credenciais definidas acima.

### 5. Rodar as migrations

```bash
php artisan migrate
```

### 6. Iniciar a aplicação

```bash
php artisan serve
```

Acesse `http://localhost:8000` no navegador.

## Funcionalidades

A aplicação conta com uma única página que permite:

- Cadastrar um novo game (nome, descrição e data de lançamento)
- Listar todos os games cadastrados
- Editar um game existente
- Deletar um game