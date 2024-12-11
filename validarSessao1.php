<?php
    session_start(); 
    if (!isset($_SESSION["emailBanda"])){
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=naoLogado');
    }
?>