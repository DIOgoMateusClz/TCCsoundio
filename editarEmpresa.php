<?php
include("validarSessao.php");
include("conexaoBD.php");
include("header.php");

if (isset($_SESSION['idEmpresa'])) {
    $idEmpresa = $_SESSION['idEmpresa'];
} else {
    echo "<div class='alert alert-danger'>Erro: ID da empresa não encontrado na sessão.</div>";
    exit;
}

// Carregar os valores atuais da empresa do banco de dados
$query = "SELECT * FROM empresas WHERE idEmpresa = $idEmpresa";
$result = mysqli_query($link, $query);
$currentValues = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fieldsToUpdate = []; // Array para campos e valores preenchidos

    // Validação e inclusão de campos
    if (!empty($_POST["nomeEmpresa"])) {
        $nomeEmpresa = testar_entrada($_POST["nomeEmpresa"]);
        $fieldsToUpdate[] = "nomeEmpresa = '$nomeEmpresa'";
    }

    if (!empty($_POST["cnpjEmpresa"])) {
        $cnpjEmpresa = testar_entrada($_POST["cnpjEmpresa"]);
        $fieldsToUpdate[] = "cnpjEmpresa = '$cnpjEmpresa'";
    }

    if (!empty($_POST["cepEmpresa"])) {
        $cepEmpresa = testar_entrada($_POST["cepEmpresa"]);
        $fieldsToUpdate[] = "cepEmpresa = '$cepEmpresa'";
    }

    if (!empty($_POST["cidadeEmpresa"])) {
        $cidadeEmpresa = testar_entrada($_POST["cidadeEmpresa"]);
        $fieldsToUpdate[] = "cidadeEmpresa = '$cidadeEmpresa'";
    }

    if (!empty($_POST["estadoEmpresa"])) {
        $estadoEmpresa = testar_entrada($_POST["estadoEmpresa"]);
        $fieldsToUpdate[] = "estadoEmpresa = '$estadoEmpresa'";
    }

    if (!empty($_POST["telefoneEmpresa"])) {
        $telefoneEmpresa = testar_entrada($_POST["telefoneEmpresa"]);
        $fieldsToUpdate[] = "telefoneEmpresa = '$telefoneEmpresa'";
    }

    if (!empty($_POST["descricaoEmpresa"])) {
        $descricaoEmpresa = testar_entrada($_POST["descricaoEmpresa"]);
        $fieldsToUpdate[] = "descricaoEmpresa = '$descricaoEmpresa'";
    }

    // Processamento da foto principal
    if (!empty($_FILES["fotoEmpresa"]["name"])) {
        $fotoEmpresa = 'uploads/' . basename($_FILES["fotoEmpresa"]["name"]);
        if (move_uploaded_file($_FILES["fotoEmpresa"]["tmp_name"], $fotoEmpresa)) {
            $fieldsToUpdate[] = "fotoEmpresa = '$fotoEmpresa'";
        } else {
            echo "<div class='alert alert-danger'>Erro ao fazer upload da foto principal.</div>";
        }
    }

    // Tipos de locais (checkboxes)
    $fieldsToUpdate[] = "bar = " . (isset($_POST["bar"]) ? 1 : (isset($currentValues['bar']) ? $currentValues['bar'] : 0));
    $fieldsToUpdate[] = "lanchonete = " . (isset($_POST["lanchonete"]) ? 1 : (isset($currentValues['lanchonete']) ? $currentValues['lanchonete'] : 0));
    $fieldsToUpdate[] = "restaurante = " . (isset($_POST["restaurante"]) ? 1 : (isset($currentValues['restaurante']) ? $currentValues['restaurante'] : 0));
    $fieldsToUpdate[] = "casadeShows = " . (isset($_POST["casadeShows"]) ? 1 : (isset($currentValues['casadeShows']) ? $currentValues['casadeShows'] : 0));
    $fieldsToUpdate[] = "pizzaria = " . (isset($_POST["pizzaria"]) ? 1 : (isset($currentValues['pizzaria']) ? $currentValues['pizzaria'] : 0));
    $fieldsToUpdate[] = "centrodeEventos = " . (isset($_POST["centrodeEventos"]) ? 1 : (isset($currentValues['centrodeEventos']) ? $currentValues['centrodeEventos'] : 0));

    
    if (!empty($_POST["emailEmpresa"])) {
        $emailEmpresa = testar_entrada($_POST["emailEmpresa"]);
        $fieldsToUpdate[] = "emailEmpresa = '$emailEmpresa'";
    }

    if (!empty($_POST["senhaEmpresa"]) && !empty($_POST["confirmarSenhaEmpresa"])) {
        if ($_POST["senhaEmpresa"] === $_POST["confirmarSenhaEmpresa"]) {
            // Usando md5 para criptografar a senha
            $senhaEmpresa = md5(testar_entrada($_POST["senhaEmpresa"]));
            $fieldsToUpdate[] = "senhaEmpresa = '$senhaEmpresa'";
        } else {
            echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
            exit;
        }
    }

// Executar a atualização no banco
if (!empty($fieldsToUpdate)) {
    $query = "UPDATE empresas SET " . implode(", ", $fieldsToUpdate) . " WHERE idEmpresa = $idEmpresa";
    
    if (mysqli_query($link, $query)) {
        echo "<div class='alert alert-success'>Empresa atualizada com sucesso!</div>
              <div class='jumbotron text-center'>
                  <a href='meuPerfil.php?pagina=meuPerfil' title='meuPerfil'>
                      <h4><p style='color:Black;'><strong>Ver Perfil atualizado</strong></p></h4>
                  </a>
              </div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar a empresa: " . mysqli_error($link) . "</div>";
    }
}

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}
?>
<?php include("footer.php"); ?>
