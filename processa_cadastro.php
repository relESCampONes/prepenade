<?php
include('config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $pergunta = $_POST['pergunta'];
    $alternativa_a = $_POST['alternativa_a'];
    $alternativa_b = $_POST['alternativa_b'];
    $alternativa_c = $_POST['alternativa_c'];
    $alternativa_d = $_POST['alternativa_d'];
    $alternativa_e = $_POST['alternativa_e'];
    $alternativa_correta = $_POST['alternativa_correta'];
    $motivo = $_POST['motivo'];

    // Prepara a consulta SQL para inserir os dados na tabela
    $sql = "INSERT INTO questoes (pergunta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, alternativa_correta, motivo)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $pergunta, $alternativa_a, $alternativa_b, $alternativa_c, $alternativa_d, $alternativa_e, $alternativa_correta, $motivo);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Questão cadastrada com sucesso.";
    } else {
        echo "Erro ao cadastrar a questão: " . $conn->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>