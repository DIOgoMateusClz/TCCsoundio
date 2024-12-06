<?php
include("validarSessao.php");
include("conexaoBD.php");
include("header.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pega os dados do formulário e sanitiza as entradas
    $nomeEvento = testar_entrada($_POST['nomeEvento']);
    $horaEvento = testar_entrada($_POST['horaEvento']);
    $dataEvento = testar_entrada($_POST['dataEvento']);
    $descricaoEvento = testar_entrada($_POST['descricaoEvento']);
    $precoEvento = testar_entrada($_POST['precoEvento']);

// Remove "R$" e converte vírgula para ponto, deixando no formato "1234.56"
$precoEvento = str_replace(['R$', ' ', '.'], '', $precoEvento);
$precoEvento = str_replace(',', '.', $precoEvento);
    $localEvento = testar_entrada($_POST['localEvento']);
    $idBanda = testar_entrada($_POST['idBanda']);
    $idEmpresa = testar_entrada($_POST['idEmpresa']); // Esse campo já vem do formulário como hidden

    // Validando campos obrigatórios
    if (empty($nomeEvento) || empty($horaEvento) || empty($dataEvento) || empty($precoEvento)) {
        echo "<div class='alert alert-danger'>Todos os campos obrigatórios devem ser preenchidos.</div>";
        exit();
    }

    // Foto de evento
    if (isset($_FILES['fotoEvento']) && $_FILES['fotoEvento']['error'] == 0) {
        $fotoEventoTmp = $_FILES['fotoEvento']['name'];
        $fotoEventoTempPath = $_FILES['fotoEvento']['tmp_name'];

        // Inserção no banco de dados antes de renomear a foto para obter o ID do evento
        $sql = "INSERT INTO eventos (nomeEvento, horaEvento, dataEvento, localEvento, descricaoEvento, precoEvento, fotoEvento, idBanda, idEmpresa)
                VALUES ('$nomeEvento', '$horaEvento', '$dataEvento', '$localEvento', '$descricaoEvento', '$precoEvento', '$fotoEventoTmp', '$idBanda', '$idEmpresa')";

        if (mysqli_query($link, $sql)) {
            $idEvento = mysqli_insert_id($link);  // Obtém o ID do evento recém inserido

            // Renomear a foto usando o ID do evento
            $extensao = pathinfo($fotoEventoTmp, PATHINFO_EXTENSION);
            $novoNomeFoto = "img/{$idEvento}_evento.{$extensao}";  // Renomeia com o ID do evento
            move_uploaded_file($fotoEventoTempPath, $novoNomeFoto);

            // Atualiza o banco de dados com o novo nome da foto
            $updateFotoSQL = "UPDATE eventos SET fotoEvento = '$novoNomeFoto' WHERE idEvento = '$idEvento'";
            mysqli_query($link, $updateFotoSQL);

            echo "<div class='alert alert-success text-center'>Evento criado com sucesso!</div>";

            // Recuperar o nome da banda associada ao idBanda
            $sqlBanda = "SELECT nomeBanda FROM bandas WHERE idBanda = '$idBanda'";
            $resultadoBanda = mysqli_query($link, $sqlBanda);
            $linhaBanda = mysqli_fetch_assoc($resultadoBanda);
            $nomeBanda = $linhaBanda['nomeBanda'];

            // Recuperar o nome da empresa associada ao idEmpresa
            $sqlEmpresa = "SELECT nomeEmpresa FROM empresas WHERE idEmpresa = '$idEmpresa'";
            $resultadoEmpresa = mysqli_query($link, $sqlEmpresa);
            $linhaEmpresa = mysqli_fetch_assoc($resultadoEmpresa);
            $nomeEmpresa = $linhaEmpresa['nomeEmpresa'];

            // Exibição das informações do evento
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
        // Se a foto não foi enviada
        $fotoEvento = null; // Caso não envie uma foto
        // Inserção no banco de dados sem foto
        $sql = "INSERT INTO eventos (nomeEvento, horaEvento, dataEvento, localEvento, descricaoEvento, precoEvento, fotoEvento, idBanda, idEmpresa)
                VALUES ('$nomeEvento', '$horaEvento', '$dataEvento', '$localEvento', '$descricaoEvento', '$precoEvento', NULL, '$idBanda', '$idEmpresa')";
        
        if (mysqli_query($link, $sql)) {
            echo "<div class='alert alert-success text-center'>Evento criado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao tentar cadastrar o evento: " . mysqli_error($link) . "</div>";
        }
    }
}
// Função para evitar SQL Injection
function testar_entrada($dado) {
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

?>

<?php include("footer.php"); ?>
