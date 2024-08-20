### 1. **Introdução**

- **Descrição do Projeto**: O projeto consiste em uma aplicação web simples com uma interface para cadastro e consulta de usuários. A página inicial exibe um menu que permite navegar entre a tela de cadastro de novos usuários e a tela de consulta dos usuários já cadastrados. A interface foi desenvolvida utilizando HTML e CSS, com o framework Materialize para estilização responsiva e moderna. A estrutura do projeto segue o padrão MVC (Model-View-Controller), implementado em PHP. Além disso, foram utilizados Composer para o gerenciamento de dependências e SQL para a interação com o banco de dados. O projeto é ideal para quem deseja entender a implementação de CRUD básico em um ambiente web utilizando PHP.
- **Ambiente de Desenvolvimento**: Sistema Windows 10 64 bit, XAMPP, VS Code, PHP 8.3

### 2. **Configuração do Ambiente**

1. Instalação do XAMPP

   :

   - Baixe e instale o [XAMPP](https://www.apachefriends.org/index.html), garantindo que o Apache e MySQL estejam ativos.

2. Configuração do Projeto

   :

   - Crie um diretório para o projeto dentro da pasta `htdocs` do XAMPP:`C:\\\\xampp\\\\htdocs\\\\curso-mvc`.
   - Configure o Virtual Host para facilitar o acesso via navegador, opcionalmente.

3. Instalação do Composer

   :

   - Baixe e instale o [Composer](https://getcomposer.org/).

   - No terminal, navegue até o diretório do projeto e execute o comando:

     ```bash
     composer init
     ```

   - Instale as dependências necessárias, como o autoload.

4. Configuração do Banco de Dados

   :

   - Acesse o `phpMyAdmin` e crie um banco de dados chamado `curso_mvc`.

   - Crie a tabela `tb_person`:

     ```sql
     CREATE TABLE tb_person (
       id INT PRIMARY KEY AUTO_INCREMENT,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL
     );
     ```

### 3. **Estrutura do Projeto**

1. Pasta `app`

   :

   - **`controllers`**: Controladores responsáveis por interagir com as views e modelos.
   - **`models`**: Classes responsáveis pela lógica de negócio e interação com o banco de dados.
   - **`views`**: Arquivos de apresentação (HTML) que recebem dados dos controladores.
   - **`.htaccess`**: Impede que usuários externos acessem diretamente os arquivos dentro da pasta `app/`, protegendo controladores, modelos e outras configurações críticas.

2. Pasta `core`

   :

   - **`Router.php`**: Arquivo responsável por gerenciar as rotas do sistema.

3. Pasta `vendor`

   :

   - Gerenciada pelo Composer para autoload e outras dependências.

4. Arquivos principais

   :

   - **`index.php`**: Ponto de entrada da aplicação.
   - **`.htaccess`**: Configuração opcional para URL amigável.

### 4. **Implementação**

1. Controladores

   :

   - **`Site.php`**: Controlador principal com métodos para as páginas `home`, `cadastro`, `consulta`, `editar`, `alterar`, `confirmaDelete` e `deletar`.

2. Modelos

   :

   - **`Crud.php`**: Classe com métodos para `create`, `read`, `update`, `delete` e `editForm`.

3. Views

   :

   - **`home.php`**: Página inicial com links para cadastro e consulta.
   - **`cadastro.php`**: Formulário para cadastro de novos usuários.
   - **`consulta.php`**: Exibe uma lista de usuários cadastrados.
   - **`editar.php`**: Formulário para edição dos dados de um usuário existente.
   - **`confirmaDelete.php`**: Confirmação de exclusão de usuário.

### 5. **Funcionalidades Implementadas**

1. Cadastro de Usuários

   :

   - Através da página `cadastro.php`, os dados dos usuários são enviados para o método `create` e armazenados no banco de dados.

2. Consulta de Usuários

   :

   - A página `consulta.php` exibe a lista de usuários, acessando o banco de dados via o método `read`.

3. Edição de Usuários

   :

   - A funcionalidade de edição permite a atualização dos dados de um usuário específico, utilizando o método `update`.

4. Exclusão de Usuários

   :

   - O método `delete` é responsável por excluir um registro após confirmação.

### 6. **Considerações Finais**

- **Replicação do Projeto**: Para replicar este projeto, basta seguir as etapas descritas, ajustando conforme necessário para o novo ambiente ou requisitos específicos.
- **Melhorias Futuras**: Implementar validações mais robustas, segurança aprimorada e integração com outras tecnologias, como APIs RESTful.