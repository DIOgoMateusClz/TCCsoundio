<?php
include("header.php");
include("validarSessao.php"); // Verifica se o usuário está logado
include("conexaoBD.php"); // Conexão com o banco de dados

// Verifica se a banda está logada
if (!isset($_SESSION['idBanda'])) {
    echo "Erro: Banda não encontrada. Faça login novamente.";
    exit;
}

// Obtém o ID da banda logada da sessão
$idBanda = $_SESSION['idBanda'];

?>

<title>Meus Eventos</title>

<div class="container mt-5">
    <div class="jumbotron text-left">
        <h2><strong>Meus Eventos</strong></h2>
        <br>

        <?php
        // Consulta SQL para obter eventos relacionados à banda logada
        $sql = "SELECT e.idEvento, e.nomeEvento, e.dataEvento, e.fotoEvento 
                FROM eventos e
                WHERE e.idBanda = ?"; // Agora busca pelos eventos da banda logada
        
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $idBanda); // Passa o idBanda para a consulta
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<ul class="list-group">';
            while ($row = $result->fetch_assoc()) {
                echo '<a href="verEventoBanda.php?idEvento=' . $row["idEvento"] . '" class="list-group-item list-group-item-action d-flex align-items-center text-decoration-none text-dark">';
                echo '<img src="' . htmlspecialchars($row["fotoEvento"]) . '" alt="' . htmlspecialchars($row["nomeEvento"]) . '" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">';
                echo '<div class="flex-grow-1">';
                echo '<strong>' . htmlspecialchars($row["nomeEvento"]) . '</strong>';
                echo '</div>';
                echo '<span class="badge bg-warning text-dark">' . date("d/m/Y", strtotime($row["dataEvento"])) . '</span>';
                echo '</a>';
            }
            echo '</ul>';
        } else {
            echo "<p>Nenhum evento encontrado.</p>";
        }

        $stmt->close();
        $link->close();
        ?>
    </div>
</div>

<?php include("footer.php"); ?>
