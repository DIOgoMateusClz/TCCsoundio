<?php
session_start();
include("conexaoBD.php");

if (isset($_POST['excluirContaEmpresa']) && $_POST['excluirContaEmpresa'] === 'true') {
    if (isset($_SESSION['idEmpresa'])) {
        $idEmpresa = $_SESSION['idEmpresa'];

       
        $sql = "DELETE FROM empresas WHERE idEmpresa = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);

        if ($stmt->execute()) {
           
            session_unset();
            session_destroy();
            echo 'success'; 
        } else {
            echo 'Erro ao excluir conta.'; 
        }
    } else {
        echo 'Erro: Empresa não encontrada na sessão.';
    }
} else {
    echo 'Requisição inválida.';
}
?>
