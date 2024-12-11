<?php
include("validarSessao.php");
include("conexaoBD.php");
include("header.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $nomeEvento = testar_entrada($_POST['nomeEvento']);
    $horaEvento = testar_entrada($_POST['horaEvento']);
    $dataEvento = testar_entrada($_POST['dataEvento']);
    $descricaoEvento = testar_entrada($_POST['descricaoEvento']);
    $precoEvento = testar_entrada($_POST['precoEvento']);


$precoEvento = str_replace(['R$', ' ', '.'], '', $precoEvento);
$precoEvento = str_replace(',', '.', $precoEvento);
    $localEvento = testar_entrada($_POST['localEvento']);
    $idBanda = testar_entrada($_POST['idBanda']);
    $idEmpresa = testar_entrada($_POST['idEmpresa']); 


    if (empty($nomeEvento) || empty($horaEvento) || empty($dataEvento) || empty($precoEvento)) {
        echo "<div class='alert alert-danger'>Todos os campos obrigatórios devem ser preenchidos.</div>";
        exit();
    }


    if (isset($_FILES['fotoEvento']) && $_FILES['fotoEvento']['error'] == 0) {
        $fotoEventoTmp = $_FILES['fotoEvento']['name'];
        $fotoEventoTempPath = $_FILES['fotoEvento']['tmp_name'];


        $sql = "INSERT INTO eventos (nomeEvento, horaEvento, dataEvento, localEvento, descricaoEvento, precoEvento, fotoEvento, idBanda, idEmpresa)
                VALUES ('$nomeEvento', '$horaEvento', '$dataEvento', '$localEvento', '$descricaoEvento', '$precoEvento', '$fotoEventoTmp', '$idBanda', '$idEmpresa')";

        if (mysqli_query($link, $sql)) {
            $idEvento = mysqli_insert_id($link); 

            $extensao = pathinfo($fotoEventoTmp, PATHINFO_EXTENSION);
            $novoNomeFoto = "img/{$idEvento}_evento.{$extensao}"; 
            move_uploaded_file($fotoEventoTempPath, $novoNomeFoto);

         
            $updateFotoSQL = "UPDATE eventos SET fotoEvento = '$novoNomeFoto' WHERE idEvento = '$idEvento'";
            mysqli_query($link, $updateFotoSQL);

            echo "<div class='alert alert-success text-center'>Evento criado com sucesso!</div>";

        
            $sqlBanda = "SELECT nomeBanda FROM bandas WHERE idBanda = '$idBanda'";
            $resultadoBanda = mysqli_query($link, $sqlBanda);
            $linhaBanda = mysqli_fetch_assoc($resultadoBanda);
            $nomeBanda = $linhaBanda['nomeBanda'];

           
            $sqlEmpresa = "SELECT nomeEmpresa FROM empresas WHERE idEmpresa = '$idEmpresa'";
            $resultadoEmpresa = mysqli_query($link, $sqlEmpresa);
            $linhaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
            $nomeEmpresa = $linhaEmpresa['nomeEmpresa'];

        
            echo "<div class='container mt-3'>
                    <div class='container mt-3 text-center'>
                        <img src='$novoNomeFoto' width='150'>
                    </div>
                    <table class='table'>
                        <tr>
                            <th>NOME</th>
                            <td>$nomeEvento</td>
                        </tr>
                        <tr>
                            <th>HORA</th>
                            <td>$horaEvento</td>
                        </tr>
                        <tr>
                            <th>DATA</th>
                            <td>$dataEvento</td>
                        </tr>
                        <tr>
                            <th>LOCAL</th>
                            <td>$localEvento</td>
                        </tr>
                        <tr>
                            <th>DESCRIÇÃO</th>
                            <td>$descricaoEvento</td>
                        </tr>
                        <tr>
                            <th>PREÇO</th>
                            <td>$precoEvento</td>
                        </tr>
                        <tr>
                            <th>BANDA</th>
                            <td>$nomeBanda</td>
                        </tr>
                        <tr>
                            <th>EMPRESA</th>
                            <td>$nomeEmpresa</td>
                        </tr>
                    </table>
                </div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao tentar cadastrar o evento: " . mysqli_error($link) . "</div>";
        }
    } else {
       
        $fotoEvento = null; 
      
        $sql = "INSERT INTO eventos (nomeEvento, horaEvento, dataEvento, localEvento, descricaoEvento, precoEvento, fotoEvento, idBanda, idEmpresa)
                VALUES ('$nomeEvento', '$horaEvento', '$dataEvento', '$localEvento', '$descricaoEvento', '$precoEvento', NULL, '$idBanda', '$idEmpresa')";
        
        if (mysqli_query($link, $sql)) {
            echo "<div class='alert alert-success text-center'>Evento criado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao tentar cadastrar o evento: " . mysqli_error($link) . "</div>";
        }
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
