# CRUD do Pelegrao

Projeto CRUD desenvolvido em PHP. Este projeto implementa funcionalidades de cadastro, login, logout e gerenciamento de cestas de compras, incluindo a adição de fornecedores e produtos.

## Estrutura do Projeto

```
crud-do-pelegrao/
├── docker-compose.yml         # Configura múltiplos containers, inclusivo PHP, MySQL, etc.
├── Dockerfile                 # Imagem Docker para o ambiente do PHP
├── mysql/                     # Dados e logs do MySQL
├── src/
│   ├── cadastro.php           # Página para cadastro de usuários
│   ├── cesta.php              # Gerenciamento da cesta de compras
│   ├── index.php              # Página principal, dashboard do sistema
│   ├── login.php              # Página de login
│   ├── logout.php             # Script para logout
│   ├── adicionar/             # Funcionalidades para adicionar novos registros
│   │   ├── fornecedor.php     # Adição e gerenciamento de fornecedores
│   │   └── produto.php        # Adição e gerenciamento de produtos
│   └── app/
│       ├── database.php       # Configuração e conexão com o banco de dados
│       └── services/
│           ├── cestaService.php     # Lógica de negócios para cestas
│           ├── fornecedorService.php# Lógica de negócios para fornecedores
│           ├── pessoaService.php    # Lógica de negócios para pessoas
│           └── produtoService.php   # Lógica de negócios para produtos
```

## Contexto do Projeto

Este sistema foi desenvolvido para facilitar a gestão de produtos, fornecedores, e cestas de compras, possuindo as seguintes características:

- **Modularidade:** Cada funcionalidade do CRUD está segmentada em arquivos específicos para facilitar manutenção e escalabilidade.
- **Integração com Banco de Dados:** O arquivo `app/database.php` configura a conexão com o MySQL, essencial para todas as operações de CRUD.
- **Serviços Separados:** Os arquivos em `app/services/` encapsulam as regras de negócio para cada entidade (cestas, fornecedores, pessoas e produtos), promovendo reutilização e isolamento de lógicas.
- **Dockerizando o Ambiente:** Uso de `docker-compose.yml` e `Dockerfile` para criação de um ambiente consistente de execução, facilitando a implantação e testes em diferentes ambientes.

## Descrição de Arquivos Principais

- **`cadastro.php`**: Interface para criação de novos usuários e validação dos dados enviados.
- **`cesta.php`**: Permite visualizar e modificar a cesta de compras do usuário, integrando com os serviços para gerenciamento dos itens.
- **`index.php`**: Página inicial que direciona o fluxo do sistema e apresenta o dashboard com as principais informações.
- **`login.php` e `logout.php`**: Gerenciam autenticação de usuários, permitindo logins e encerramento de sessões com segurança.
- **A pasta `adicionar/`**: Contém formulários e scripts para inclusão de novos fornecedores e produtos no sistema, facilitando a atualização do catálogo.
- **`app/database.php`**: Centraliza as configurações do banco de dados e estabelece a conexão com o MySQL, garantindo acesso a todas as funcionalidades de CRUD.
- **A pasta `app/services/`**: Cada arquivo de serviço contém funções para executar operações de inserção, atualização, remoção e consulta específicas das entidades correspondentes, promovendo uma arquitetura limpa e organizada.

## Como Executar

1. Configure o ambiente com PHP e MySQL.
2. Execute `docker-compose up -d` para levantar os containers; no Powershell, o comando pode ser executado da seguinte forma: `docker-compose up -d`.
3. Acesse as páginas através do navegador, utilizando a URL onde o container PHP está rodando.

## Uso

- Cadastro de usuários, login, e gerenciamento de sessões.
- Gerenciamento de cestas de compras, incluindo adição e remoção de itens.
- Inclusão e atualização de informações de fornecedores e produtos.

## Contribuições

Sinta-se livre para abrir issues e pull requests.

## Licença

[MIT](LICENSE)
