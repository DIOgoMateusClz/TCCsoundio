<?php
include("validarSessao.php");
include("header.php");
include("conexaoBD.php");

// Verifica se o ID da empresa está na sessão
if (!isset($_SESSION['idEmpresa'])) {
    echo "Erro: Empresa não encontrada.";
    exit;
}

$idEmpresa = $_SESSION['idEmpresa'];

// Consulta ao banco de dados para obter os dados da empresa logada
$sql = "SELECT * FROM empresas WHERE idEmpresa = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $idEmpresa);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $empresa = $result->fetch_assoc();
} else {
    echo "Erro: Empresa não encontrada.";
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
          <img src="<?php echo htmlspecialchars($empresa['fotoEmpresa']); ?>" style="width:100%" alt="Foto da Empresa">
          <div class="w3-display-bottomleft w3-container w3-text-white">
            <h2><?php echo htmlspecialchars($empresa['nomeEmpresa']); ?></h2>
          </div>
        </div>
        <br>
        <div class="w3-container">
          <p><img src="icones/iconStar.png" width="20" height="20">&nbsp;
          <?php

          
      // Tipos de empresa
      $tiposEmpresa = [];
      if ((int)$empresa['bar'] === 1) $tiposEmpresa[] = "Bar";
      if ((int)$empresa['lanchonete'] === 1) $tiposEmpresa[] = "Lanchonete";
      if ((int)$empresa['restaurante'] === 1) $tiposEmpresa[] = "Restaurante";
      if ((int)$empresa['casadeShows'] === 1) $tiposEmpresa[] = "Casa de Shows";
      if ((int)$empresa['pizzaria'] === 1) $tiposEmpresa[] = "Pizzaria";
      if ((int)$empresa['centrodeEventos'] === 1) $tiposEmpresa[] = "Centro de Eventos";

      $tiposEmpresaTexto = implode(", ", $tiposEmpresa);
      echo htmlspecialchars($tiposEmpresaTexto) ?: 'Tipo de empresa não especificado';
?>
          </p>
          <p><img src="icones/iconLocation.png" width="20" height="20">&nbsp;&nbsp;<?php echo htmlspecialchars($empresa['cidadeEmpresa']) . ", " . htmlspecialchars($empresa['estadoEmpresa']); ?></p>
          <p><img src="icones/iconCNPJ.png" width="20" height="20">&nbsp;&nbsp;
<?php
    $cnpj = $empresa['cnpjEmpresa'];
    
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
    $fotos = explode(',', $empresa['galeriaEmpresa']);
    $numFotos = count($fotos);

    for ($i = 0; $i < 6; $i++) {
        $foto = $i < $numFotos ? htmlspecialchars(trim($fotos[$i])) : 'uploads/placeholder.jpg';
        echo '
        <div class="jumbotron text-center w3-half w3-container w3-margin-bottom" style="padding: 5px;">
            <img src="' . $foto . '" style="width:100%; height:350px; object-fit:cover;" class="w3-hover-opacity">
            <form action="editarFotoGaleria.php" method="POST" enctype="multipart/form-data">
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
<!--
        <?php //if ($numFotos < 6): ?>

        <form action="adicionarFotoGaleria.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="novasFotos">&nbsp;Adicionar Fotos à Galeria (máximo de 6 fotos):</label>
                <input type="file" name="novasFotos[]" id="novasFotos" accept="image/*" multiple required>
            </div>
            <button type="submit" class="btn btn-outline-dark">Adicionar Fotos</button>
        </form>
        <?php //endif; ?>
        <br>
-->
<div class="jumbotron text-center">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <?php if (isset($idEmpresa) && $idEmpresa > 0): ?>
                    <a href="MeuContatoEmpresa.php?idBanda=<?= $id ?>" title="Entrar em Contato" style="text-decoration:none;">
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
                <button type="button" class="btn btn-dark btn-lg w-100" onclick="window.location.href='editarPerfilEmpresa.php';">
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
        xhr.open("POST", "excluirContaEmpresa.php", true);
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
        xhr.send("excluirContaEmpresa=true"); // Envia o dado 'excluirConta' para o PHP
    } else {
        // Se o usuário clicar em "Não", nada acontece
        return;
    }
}
</script>

        <div class="container">
          <h2><strong>DESCRIÇÃO</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($empresa['descricaoEmpresa']); ?></p>
          </blockquote>
<br>
          <h2><strong>CIDADE</strong></h2>
          <blockquote>
            <p><?php echo htmlspecialchars($empresa['cidadeEmpresa']) . " - " . htmlspecialchars($empresa['estadoEmpresa'])
            . "<br> CEP: ".htmlspecialchars($empresa['cepEmpresa']); ?></p>
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
