<?php
session_start();
include("connectdb.php");
include("funcoes.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" type="text/css" href="rankingstyles.css">
</head>
<body>
    <div class="ranking-container">
        <h1>Ranking</h1>
        <table>
            <tr>
                <th>Posição</th>
                <th>Usuário</th>
                <th>Pontuação Total</th>
            </tr>

            <?php

            $user_data = check_login($con);


            $query = "SELECT user_name, pontuacao_total FROM users ORDER BY pontuacao_total DESC";
            $result = mysqli_query($con, $query);

            if ($result) {
                $posicao = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td>' . $posicao . '</td>
                            <td>' . $row['user_name'] . '</td>
                            <td>' . $row['pontuacao_total'] . '</td>
                          </tr>';
                    $posicao++;
                }
            } else {
                echo '<tr><td colspan="3">Erro ao obter o ranking.</td></tr>';
            }
            ?>

        </table>
        <br>
        <a href="index.php">Voltar para o Jogo</a>
    </div>
</body>
</html>
