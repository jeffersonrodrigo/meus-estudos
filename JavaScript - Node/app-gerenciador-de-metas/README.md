# README

## App Gerenciador de Metas

Este projeto foi desenvolvido durante o módulo de iniciante em JavaScript e Node.js, oferecido pela Rocketseat durante a semana NLW. Ele é um **gerenciador de metas** simples que permite cadastrar, listar, marcar como concluídas, deletar e visualizar metas abertas ou realizadas. A intenção principal foi praticar conceitos de JavaScript assíncrono, manipulação de arquivos e interação com o terminal.

## Funcionalidades:
- Cadastrar novas metas
- Listar todas as metas
- Marcar metas como concluídas
- Verificar metas abertas ou realizadas
- Deletar metas

## Instalação:
1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/app-gerenciador-de-metas.git
   ```
2. Acesse o diretório do projeto:
   ```bash
   cd app-gerenciador-de-metas
   ```
3. Instale as dependências:
   ```bash
   npm install
   ```

## Como usar:
1. Execute o aplicativo:
   ```bash
   node app.js
   ```
2. Navegue pelo menu usando as setas e siga as instruções exibidas na tela.

## Pré-requisitos:
- Node.js instalado (v14 ou superior)
- Gerenciador de pacotes npm

## Estrutura do projeto:
- **app.js**: Arquivo principal que contém toda a lógica do aplicativo.
- **metas.json**: Arquivo que armazena as metas cadastradas.

## Como funciona:
O aplicativo utiliza o pacote `@inquirer/prompts` para interagir com o usuário no terminal, exibindo menus, recebendo entradas e processando metas. Todas as metas são armazenadas no arquivo `metas.json` de forma persistente.

## Motivação:
Este projeto foi desenvolvido para praticar habilidades de JavaScript, principalmente relacionadas a:
- Manipulação de arquivos com `fs`
- Funções assíncronas com `async/await`
- Interação com o terminal
- Gerenciamento de dados em formato JSON

## Autor:
Projeto desenvolvido por **Jefferson Rodrigo**, como parte dos estudos na **Rocketseat NLW**.
