<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<?php include("conexaoBD.php"); ?>

<body>
<div class="w3-content w3-margin-top" style="max-width:1700px;">
  <?php
    // Obtendo o ID da empresa a partir da URL
    $id = isset($_GET['idBanda']) ? intval($_GET['idBanda']) : 0;

    if ($id > 0) {
        // Consulta para obter informações da empresa com base no ID
        $sql = "SELECT idBanda, fotoBanda, nomeBanda, descricaoBanda, cidadeBanda, estadoBanda, telefoneBanda, rock, heavyMetal,
        punk, hardcore, sertanejo, pagode, samba, gospel, rap, funk, MPB, galeriaBanda, emailBanda, senhaBanda
                FROM bandas WHERE idBanda = $id";
            
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fotoBanda = $row["fotoBanda"];
            $nomeBanda = $row["nomeBanda"];
            $descricaoBanda = $row["descricaoBanda"];
            $cidadeBanda = $row["cidadeBanda"];
            $estadoBanda = $row["estadoBanda"];
            $telefoneBanda = $row["telefoneBanda"];
         
            // Generos
            $genero = [];
            if ($row['rock']) $genero[] = "Rock";
            if ($row['heavyMetal']) $genero[] = "Heavy Metal";
            if ($row['punk']) $genero[] = "Punk";
            if ($row['hardcore']) $genero[] = "Hardcore";
            if ($row['sertanejo']) $genero[] = "Sertanejo";
            if ($row['pagode']) $genero[] = "Pagode";
            if ($row['samba']) $genero[] = "Samba";
            if ($row['gospel']) $genero[] = "Gospel";
            if ($row['rap']) $genero[] = "Rap";
            if ($row['funk']) $genero[] = "Funk";
            if ($row['MPB']) $genero[] = "MPB";
            
            $generoTexto = implode(", ", $genero);
           
            $galeriaBanda = $row["galeriaBanda"];
        } else {
            echo '<p>Banda não encontrada.</p>';
        }
    } else {
        echo '<p>ID da Banda inválido.</p>';
    }
  ?>

  <!-- Layout principal -->
  <div class="w3-row-padding">
    <!-- Coluna da esquerda -->
    <div class="w3-third">
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="<?= $fotoBanda ?? 'img/default.png' ?>" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-white">
            <h2><?= $nomeBanda ?? 'Nome da Banda' ?></h2>
          </div>
        </div>
        <br>
        <div class="w3-container">
          <p><img src="icones/iconStar.png" width="20" height="20">&nbsp;<?= $generoTexto ?? 'Gênero não especificado' ?></p>
          <p><img src="icones/iconLocation.png" width="20" height="20">&nbsp;<?= $cidadeBanda ?? 'Cidade desconhecida' ?> - <?= $estadoBanda ?? 'Estado desconhecido' ?></p>
          
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
            $fotos = explode(',', $galeriaBanda);
            $numFotos = count($fotos);
            for ($i = 0; $i < 6; $i++) {
                $foto = $i < $numFotos ? htmlspecialchars(trim($fotos[$i])) : 'uploads2/placeholder.jpg';
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
                    <a href="contatoBanda.php?idBanda=<?= $id ?>" title="Entrar em Contato" style="text-decoration:none;">
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
          <p><?= $descricaoBanda ?? 'Descrição não disponível.' ?></p>
        </blockquote>

        <br>
          <h2><strong>CIDADE</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($cidadeBanda) . " - " . htmlspecialchars($estadoBanda)?></p>
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
