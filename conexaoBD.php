<?php

$servidorBD = "localhost";
$usuarioBD  = "root";
$senhaBD    = "";
$database   = "soundio2";


$link = mysqli_connect($servidorBD, $usuarioBD, $senhaBD, $database);

if(!$link) {

    die("<p>Erro ao tentar conectar ao servidor de banco de dados. Por favor, tente novamente mais tarde.</p>");
} else {
    //echo "<p>Conexão estabelecida com sucesso!</p>";
}
?>
