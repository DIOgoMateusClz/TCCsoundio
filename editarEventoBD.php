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


if (isset($_GET['idEvento'])) {
    $idEvento = $_GET['idEvento'];
    $query = "SELECT * FROM eventos WHERE idEvento = $idEvento AND idEmpresa = $idEmpresa";
    $result = mysqli_query($link, $query);
    $currentValues = mysqli_fetch_assoc($result);
} else {
    echo "<div class='alert alert-danger'>Erro: Evento não encontrado.</div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fieldsToUpdate = []; 

   
    if (!empty($_POST["nomeEvento"])) {
        $nomeEvento = testar_entrada($_POST["nomeEvento"]);
        $fieldsToUpdate[] = "nomeEvento = '$nomeEvento'";
    }

    if (!empty($_POST["descricaoEvento"])) {
        $descricaoEvento = testar_entrada($_POST["descricaoEvento"]);
        $fieldsToUpdate[] = "descricaoEvento = '$descricaoEvento'";
    }

    if (!empty($_POST["localEvento"])) {
        $localEvento = testar_entrada($_POST["localEvento"]);
        $fieldsToUpdate[] = "localEvento = '$localEvento'";
    }

    if (!empty($_POST["dataEvento"])) {
        $dataEvento = testar_entrada($_POST["dataEvento"]);
        $fieldsToUpdate[] = "dataEvento = '$dataEvento'";
    }

    if (!empty($_POST["horaEvento"])) {
        $horaEvento = testar_entrada($_POST["horaEvento"]);
        $fieldsToUpdate[] = "horaEvento = '$horaEvento'";
    }

  
    if (!empty($_FILES["fotoEvento"]["name"])) {
        $fotoEvento = 'uploads2/' . basename($_FILES["fotoEvento"]["name"]);
        if (move_uploaded_file($_FILES["fotoEvento"]["tmp_name"], $fotoEvento)) {
            $fieldsToUpdate[] = "fotoEvento = '$fotoEvento'";
        } else {
            echo "<div class='alert alert-danger'>Erro ao fazer upload da foto do evento.</div>";
        }
    }

  
    if (!empty($_POST["precoEvento"])) {
        $precoEvento = testar_entrada($_POST["precoEvento"]);
        $fieldsToUpdate[] = "precoEvento = '$precoEvento'";
    }

   
    if (empty($_POST["precoEvento"])) {
        $fieldsToUpdate[] = "precoEvento = '0.00'";
    }
}


if (!empty($fieldsToUpdate)) {
    $query = "UPDATE eventos SET " . implode(", ", $fieldsToUpdate) . " WHERE idEvento = $idEvento AND idEmpresa = $idEmpresa";
    
    if (mysqli_query($link, $query)) {
        if (mysqli_query($link, $query)) {
            echo "<div class='alert alert-success'>Evento atualizado com sucesso!</div>
                  <div class='jumbotron text-center'>
                      <a href='perfilEvento.php?pagina=perfilEvento' title='perfilEvento'>
                          <h4><p style='color:Black;'><strong>Ver Evento atualizado</strong></p></h4>
                      </a>
                  </div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao atualizar a Evento: " . mysqli_error($link) . "</div>";
        }
    }

function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}
?>