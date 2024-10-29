<?php
    session_start(); //Inicia uma sessão
    if (!isset($_SESSION["emailBanda"])){
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=naoLogado');
    }
?>