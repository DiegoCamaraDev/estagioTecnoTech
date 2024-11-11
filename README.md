# Sistema de Gestão de Associados e Anuidades

## Descrição
Este projeto é um sistema de gestão de associados e anuidades que permite o cadastro de associados, o controle de cobranças de anuidades e a verificação de pagamentos em dia e em atraso.

## Tecnologias Utilizadas
- **PHP**: Utilizado para a parte lógica do sistema.
- **MySQL**: Utilizado para a criação e gerenciamento do banco de dados.
- **HTML/CSS**: Utilizados para a marcação e estilização da página principal.

## Funcionalidades Principais
- **Cadastro de Associados**: Permite o cadastro de associados, incluindo Nome, E-mail, CPF e Data de filiação.
- **Cadastro de Anuidades**: Permite o cadastro de anuidades, com campos de Ano e Valor.
- **Cobrança de Anuidades**: Gerencia a cobrança das anuidades dos associados.
- **Pagamento de Anuidades**: Permite marcar as anuidades como pagas ou não pagas, identificando quais associados estão em dia e quais estão em atraso.

## Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (ex: Apache)
- Navegador web (para visualizar a interface)

## Instruções de Instalação

1. **Clone o repositório**:
(https://github.com/DiegoCamaraDev/estagioTecnoTech/)

2. **Configuração do Banco de Dados:**
- Crie um banco de dados no MySQL:
  
 CREATE DATABASE nome_do_banco_de_dados;

 
- Importe as tabelas necessárias para o sistema.

3. **Configure o acesso ao banco de dados no arquivo config.php, adicionando as credenciais do banco de dados:**
-
<?php
$db_host = 'localhost';
$db_name = 'nome_do_banco_de_dados';
$db_user = 'seu_usuario';
$db_pass = 'sua_senha';

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

4. **Iniciar o Servidor:**
- Execute o PHP built-in server ou configure o servidor Apache para servir o projeto:
- php -S localhost:8000
- Acesse a aplicação pelo navegador em http://localhost:8000.

#Testando a Aplicação
1. **Cadastro de Associados:**
- Acesse a página de cadastro de associados e insira as informações necessárias.
2. **Cadastro de Anuidades:**
- Vá até a página de cadastro de anuidades e insira o ano e o valor da anuidade.
3. **Cobrança e Pagamento de Anuidades:**
- Realize a cobrança das anuidades associadas e teste o status de pagamento para identificar se o associado está em dia ou em atraso.
## Estrutura de Pastas
- **/config**: Configurações do banco de dados e variáveis do sistema.
- **/model**: Classes para manipulação dos dados dos associados e anuidades.
- **/view**: Páginas da interface do usuário, como listagem de associados e anuidades.
- **/controller**: Lógica de controle entre as views e os models, contendo as regras de negócio e a manipulação das requisições.
