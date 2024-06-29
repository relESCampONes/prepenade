<?php
session_start();
include ("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebe a alternativa escolhida pelo usuário
    $alternativaEscolhida = $_POST["alternativa"];

    // Obtém o ID da pergunta (você pode passar isso como hidden input no formulário)
    $perguntaId = $_POST["pergunta_id"];

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta para obter a alternativa correta da pergunta
    $sql = "SELECT alternativa_correta FROM questoes WHERE id = $perguntaId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $alternativaCorreta = $row["alternativa_correta"];

        // Verifica se a alternativa escolhida é a correta
        if ($alternativaEscolhida === $alternativaCorreta) {
            echo "Resposta correta! Parabéns!";
        } else {
            echo "Resposta incorreta. Tente novamente.";
        }
    } else {
        echo "Erro: Pergunta não encontrada.";
    }

    $conn->close();
} else {
    echo "Acesso inválido.";
}
?>