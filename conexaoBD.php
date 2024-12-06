<?php

$servidorBD = "localhost";
$usuarioBD  = "root";
$senhaBD    = "";
$database   = "soundio2";

// Função do PHP para estabelecer conexão com o BD
$link = mysqli_connect($servidorBD, $usuarioBD, $senhaBD, $database);

if(!$link) {
    // Não exibir detalhes de conexão em produção
    die("<p>Erro ao tentar conectar ao servidor de banco de dados. Por favor, tente novamente mais tarde.</p>");
} else {
    // Ideal para ambiente de desenvolvimento
    //echo "<p>Conexão estabelecida com sucesso!</p>";
}
?>
