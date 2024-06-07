# Employee Management System

Este é um sistema de gerenciamento de funcionários desenvolvido em PHP com banco de dados MySQL. O sistema permite o registro de entrada e saída dos funcionários, bem como a geração de relatórios de horas trabalhadas e dias de trabalho.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos instalados em sua máquina:

- PHP 7.4 ou superior
- Navegador web atualizado (Chrome, Firefox, Safari, etc.)

## Configuração do Projeto

Siga as etapas abaixo para configurar o projeto em seu ambiente de desenvolvimento:

1. **Clonar o repositório**:
   - Abra um terminal ou prompt de comando.
   - Navegue até o diretório onde deseja armazenar o projeto.
   - Execute o seguinte comando para clonar o repositório:
     ```
     git clone https://github.com/seu-usuario/employee-management-system.git
Criar o banco de dados:

Inicie o painel de controle do XAMPP.
Clique no botão "Start" para iniciar os serviços do Apache e do MySQL.
Abra o phpMyAdmin acessando 
http://localhost/phpmyadmin
 em seu navegador.
Crie um novo banco de dados chamado 
employee_management
.
Importar o esquema do banco de dados:

No phpMyAdmin, clique no banco de dados 
employee_management
 no menu à esquerda.
Clique na aba "Import".
Clique em "Choose File" e selecione o arquivo 
employee-management-system/db/schema.sql
.
Clique em "Go" para importar o esquema do banco de dados.
Configurar a conexão com o banco de dados:

Abra o arquivo 
employee-management-system/backend/config/db_config.php
 em um editor de texto.
Atualize as seguintes variáveis com as suas credenciais de acesso ao banco de dados MySQL:
$servername
: endereço do servidor MySQL (normalmente "localhost")
$username
: seu nome de usuário do MySQL
$password
: sua senha do MySQL
Salve o arquivo.
Iniciar o servidor web:

No painel de controle do XAMPP, clique no botão "Start" ao lado do módulo Apache.
Aguarde até que o Apache esteja em execução.
Acessar o sistema:

Abra um navegador web e acesse o seguinte endereço:
code

Copy code
http://localhost/employee-management-system/backend/index.php
code

Copy code
- Você verá a página inicial do sistema de gerenciamento de funcionários.

Agora o projeto está configurado e pronto para uso. Você pode explorar as funcionalidades do sistema, como login, registro de ponto (entrada e saída) e geração de relatórios.


Estrutura do Projeto

O projeto está organizado da seguinte maneira:


employee-management-system/
backend/
config/
: Arquivos de configuração (conexão com o banco de dados)
controllers/
: Lógica de negócio (autenticação, registro de ponto, geração de relatórios)
models/
: Classes de modelo (Usuário, Registro de Ponto)
utils/
: Classes utilitárias (Logger)
views/
: Arquivos de view (páginas PHP)
index.php
: Ponto de entrada do backend
frontend/
css/
: Arquivos CSS
js/
: Arquivos JavaScript
index.html
: Página inicial do frontend
i18n/
: Arquivos de tradução (Japonês e Inglês)
db/
: Arquivo de esquema do banco de dados MySQL

Banco de Dados (MySQL)

O script SQL para criação do banco de dados e das tabelas está localizado em 
employee-management-system/db/schema.sql
. Você pode executar esse script para configurar o banco de dados necessário para o sistema.

CREATE DATABASE employee_management;

USE employee_management;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE time_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    clock_in DATETIME NOT NULL,
    clock_out DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

Após a criação do banco de dados e das tabelas, você pode começar a usar o sistema de gerenciamento de funcionários.


Contribuição

Se você deseja contribuir para o desenvolvimento deste projeto, sinta-se à vontade para abrir issues e enviar pull requests. Será um prazer receber contribuições da comunidade.


Contato

Caso tenha alguma dúvida ou precise de mais assistência, entre em contato conosco pelo e-mail 
andrebauru@hotmail.comW