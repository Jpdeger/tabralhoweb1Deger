let tempo = 5;
let pontuacao = 0;
let estajogando = false;
let intervaloContagem;

const palavraInput = document.querySelector('#palavra-input');
const palavraAtual = document.querySelector('#palavra-atual');
const pontuacaoDisplay = document.querySelector('#pontuacao');
const tempoDisplay = document.querySelector('#time');
const mensagem = document.querySelector('#mensagem');
const startButton = document.querySelector('#start-button');
const pontuacaoTotalElement = document.querySelector('#pontuacao-total');

const palavras = [];

async function inicio() {
    startButton.addEventListener('click', iniciarJogo);
    palavraInput.addEventListener('input', comecaPartida);
    await carregarPalavras();
    exibirPontuacaoTotal(await carregarPontuacaoTotal());
}

async function carregarPalavras() {
    try {
        const response = await fetch('https://pokeapi.co/api/v2/pokemon?limit=50');
        const data = await response.json();
        const nomesPokemon = data.results.map(pokemon => pokemon.name);
        palavras.push(...nomesPokemon);
    } catch (error) {
        console.error('Erro ao carregar palavras:', error);
    }
}

function iniciarJogo() {
    estajogando = true;
    pontuacao = 0;
    tempo = 5;
    atualizarInterface();
    mostraPalavra(palavras);
    mensagem.innerHTML = '';
    clearInterval(intervaloContagem);
    intervaloContagem = setInterval(contagem, 1000);
}

function comecaPartida() {
    if (estajogando && palavraCombina()) {
        pontuacao++;
        tempo = 5;
        atualizarInterface();
        mostraPalavra(palavras);
        palavraInput.value = '';
        mensagem.innerHTML = 'Correto';
        mensagem.style.color = 'green';
    }
}

function palavraCombina() {
    return palavraInput.value === palavraAtual.innerHTML;
}

function mostraPalavra(palavras) {
    const indexAleatorio = Math.floor(Math.random() * palavras.length);
    palavraAtual.innerHTML = palavras[indexAleatorio];
}

function contagem() {
    if (estajogando && tempo > 0) {
        tempo--;
        atualizarInterface();
    } else if (tempo === 0) {
        estajogando = false;
        atualizarInterface();
        clearInterval(intervaloContagem);
        mensagem.innerHTML = 'Acabou o Jogo!';
        mensagem.style.color = 'red';
        terminarJogo();
    }
}

async function carregarPontuacaoTotal() {
    const response = await fetch('obter_pontuacao_total.php');
    const data = await response.json();
    return data.pontuacao_total;
}

function exibirPontuacaoTotal(pontuacaoTotal) {
    pontuacaoTotalElement.innerHTML = `Recorde Individual: ${pontuacaoTotal}`;
}

function atualizarInterface() {
    pontuacaoDisplay.innerHTML = pontuacao;
    tempoDisplay.innerHTML = tempo;
}

window.addEventListener('load', inicio);

function terminarJogo() {
    estajogando = false;
    atualizarInterface();
    clearInterval(intervaloContagem);
    mensagem.innerHTML = 'Acabou o Jogo!';
    mensagem.style.color = 'red';

    enviarPontuacao(pontuacao);
}

function enviarPontuacao(pontuacao) {
    fetch('salvar_pontuacao.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ pontuacao: pontuacao }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Pontuação salva:', data);

        exibirPontuacaoTotal(data.pontuacao_total);
    })
    .catch(error => console.error('Erro ao salvar pontuação:', error));
}