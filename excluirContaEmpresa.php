<?php
session_start();
include("conexaoBD.php");

if (isset($_POST['excluirContaEmpresa']) && $_POST['excluirContaEmpresa'] === 'true') {
    if (isset($_SESSION['idEmpresa'])) {
        $idEmpresa = $_SESSION['idEmpresa'];

        // Excluindo os dados da banda da tabela "bandas"
        $sql = "DELETE FROM empresas WHERE idEmpresa = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $idEmpresa);

        if ($stmt->execute()) {
            // Excluindo a sessão
            session_unset();
            session_destroy();
            echo 'success'; // Retorna 'success' em caso de sucesso
        } else {
            echo 'Erro ao excluir conta.'; // Retorna erro se algo der errado
        }
    } else {
        echo 'Erro: Empresa não encontrada na sessão.';
    }
} else {
    echo 'Requisição inválida.';
}
?>
