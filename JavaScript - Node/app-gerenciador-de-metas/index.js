const { select, input, checkbox } = require('@inquirer/prompts');
const fs = require("fs").promises

let mensagem = "Bem vindo ao App de Metas";

let metas

const carregarMetas = async () => {
    try {
        const dados = await fs.readFile("metas.json", "utf-8")
        metas = JSON.parse(dados)
    }
    catch (erro) {
        metas = []
    }
}

const salvarMetas = async () => {
    await fs.writeFile("metas.json", JSON.stringify(metas, null, 2))
}


const cadastrarMeta = async () => { // Função para cadastrar uma nova meta
    const meta = await input({ message: "Digite a meta:" }) // Solicita ao usuário que digite uma nova meta

    if (meta.length == 0) { // Verifica se o usuário não digitou nada
        console.log("A meta nao pode ser vazia.")
        return // Caso a pessoa nao digite nada, vai sair da função e voltar ao menu
    }

    metas.push( // Adiciona a nova meta ao array de metas
        { value: meta, checked: false }
    )
}

const listarMetas = async () => { // Função para listar e selecionar metas
    if (metas.length == 0) {
        mensagem = "Não existem metas!"
        return
    }
    const respostas = await checkbox({
        message: "Use as setas para mudar de meta, o espaço para marcar ou desmarcar e o Enter para finalizar essa etapa",
        choices: [...metas], // Espalha os elementos do array metas como opções individuais //A sintaxe ... (spread operator) "espalha" os elementos do array, transformando-os em opções individuais dentro do objeto
        instructions: false
    })

    metas.forEach((m) => {
        m.checked = false
    })

    if (respostas.length == 0) { // Verifica se nenhuma meta foi selecionada
        console.log("Nenhuma meta selecionada!")
        return
    }

    respostas.forEach((resposta) => { // Processa cada meta selecionada
        const meta = metas.find((m) => {
            return m.value == resposta
        })

        meta.checked = true
    })

    console.log("Meta(s) marcadas como concluída(s).")
}

const metasRealizadas = async () => {  // Função para listar as metas realizadas
    const realizadas = metas.filter((meta) => {
        return meta.checked
    })

    if (realizadas.length == 0) {
        console.log("Não existem metas realizadas.")
    }

    await select({
        message: "Metas realizadas",
        choices: [...realizadas]
    })
}

const metasAbertas = async () => {  // Função para listar as metas abertas
    const abertas = metas.filter((meta) => {
        return meta.checked != true
    })

    if (abertas.length == 0) {
        console.log("Não existem metas abertas.")
    }

    await select({
        message: "Metas abertas: " + abertas.length,
        choices: [...abertas]
    })
}

const deletarMetas = async () => { // Função para deletar metas
    if (metas.length == 0) {
        mensagem = "Não existem metas!"
        return
    }

    const metasDesmarcadas = metas.map((meta) => {
        return { value: meta.value, checked: false }
    })

    const itemsADeletar = await checkbox({
        message: "Selecione item para deletar",
        choices: [...metasDesmarcadas],
        instructions: false,
    })

    if (itemsADeletar.length == 0) {
        mensagem = "Nenhum item para deletar!"
        return
    }

    itemsADeletar.forEach((item) => {
        metas = metas.filter((meta) => {
            return meta.value != item
        })
    })

    mensagem = "Meta(s) deleta(s) com sucesso!"
}

const mostrarMensagem = () => {
    console.clear();

    if (mensagem != "") {
        console.log(mensagem)
        console.log("")
        mensagem = ""
    }
}

const start = async () => { // async: Declara que a função é assíncrona e sempre retorna uma promise.

    await carregarMetas()

    while (true) {
        mostrarMensagem()
        await salvarMetas()

        //await: Pausa a execução até que a promise seja resolvida(no caso aqui é a pessoa selecionar uma das opções), permitindo um código mais limpo e fácil de ler.
        const opcao = await select({
            message: "Menu >",
            choices: [
                {
                    name: "Cadastrar metas",
                    value: "cadastrar"
                },
                {
                    name: "Listar metas",
                    value: "listar"
                },
                {
                    name: "Metas realizadas",
                    value: "realizadas"
                },
                {
                    name: "Metas abertas",
                    value: "abertas"
                },
                {
                    name: "Deletar metas",
                    value: "deletar"
                },
                {
                    name: "Sair",
                    value: "sair"
                }
            ]
        })
        switch (opcao) {
            case "cadastrar":
                await cadastrarMeta()
                console.log(metas)
                break
            case "listar":
                await listarMetas()
                console.log("Vamos listar")
                break
            case "realizadas":
                await metasRealizadas()
                break
            case "abertas":
                await metasAbertas()
                break
            case "deletar":
                await deletarMetas()
                break
            case "sair":
                console.log("Até a próxima")
                return
        }
    }
}
start()