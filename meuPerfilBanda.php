<?php
include("validarSessao.php");
include("header.php");
include("conexaoBD.php");

// Verifica se o ID da empresa está na sessão
if (!isset($_SESSION['idBanda'])) {
    echo "Erro: Banda não encontrada.";
    exit;
}

$idBanda= $_SESSION['idBanda'];

// Consulta ao banco de dados para obter os dados da empresa logada
$sql = "SELECT * FROM bandas WHERE idBanda = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $idBanda);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $banda = $result->fetch_assoc();
} else {
    echo "Erro: Banda não encontrada.";
    exit;
}
?>

<body>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1700px;">

  <!-- The Grid -->
  <div class="w3-row-padding">

    <!-- Left Column -->
    <div class="w3-third">
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="<?php echo htmlspecialchars($banda['fotoBanda']); ?>" style="width:100%" alt="Foto da Banda">
          <div class="w3-display-bottomleft w3-container w3-text-white">
            <h2><?php echo htmlspecialchars($banda['nomeBanda']); ?></h2>
          </div>
        </div>
        <br>
        <div class="w3-container">
          <p><img src="icones/iconStar.png" width="20" height="20">&nbsp;
          <?php
          // Tipos de banda
          $tiposBanda = [];
          if ((int)$banda['rock'] === 1) $tiposBanda[] = "Rock";
          if ((int)$banda['heavyMetal'] === 1) $tiposBanda[] = "Heavy Metal";
          if ((int)$banda['punk'] === 1) $tiposBanda[] = "Punk";
          if ((int)$banda['hardcore'] === 1) $tiposBanda[] = "Hardcore";
          if ((int)$banda['sertanejo'] === 1) $tiposBanda[] = "Sertanejo";
          if ((int)$banda['pagode'] === 1) $tiposBanda[] = "Pagode";
          if ((int)$banda['samba'] === 1) $tiposBanda[] = "Samba";
          if ((int)$banda['gospel'] === 1) $tiposBanda[] = "Gospel";
          if ((int)$banda['rap'] === 1) $tiposBanda[] = "Rap";
          if ((int)$banda['funk'] === 1) $tiposBanda[] = "Funk";
          if ((int)$banda['MPB'] === 1) $tiposBanda[] = "MPB";

          $tiposBandaTexto = implode(", ", $tiposBanda);
          echo htmlspecialchars($tiposBandaTexto) ?: 'Tipo de banda não especificado';
          ?>
          </p>
          <p><img src="icones/iconLocation.png" width="20" height="20">&nbsp;&nbsp;<?php echo htmlspecialchars($banda['cidadeBanda']) . ", " . htmlspecialchars($banda['estadoBanda']); ?></p>
          <hr>
          <br>  
        </div>
      </div>
      <br>
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
      <div class="jumbotron text-left">
        <h2><strong>&nbsp;&nbsp;FOTOS</strong></h2>
        <div class="w3-row-padding">
          <?php
          $fotos = explode(',', $banda['galeriaBanda']);
          $numFotos = count($fotos);

          for ($i = 0; $i < 6; $i++) {
              $foto = $i < $numFotos ? htmlspecialchars(trim($fotos[$i])) : 'uploads2/placeholder.jpg';
              echo '
              <div class="jumbotron text-center w3-half w3-container w3-margin-bottom" style="padding: 5px;">
                  <img src="' . $foto . '" style="width:100%; height:350px; object-fit:cover;" class="w3-hover-opacity">
                  <form action="editarFotoGaleriaBanda.php" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="indiceFoto" value="' . $i . '">
                      <br>
                      <input type="file" name="fotoNova" accept="image/*">
                      <br>    <br>
                      <button type="submit" class="btn btn-outline-white btn-dark btn-sm">Substituir Foto</button>
                  </form>
              </div>';
          }
          ?>
        </div>

        <div class="jumbotron text-center">
          <div class="container">
            <div class="row mb-3">
              <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <?php if (isset($idBanda) && $idBanda > 0): ?>
                  <a href="MeuContatoBanda.php?idBanda=<?= $id ?>" title="Entrar em Contato" style="text-decoration:none;">
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

            <div class="row">
              <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <button type="button" class="btn btn-dark btn-lg w-100" onclick="window.location.href='editarPerfilBanda.php';">
                    <strong>Editar Perfil</strong>
                    <img src="icones/iconEdit.png" width="20" height="20" alt="Editar">
                </button>
              </div>
            </div>
          </div>
        </div>
        <br>

        <!-- Formulário de exclusão com confirmação em JavaScript -->
        <div class="jumbotron text-center">
          <div class="container">
            <div class="row mb-3">
              <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <!-- O botão não envia o formulário diretamente, mas chama a função JavaScript -->
                <button type="button" class="btn btn-danger btn-lg w-100 text-dark" onclick="confirmarExclusao()">
                    <strong>Excluir Conta</strong>
                </button>
              </div>
            </div>
          </div>
        </div>

        <script>
       // Função para confirmar exclusão de conta
function confirmarExclusao() {
    var resposta = confirm("Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.");
    if (resposta) {
        // Envia a requisição AJAX para excluir a conta
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "excluirConta.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response == 'success') {
                    // Se a exclusão for bem-sucedida, redireciona para a página de logout ou outra página
                    window.location.href = 'logout.php'; // ou qualquer página após a exclusão
                } else {
                    alert("Erro ao excluir conta: " + response);
                }
            }
        };
        xhr.send("excluirConta=true"); // Envia o dado 'excluirConta' para o PHP
    } else {
        // Se o usuário clicar em "Não", nada acontece
        return;
    }
}

        </script>

        <div class="container">
          <h2><strong>DESCRIÇÃO</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($banda['descricaoBanda']); ?></p>
          </blockquote>
          <br>
          <h2><strong>CIDADE</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($banda['cidadeBanda']) . " - " . htmlspecialchars($banda['estadoBanda'])?></p>
          </blockquote>
        </div>
        <br><br><br>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
