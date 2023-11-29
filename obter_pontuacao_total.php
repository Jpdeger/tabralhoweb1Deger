<?php
session_start();
include("connectdb.php");
include("funcoes.php");

header('Content-Type: application/json');

$user_data = check_login($con);

if ($user_data) {
    $user_id = $user_data['user_id'];

    $query = "SELECT pontuacao_total FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pontuacao_total = $row['pontuacao_total'];
        echo json_encode(['pontuacao_total' => $pontuacao_total]);
    } else {
        echo json_encode(['pontuacao_total' => 0]); // Se não houver pontuação, envie 0
    }
} else {
    echo json_encode(['pontuacao_total' => 0]); // Se não houver usuário logado, envie 0
}
?>