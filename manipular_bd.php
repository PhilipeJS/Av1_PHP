<?php
include("conexao.php");
// Função para limpar dados de entrada
function limparEntrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $descricao = $preco = $quantidade = "";
    $erros = [];

    // Validação do produto
    if (empty($_POST["produto"])) {
        $erros[] = "O produto é obrigatório.";
    } else {
        $produto = limparEntrada($_POST["produto"]);
        if (!preg_match("/^[a-zA-Z\s]+$/", $produto)) {
            $erros[] = "O produto deve conter apenas letras e espaços.";
        }
    }

    if (empty($_POST["preco"])) {
        $erros[] = "A preco é obrigatória.";
    } else {
        $preco = limparEntrada($_POST["preco"]);
    }

    // Validação da descrição
    if (empty($_POST["descricao"])) {
        $erros[] = "A descrição é obrigatória.";
    } else {
        $descricao = limparEntrada($_POST["descricao"]);
    }

    // Validação da quantidade
    if (empty($_POST["quantidade"])) {
        $erros[] = "A quantidade é obrigatória.";
    } else {
        $quantidade = limparEntrada($_POST["quantidade"]);
        if (!filter_var($quantidade, FILTER_VALIDATE_INT) || $quantidade < 1 || $quantidade > 80) {
            $erros[] = "A quantidade deve ser um número inteiro entre 1 e 80.";
        }
    }

    // Exibir mensagens de erro ou dados validados
    if (empty($erros)) {
        echo "Formulário enviado com sucesso!";
        
        // Conexão com o banco de dados

        // Inserção no banco de dados
        $sql = "INSERT INTO produtos (produto, descricao, preco, quantidade) VALUES ('$produto', '$descricao', '$preco', '$quantidade')";
        
        if (mysqli_query($conexao, $sql)) {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    } else {
        foreach ($erros as $erro) {
            echo "<p>$erro</p>";
        }
    }
}
?>

<?php
// Conectar ao banco de dados
include("conexao.php");

// Consultar produtos
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
$qp = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Produtos Cadastrados</h1>
    <table border="1">
        <tr style="color: white;">
            <th >ID</th>
            <th>Produto</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
        </tr>
        <?php while ($linha = mysqli_fetch_assoc($resultado)): ?>
            <?php $qp = $qp +1 ?>
            <tr>    
                <td style="color: white;"><?php echo $linha['id']; ?></td>
                <td style="color: white;"><?php echo $linha['produto']; ?></td>
                <td style="color: white;"><?php echo $linha['descricao']; ?></td>
                <td style="color: white;"><?php echo $linha['preco']; ?></td>
                <td style="color: white;"><?php echo $linha['quantidade']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p><?php echo $qp; ?></p>
    

    <?php   
    // Fechar conexão
    mysqli_close($conexao);
    ?>
</body>
</html>
