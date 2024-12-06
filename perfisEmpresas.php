<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<?php include("conexaoBD.php"); ?>

<body>
<div class="w3-content w3-margin-top" style="max-width:1700px;">
  <?php
    // Obtendo o ID da empresa a partir da URL
    $id = isset($_GET['idEmpresa']) ? intval($_GET['idEmpresa']) : 0;

    if ($id > 0) {
        // Consulta para obter informações da empresa com base no ID
        $sql = "SELECT idEmpresa, fotoEmpresa, nomeEmpresa, cnpjEmpresa, cepEmpresa, bar, lanchonete, restaurante, casadeShows,
         pizzaria, centrodeEventos, cidadeEmpresa, estadoEmpresa, descricaoEmpresa, telefoneEmpresa, galeriaEmpresa
                FROM empresas WHERE idEmpresa = $id";
            
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fotoEmpresa = $row["fotoEmpresa"];
            $nomeEmpresa = $row["nomeEmpresa"];
            $cnpjEmpresa = $row["cnpjEmpresa"];
            $cepEmpresa = $row["cepEmpresa"];
         
            // Generos
            $tipo = [];
            if ($row['bar']) $tipo[] = "Bar";
            if ($row['lanchonete']) $tipo[] = "Lanchonete";
            if ($row['restaurante']) $tipo[] = "Restaurante";
            if ($row['casadeShows']) $tipo[] = "Casa de Shows";
            if ($row['pizzaria']) $tipo[] = "Pizzaria";
            if ($row['centrodeEventos']) $tipo[] = "Centro de Eventos";
            $tipoTexto = implode(", ", $tipo);

            $cidadeEmpresa = $row["cidadeEmpresa"];
            $estadoEmpresa = $row["estadoEmpresa"];
            $descricaoEmpresa = $row["descricaoEmpresa"];
            $telefoneEmpresa = $row["telefoneEmpresa"];
            $galeriaEmpresa = $row["galeriaEmpresa"];
        } else {
            echo '<p>Empresa não encontrada.</p>';
        }
    } else {
        echo '<p>ID da Empresa inválido.</p>';
    }
  ?>

  <!-- Layout principal -->
  <div class="w3-row-padding">
    <!-- Coluna da esquerda -->
    <div class="w3-third">
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="<?= $fotoEmpresa ?? 'img/default.png' ?>" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-white">
            <h2><?= $nomeEmpresa ?? 'Nome da Empresa' ?></h2>
          </div>
        </div>
        <br>
        <div class="w3-container">
          <p><img src="icones/iconStar.png" width="20" height="20">&nbsp;<?= $tipoTexto ?? 'Tipo não especificado' ?></p>
          <p><img src="icones/iconLocation.png" width="20" height="20">&nbsp;<?= $cidadeEmpresa ?? 'Cidade desconhecida' ?> - <?= $estadoEmpresa ?? 'Estado desconhecido' ?></p>
          <p><img src="icones/iconCNPJ.png" width="20" height="20">&nbsp;&nbsp;
<?php
    // Agora estamos usando $row['cnpjEmpresa'] que contém os dados da empresa obtidos na consulta
    $cnpj = $row['cnpjEmpresa'];
    
    // Remove qualquer caractere que não seja número
    $cnpj = preg_replace('/\D/', '', $cnpj);
    
    // Verifica se o CNPJ tem 14 dígitos
    if (strlen($cnpj) == 14) {
        // Formata o CNPJ para o formato: XX.XXX.XXX/XXXX-XX
        $cnpjFormatado = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
        echo htmlspecialchars($cnpjFormatado);
    } else {
        // Caso o CNPJ não tenha 14 dígitos, exibe ele sem formatação
        echo htmlspecialchars($cnpj);
    }
?>
</p>
          <hr>
        </div>
      </div>
      <br>
    </div>

    <!-- Coluna da direita -->
    <div class="w3-twothird">
      <div class="jumbotron text-left">
        <h2><strong>&nbsp;&nbsp;FOTOS</strong></h2>
        <div class="w3-row-padding">
            <?php
            // Dividindo a galeria de fotos
            $fotos = explode(',', $galeriaEmpresa);
            $numFotos = count($fotos);
            for ($i = 0; $i < 6; $i++) {
                $foto = $i < $numFotos ? htmlspecialchars(trim($fotos[$i])) : 'uploads/placeholder.jpg';
                echo '
                <div class="jumbotron text-center w3-half w3-container w3-margin-bottom" style="padding: 5px;">
                    <img src="' . $foto . '" style="width:100%; height:350px; object-fit:cover;" class="w3-hover-opacity">
                </div>';
            }
            ?>
        </div>
    
      <br>
      <div class="jumbotron text-center">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <?php if (isset($id) && $id > 0): ?>
                    <a href="contatoEmpresa.php?idEmpresa=<?= $id ?>" title="Entrar em Contato" style="text-decoration:none;">
                        <button type="button" class="btn btn-warning btn-lg w-100 text-dark">
                            <strong>Entrar em contato</strong>
                        </button>
                    </a>
                <?php else: ?>
                    <button type="button" class="btn btn-warning btn-lg w-100 text-dark" disabled>
                        <strong>Entrar em contato</strong>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <br>
</div>
      <!-- Descrição e Endereço -->
      <div class="container">
        <h2><strong>DESCRIÇÃO</strong></h2>
        <blockquote>
          <p><?= $descricaoEmpresa ?? 'Descrição não disponível.' ?></p>
        </blockquote>

        <br>
          <h2><strong>CIDADE</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($cidadeEmpresa) . " - " . htmlspecialchars($estadoEmpresa)
            ."<br> CEP: ".htmlspecialchars($cepEmpresa); ?></p>
          </blockquote>
         
      </div>
    </div>
  </div>
</div>
<br>        <br>        <br>        <br>
<?php $link->close(); ?>
<?php include("footer.php"); ?>
</body>
</html>
