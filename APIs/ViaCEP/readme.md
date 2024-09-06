# README

## Objetivo

Este projeto tem o objetivo de familiarizar-se com o uso de APIs públicas em PHP e entender melhor os conceitos relacionados ao back-end, sem foco na estilização, mas sim na funcionalidade e manipulação de dados.

### Descrição

Criamos um formulário simples em PHP que permite ao usuário buscar informações de um endereço com base no CEP fornecido. O formulário é basicamente uma interface para enviar o CEP ao servidor e obter a resposta da API ViaCEP.

### Estrutura dos Arquivos

- `index.php`: Arquivo inicial com suporte do ChatGPT para orientação sobre o uso de PHP com APIs. Este arquivo serve como um exemplo básico para entender a integração com APIs.
- `teste.php`: Arquivo desenvolvido de forma independente, utilizando o conhecimento adquirido e as anotações anteriores.

### Funcionalidades Implementadas

#### 1. **Uso do PHP para Processamento de Dados:**

- **Verificação do Método de Requisição:** Utiliza `$_SERVER["REQUEST_METHOD"] == "POST"` para garantir que o código PHP só seja executado quando o formulário for enviado.
- **Função para Buscar Dados do CEP:** Cria uma função que aceita o CEP como parâmetro e faz a requisição à API, processando a resposta e exibindo as informações.

#### 2. **Tratamento de Respostas e Erros:**

- **Verificação da Resposta da API:** Utiliza `@file_get_contents($url)` para tentar obter a resposta da API e adiciona verificação para garantir que a resposta foi obtida corretamente.
- **Decodificação e Exibição dos Dados:** Utiliza `json_decode` para converter a resposta JSON em um array associativo e exibe as informações do CEP, tratando erros adequadamente.
- **Verificação de Erros no JSON:** Verifica a presença da chave `'erro'` no array decodificado para identificar se o CEP é válido e se a resposta está vazia.

#### 3. **Segurança e Melhoria da Exibição:**

- **Uso de `htmlspecialchars`:** Aplica `htmlspecialchars` ao exibir dados do usuário para prevenir ataques XSS (Cross-Site Scripting) e garantir que os dados sejam exibidos de forma segura.

### Funções e Métodos

- **`$_SERVER`:**
  - Superglobal: Array associativo.
  - Informações do servidor e ambiente de execução (método HTTP, IP, etc).
  - Exemplo: `$_SERVER["REQUEST_METHOD"]` verifica se o método é `POST` ou `GET`.
- **`$_POST`:**
  - Superglobal: Array associativo.
  - Dados enviados via método `POST` de um formulário HTML.
  - Exemplo: `$_POST["nome"]` acessa o valor do campo "nome".
- **`file_get_contents()`:**
  - Função: Lê o conteúdo de um arquivo ou URL.
  - Usada para: Fazer requisições de APIs (via HTTP) e retornar o conteúdo da resposta.
  - Exemplo: `file_get_contents($url)` lê o conteúdo da URL.
- **`json_decode()`:**
  - Função: Converte JSON em array ou objeto PHP.
  - Usada para: Processar respostas de APIs que retornam dados no formato JSON.
  - Exemplo: `json_decode($json, true)` transforma JSON em um array associativo.
- **`isset()`:**
  - Função: Verifica se uma variável está definida e não é `null`.
  - Usada para: Garantir que uma variável existe antes de usá-la.
  - Exemplo: `isset($variavel)` retorna `true` se a variável estiver definida.

### Observações

- Interpolação de Strings:
  - A interpolação é mais prática e direta com aspas duplas (`"`). Dentro de strings com aspas simples (`'`), o PHP não realiza interpolação de variáveis.