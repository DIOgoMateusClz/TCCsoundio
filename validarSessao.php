<?php
session_start();



if (!isset($_SESSION["emailEmpresa"]) && !isset($_SESSION["emailBanda"])) {
    header("location:loginEmpresa.php?pagina=loginEmpresa");
    exit();
    $_SESSION['idEmpresa'] = $idEmpresa; // Supondo que $idEmpresa seja o ID retornado do banco após o login
}
?>