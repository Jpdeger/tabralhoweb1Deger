<?php
session_start();
include("connectdb.php");
include("funcoes.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['pontuacao'])) {
        $user_data = check_login($con);
        $user_id = $user_data['user_id'];
        $pontuacao = $data['pontuacao'];

        // Obtém a pontuação total do usuário antes de salvar
        $pontuacaoTotalAnterior = $user_data['pontuacao_total'];

        // Atualiza a pontuação total apenas se a pontuação atual for maior
        if ($pontuacao > $pontuacaoTotalAnterior) {
            $query = "UPDATE users SET pontuacao_total = '$pontuacao' WHERE user_id = '$user_id'";
            mysqli_query($con, $query);
        }

        // Retorna a pontuação total atualizada
        $user_data = check_login($con); // Recarrega os dados do usuário após a atualização
        echo json_encode(['success' => true, 'pontuacao_total' => $user_data['pontuacao_total']]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Pontuação não recebida']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de requisição inválido']);
}
?>