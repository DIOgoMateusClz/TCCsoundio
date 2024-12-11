<?php
session_start();
include("conexaoBD.php");

if (isset($_POST['excluirConta']) && $_POST['excluirConta'] === 'true') {
    if (isset($_SESSION['idBanda'])) {
        $idBanda = $_SESSION['idBanda'];


        $sql = "DELETE FROM bandas WHERE idBanda = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $idBanda);

        if ($stmt->execute()) {
     
            session_unset();
            session_destroy();
            echo 'success'; 
        } else {
            echo 'Erro ao excluir conta.'; 
        }
    } else {
        echo 'Erro: Banda não encontrada na sessão.';
    }
} else {
    echo 'Requisição inválida.';
}
?>
