<?php
include('config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $tema = $_POST['tema'];
    // $temaid = $_POST['temaid'];

    // Prepara a consulta SQL para inserir os dados na tabela
    $sql = "INSERT INTO simulados (tema)
            VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tema);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Simulado cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o simulado: " . $conn->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>