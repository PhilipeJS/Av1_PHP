<?php

$conexao = mysqli_connect("localhost", "root", "", "cadastro_supermercado");
        
        if (!$conexao) {
            die("Erro de conexão com o Banco de Dados");
        }

?>