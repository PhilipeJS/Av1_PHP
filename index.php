<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Philipe Jean</h1>
    <form name="cadastro" action="manipular_bd.php" method="post">

        <label for="produto">Nome do Produto:</label>
        <input type="text" id="produto" name="produto" required><br>

        <label for="descricao">Descrição do Produto:</label>
        <input type="text" id="descricao" name="descricao" required><br>

        <label for="preco">Preço do Produto:</label>
        <input type="number" id="preco" name="preco" required step="0.01"><br>

        <label for="quantidade">Quantidade de Produtos:</label>
        <input type="number" min="1" id="quantidade" name="quantidade" required><br>
    
        <input type="submit" value="Enviar"/>
    </form>
</body>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST" action="excluir_produto.php">
    <label for="produto">Nome do produto:</label>
    <input type="text" id="produto" name="produto"><br>

    <input type="submit" value="Excluir">
</form>
</body>
</html>
