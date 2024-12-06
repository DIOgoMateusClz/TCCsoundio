<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<?php include("conexaoBD.php"); ?>

<?php
$idEvento = $_SESSION['idEvento'];
if (isset($_GET["idEvento"])) {
    $idEvento = $_GET["idEvento"]; // A captura do id do evento da URL

    // Buscar dados do evento
    $buscarDadosEvento = "SELECT * FROM eventos WHERE idEvento = $idEvento";
    $res = mysqli_query($link, $buscarDadosEvento) or die("<div class='alert alert-danger'>Erro ao tentar buscar dados do <strong>Evento</strong></div>");

    if ($registro = mysqli_fetch_assoc($res)) {
        $nomeEvento         = $registro["nomeEvento"];
        $descricaoEvento    = $registro["descricaoEvento"];
        $dataEvento         = $registro["dataEvento"];
        $horaEvento         = $registro["horaEvento"];
        $localEvento        = $registro["localEvento"];
        $fotoEvento         = $registro["fotoEvento"];
        $idBanda            = $registro["idBanda"]; // ID da banda do evento
    }
}

// Buscar todas as bandas para popular o dropdown
$listarBandas = "SELECT * FROM bandas";
$resBandas = mysqli_query($link, $listarBandas) or die("<div class='alert alert-danger'>Erro ao tentar carregar as <strong>Bandas</strong></div>");
?>

<div class="container mt-5">
    <div class="jumbotron text-left">
        <h2>Editar Evento</h2>
        <br>
        <form action="editarEvento.php" method="POST" enctype="multipart/form-data">

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" name="idEvento" value="<?php echo $idEvento; ?>" readonly>
                <label for="idEvento" class="form-label">*ID do Evento:</label>
            </div>

            <div class="form-group">
                <img src="<?php echo $fotoEvento; ?>" width="100"> <!-- Exibe a FOTO ATUAL cadastrada -->
                <input type="hidden" name="fotoAtual" value="<?php echo $fotoEvento; ?>"> <!-- Passa o local -->
                <input type="file" class="btn btn-link" name="fotoEvento">
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Nome do Evento" name="nomeEvento" value="<?php echo $nomeEvento; ?>">
                <label for="nomeEvento" class="form-label">Nome do Evento:</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <textarea class="form-control" placeholder="Descrição do evento" name="descricaoEvento" id="descricaoEvento" maxlength="1000" style="height: 150px;"><?php echo $descricaoEvento; ?></textarea>
                <label for="descricaoEvento" class="form-label">Descrição:</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="date" class="form-control" name="dataEvento" value="<?php echo $dataEvento; ?>">
                <label for="dataEvento" class="form-label">Data do Evento:</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="time" class="form-control" name="horaEvento" value="<?php echo $horaEvento; ?>">
                <label for="horaEvento" class="form-label">Hora do Evento:</label>
            </div>

            <div class="form-floating mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Local do Evento" name="localEvento" value="<?php echo $localEvento; ?>">
                <label for="localEvento" class="form-label">Local:</label>
            </div>

            <!-- Campo para selecionar a banda -->
            <div class="form-floating mb-3 mt-3">
                <select class="form-select" name="idBanda">
                    <?php
                    while ($banda = mysqli_fetch_assoc($resBandas)) {
                        $selected = ($banda['idBanda'] == $idBanda) ? 'selected' : ''; // Marca a banda atual como selecionada
                        echo "<option value='{$banda['idBanda']}' $selected>{$banda['nomeBanda']}</option>";
                    }
                    ?>
                </select>
                <label for="idBanda" class="form-label">Banda:</label>
            </div>

            <div class="jumbotron text-center">
                <div style="margin-top:30px; margin-bottom:30px;">
                    <button type="submit" class="btn btn-outline-dark btn-lg">Atualizar Evento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>
