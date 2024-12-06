<?php
session_start();
include("conexaoBD.php");

if (isset($_POST['excluirConta']) && $_POST['excluirConta'] === 'true') {
    if (isset($_SESSION['idBanda'])) {
        $idBanda = $_SESSION['idBanda'];

        // Excluindo os dados da banda da tabela "bandas"
        $sql = "DELETE FROM bandas WHERE idBanda = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $idBanda);

        if ($stmt->execute()) {
            // Excluindo a sessão
            session_unset();
            session_destroy();
            echo 'success'; // Retorna 'success' em caso de sucesso
        } else {
            echo 'Erro ao excluir conta.'; // Retorna erro se algo der errado
        }
    } else {
        echo 'Erro: Banda não encontrada na sessão.';
    }
} else {
    echo 'Requisição inválida.';
}
?>
