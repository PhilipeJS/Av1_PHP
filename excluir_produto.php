<?php
// Conexão com o banco de dados
include("conexao.php");

if (!$conexao) {
    die("Erro de conexão com o Banco de Dados");
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST["produto"];
    

    // Verifica se pelo menos um critério foi preenchprodutoo
    if (empty($produto)) {
        echo "Preencha o critério para exclusão.";
        exit;
    }

    // Monta a query DELETE com base nos critérios preenchprodutoos
    $sql = "DELETE FROM produtos WHERE 1=1";

    if (!empty($produto)) {
        $sql .= " AND produto = '" . mysqli_real_escape_string($conexao, $produto) . "'";
    }

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0) {
        echo "Registro excluído com sucesso!";
    } else {
        echo "Nenhum registro encontrado para exclusão.";
    }
}

mysqli_close($conexao);
?>