<?php
include("validarSessao.php");
include("conexaoBD.php");
include("header.php");

if (isset($_SESSION['idBanda'])) {
    $idBanda = $_SESSION['idBanda'];
} else {
    echo "<div class='alert alert-danger'>Erro: ID da banda não encontrado na sessão.</div>";
    exit;
}

// Carregar os valores atuais da banda do banco de dados
$query = "SELECT * FROM bandas WHERE idBanda = $idBanda";
$result = mysqli_query($link, $query);
$currentValues = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fieldsToUpdate = []; // Array para campos e valores preenchidos

    // Validação e inclusão de campos
    if (!empty($_POST["nomeBanda"])) {
        $nomeBanda = testar_entrada($_POST["nomeBanda"]);
        $fieldsToUpdate[] = "nomeBanda = '$nomeBanda'";
    }

    if (!empty($_POST["descricaoBanda"])) {
        $descricaoBanda = testar_entrada($_POST["descricaoBanda"]);
        $fieldsToUpdate[] = "descricaoBanda = '$descricaoBanda'";
    }

    if (!empty($_POST["cidadeBanda"])) {
        $cidadeBanda = testar_entrada($_POST["cidadeBanda"]);
        $fieldsToUpdate[] = "cidadeBanda = '$cidadeBanda'";
    }

    if (!empty($_POST["estadoBanda"])) {
        $estadoBanda = testar_entrada($_POST["estadoBanda"]);
        $fieldsToUpdate[] = "estadoBanda = '$estadoBanda'";
    }

    if (!empty($_POST["telefoneBanda"])) {
        $telefoneBanda = testar_entrada($_POST["telefoneBanda"]);
        $fieldsToUpdate[] = "telefoneBanda = '$telefoneBanda'";
    }

    // Processamento da foto principal
    if (!empty($_FILES["fotoBanda"]["name"])) {
        $fotoBanda = 'uploads2/' . basename($_FILES["fotoBanda"]["name"]);
        if (move_uploaded_file($_FILES["fotoBanda"]["tmp_name"], $fotoBanda)) {
            $fieldsToUpdate[] = "fotoBanda = '$fotoBanda'";
        } else {
            echo "<div class='alert alert-danger'>Erro ao fazer upload da foto principal.</div>";
        }
    }
    // Tipos de locais (checkboxes)
    $fieldsToUpdate[] = "rock = " . (isset($_POST["rock"]) ? 1 : (isset($currentValues['rock']) ? $currentValues['rock'] : 0));
    $fieldsToUpdate[] = "heavyMetal = " . (isset($_POST["heavyMetal"]) ? 1 : (isset($currentValues['heavyMetal']) ? $currentValues['heavyMetal'] : 0));
    $fieldsToUpdate[] = "punk = " . (isset($_POST["punk"]) ? 1 : (isset($currentValues['punk']) ? $currentValues['punk'] : 0));
    $fieldsToUpdate[] = "hardcore = " . (isset($_POST["hardcore"]) ? 1 : (isset($currentValues['hardcore']) ? $currentValues['hardcore'] : 0));
    $fieldsToUpdate[] = "sertanejo = " . (isset($_POST["sertanejo"]) ? 1 : (isset($currentValues['sertanejo']) ? $currentValues['sertanejo'] : 0));
    $fieldsToUpdate[] = "pagode = " . (isset($_POST["pagode"]) ? 1 : (isset($currentValues['pagode']) ? $currentValues['pagode'] : 0));
    $fieldsToUpdate[] = "samba = " . (isset($_POST["samba"]) ? 1 : (isset($currentValues['samba']) ? $currentValues['samba'] : 0));
    $fieldsToUpdate[] = "gospel = " . (isset($_POST["gospel"]) ? 1 : (isset($currentValues['gospel']) ? $currentValues['gospel'] : 0));
    $fieldsToUpdate[] = "rap = " . (isset($_POST["rap"]) ? 1 : (isset($currentValues['rap']) ? $currentValues['rap'] : 0));
    $fieldsToUpdate[] = "funk = " . (isset($_POST["funk"]) ? 1 : (isset($currentValues['funk']) ? $currentValues['funk'] : 0));
    $fieldsToUpdate[] = "MPB = " . (isset($_POST["MPB"]) ? 1 : (isset($currentValues['MPB']) ? $currentValues['MPB'] : 0));


    if (!empty($_POST["emailBanda"])) {
        $emailBanda = testar_entrada($_POST["emailBanda"]);
        $fieldsToUpdate[] = "emailBanda = '$emailBanda'";
    }

    if (!empty($_POST["senhaBanda"]) && !empty($_POST["confirmarSenhaBanda"])) {
        if ($_POST["senhaBanda"] === $_POST["confirmarSenhaBanda"]) {
            // Usando md5 para criptografar a senha
            $senhaBanda = md5(testar_entrada($_POST["senhaBanda"]));
            $fieldsToUpdate[] = "senhaBanda = '$senhaBanda'";
        } else {
            echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
            exit;
        }
    }
}
// Executar a atualização no banco
if (!empty($fieldsToUpdate)) {
    $query = "UPDATE bandas SET " . implode(", ", $fieldsToUpdate) . " WHERE idBanda = $idBanda";
    
    if (mysqli_query($link, $query)) {
        echo "<div class='alert alert-success'>Banda atualizada com sucesso!</div>
              <div class='jumbotron text-center'>
                  <a href='meuPerfilBanda.php?pagina=meuPerfilBanda' title='meuPerfilBanda'>
                      <h4><p style='color:Black;'><strong>Ver Perfil atualizado</strong></p></h4>
                  </a>
              </div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar a Banda: " . mysqli_error($link) . "</div>";
    }
}

// Função para testar entrada
function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

?>



<?php include("footer.php"); ?>
