<?php
session_start();
include("connectdb.php");
include("funcoes.php");

// Verifica se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    die();
}

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.cdnfonts.com/css/pokemon-solid" rel="stylesheet">
    <title>Pokedigitação</title>
</head>
<body>
    <div class="game-container">
        <h1>Pokedigitação</h1>
        <div class="word-container">
            <p id="palavra-atual"></p>
            <input type="text" id="palavra-input" placeholder="Digite a palavra">
            <p id="mensagem"></p>
            <p>Tempo: <span id="time">0</span> segundos</p>
            <p>Pontuação: <span id="pontuacao">0</span></p>
            <p><span id="pontuacao-total">0</span></p>
        </div>
        <button id="start-button">Iniciar Jogo</button><br>

            <a href="ranking.php">Ranking</a><br>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>