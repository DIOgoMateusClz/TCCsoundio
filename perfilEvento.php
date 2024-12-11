<?php 
include("validarSessao.php"); 
include("header.php"); 
include("conexaoBD.php");


if (!isset($_GET['idEvento'])) {
    echo "Erro: Evento não encontrado.";
    exit;
}


$idEvento = $_GET['idEvento'];


$idEmpresaLogada = $_SESSION['idEmpresa'] ?? null;


$sql = "SELECT e.nomeEvento, e.dataEvento, e.horaEvento, e.precoEvento, e.localEvento, e.descricaoEvento, e.fotoEvento, 
               b.nomeBanda, emp.nomeEmpresa, emp.estadoEmpresa, emp.cidadeEmpresa, e.idEmpresa
        FROM eventos e
        JOIN bandas b ON e.idBanda = b.idBanda
        JOIN empresas emp ON e.idEmpresa = emp.idEmpresa
        WHERE e.idEvento = ?";
        
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $idEvento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Erro: Evento não encontrado.";
    exit;
}


$evento = $result->fetch_assoc();


$isEmpresaAutorizada = ($idEmpresaLogada && $evento['idEmpresa'] == $idEmpresaLogada);

if ($isEmpresaAutorizada && isset($_POST['excluirEvento'])) {
  
    $deleteSql = "DELETE FROM eventos WHERE idEvento = ?";
    $deleteStmt = $link->prepare($deleteSql);
    $deleteStmt->bind_param("i", $idEvento);
    
    if ($deleteStmt->execute()) {
        echo "<script>alert('Evento excluído com sucesso.'); window.location.href = 'meusContratos.php';</script>";
        exit;
    } else {
        echo "Erro: Não foi possível excluir o evento.";
    }
}
?>

<div class="row">
    <div class="col-12 col-md-10 col-lg-8 mx-auto">
        <button type="button" class="btn btn-dark btn-lg w-100" onclick="window.location.href='editarEvento.php?idEvento=<?php echo $idEvento; ?>';">
            <strong>Editar Evento</strong>
            <img src="icones/iconEdit.png" width="20" height="20" alt="Editar">
        </button>
    </div>
</div>

<title>Perfil do Evento</title>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h2><strong><?php echo htmlspecialchars($evento['nomeEvento']); ?></strong></h2>
        
        <div class="mt-4 mb-4">
            <img src="<?php echo htmlspecialchars($evento['fotoEvento']); ?>" alt="<?php echo htmlspecialchars($evento['nomeEvento']); ?>" class="img-fluid rounded" style="max-width: 20%; height: auto;">
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p><strong>Data:</strong> <span style="color:#d2691e;"><?php echo date("d/m/Y", strtotime($evento['dataEvento'])); ?></span></p>
                <p><strong>Hora:</strong> <span style="color:#d2691e;"><?php echo $evento['horaEvento']; ?></span></p>
                <p><strong>Local:</strong> <span style="color:#d2691e;"><?php echo htmlspecialchars($evento['localEvento']); ?></span></p>
                <p><strong>Banda:</strong> <span style="color:#d2691e;">
                    <a href="perfisBandas.php?idBanda=<?php echo $evento['idBanda']; ?>"><?php echo htmlspecialchars($evento['nomeBanda']); ?></a>
                </span></p>
                <p><strong>Organizador:</strong> <span style="color:#d2691e;">
                    <a href="perfisEmpresas.php?idEmpresa=<?php echo $evento['idEmpresa']; ?>"><?php echo htmlspecialchars($evento['nomeEmpresa']); ?></a>
                </span></p>
                <p><strong>Estado:</strong> <span style="color:#d2691e;"><?php echo htmlspecialchars($evento['estadoEmpresa']); ?></span></p>
                <p><strong>Cidade:</strong> <span style="color:#d2691e;"><?php echo htmlspecialchars($evento['cidadeEmpresa']); ?></span></p>
                <p><strong>Preço:</strong> <span style="color:#d2691e;"><?php echo "R$ " . number_format($evento['precoEvento'], 2, ',', '.'); ?></span></p>
                
                <?php if (!empty($evento['descricaoEvento'])): ?>
                    <p><strong>Descrição:</strong></p>
                    <p style="color:#d2691e;"><?php echo nl2br(htmlspecialchars($evento['descricaoEvento'])); ?></p>
                <?php else: ?>
                    <p><strong>Descrição:</strong> Não disponível.</p>
                <?php endif; ?>

                <?php if ($isEmpresaAutorizada): ?>
                    <form method="post" action="">
                        <button type="submit" name="excluirEvento" class="btn btn-danger">Excluir Evento</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<br>

<?php 
$stmt->close();
$link->close();
include("footer.php");
?>
