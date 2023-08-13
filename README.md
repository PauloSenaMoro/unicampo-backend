## UNICAMPO - Prova Técnica – Back-End
## Descrição do Projeto
Este é um projeto de prova técnica que envolve o desenvolvimento de uma API REST utilizando o PHP com o framework Laravel, juntamente com um banco de dados MySQL. A API é responsável por gerenciar informações de clientes, incluindo nome completo, data de nascimento, tipo de pessoa (física ou jurídica), CPF/CNPJ, e-mail, endereço e localização. A aplicação oferece validações de preenchimento e formato dos campos, garantindo que todas as informações sejam inseridas de acordo com as regras estabelecidas.

## Tecnologias Utilizadas
Framework Laravel: O projeto foi desenvolvido utilizando o Laravel, um framework PHP poderoso e popular que oferece uma estrutura robusta para a criação de aplicações web eficientes e escaláveis.
MySQL: O banco de dados utilizado é o MySQL, amplamente utilizado para armazenar e gerenciar os dados dos clientes.
Google Places API: A aplicação faz uso da API do Google Places para permitir a busca e seleção de endereços através do CEP, preenchendo automaticamente o endereço e a localização do cliente.
 # Funcionalidades Implementadas
Cadastro de Clientes: A API permite a inserção de informações completas de clientes, incluindo nome, data de nascimento, tipo de pessoa, CPF/CNPJ, e-mail, endereço e localização. Todos os campos são obrigatórios e são realizadas validações tanto de preenchimento quanto de formato.
Autenticação de Dados: O projeto implementa validações de CPF e CNPJ, incluindo a validação de dígitos verificadores para garantir a integridade dos dados inseridos.
Autocompletar de Endereço: Através da integração com a API do Google Places, é possível preencher o endereço automaticamente a partir do CEP fornecido pelo usuário.
Documentação com Swagger: A API é documentada utilizando o Swagger, que permite uma visualização completa e interativa da API, incluindo os endpoints disponíveis, os parâmetros necessários e as respostas esperadas.


## Requisitos do Ambiente
Certifique que esteja com o xampp em execução
Certifique-se de ter as seguintes ferramentas instaladas em seu ambiente:

- PHP (PHP 8.2.4 (cli) (built: Mar 14 2023 17:54:25) (ZTS Visual C++ 2019 x64))
- Composer (version 2.4.2)
- versão banco de dados: MariaDB 
+-----------------+
| VERSION()       |
+-----------------+
| 10.4.28-MariaDB |
+-----------------+
1 row in set (0.000 sec)

## Instalação

Pré-requisitos
Certifique-se de ter as seguintes ferramentas instaladas no seu sistema:

XAMPP (ou qualquer servidor que suporte PHP e MySQL)

composer install
Copie o arquivo de configuração .env.example para .env e configure-o com as informações do seu ambiente:

cp .env.example .env
Gere a chave de criptografia do Laravel:

php artisan key:generate
Configure as informações do banco de dados no arquivo .env.

Banco de Dados
Crie o banco de dados no seu servidor MySQL.

Execute as migrações para criar as tabelas do banco de dados:

php artisan migrate
Executando o Projeto
Inicie o servidor PHP embutido:

php artisan serve
Acesse o projeto no navegador em http://localhost:8000.
