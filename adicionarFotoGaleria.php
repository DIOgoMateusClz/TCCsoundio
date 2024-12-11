<?php
session_start();
include("conexaoBD.php");


if (!isset($_SESSION['idEmpresa'])) {
    echo "Erro: Empresa não encontrada.";
    exit;
}

$idEmpresa = $_SESSION['idEmpresa'];


if (isset($_FILES['novasFotos']) && !empty($_FILES['novasFotos']['name'][0])) {
    $sql = "SELECT galeriaEmpresa FROM empresas WHERE idEmpresa = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $idEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $empresa = $result->fetch_assoc();
        $fotosExistentes = array_filter(explode(',', $empresa['galeriaEmpresa']));
    } else {
        echo "Erro: Empresa não encontrada.";
        exit;
    }
    
    $diretorioUpload = 'uploads/';
    if (!is_dir($diretorioUpload)) {
        mkdir($diretorioUpload, 0755, true);
    }

    $numFotosExistentes = count($fotosExistentes);
    $indiceFoto = $numFotosExistentes + 1;

    $fotosNovas = [];
    foreach ($_FILES['novasFotos']['tmp_name'] as $key => $tmpName) {
        if ($indiceFoto > 6) break; 

$extensaoPermitida = ['image/jpg' => 'jpg', 'image/png' => 'png', 'image/jpeg' => 'jpeg','image/webp' => 'webp'];
$tipoArquivo = mime_content_type($tmpName);

if (array_key_exists($tipoArquivo, $extensaoPermitida)) {
    $extensao = $extensaoPermitida[$tipoArquivo];
    $nomeArquivo = $indiceFoto . "." . $extensao;
    $caminhoArquivo = $diretorioUpload . $nomeArquivo;

    if (move_uploaded_file($tmpName, $caminhoArquivo)) {
        $fotosNovas[] = $caminhoArquivo;
        $indiceFoto++;
    }
} else {
    echo "Erro: Formato de arquivo não suportado.";
}
/*

    $novaGaleria = array_merge($fotosExistentes, $fotosNovas);
    $novaGaleria = array_slice($novaGaleria, 0, 6); // Garante no máximo 6 fotos
    $galeriaAtualizada = implode(',', $novaGaleria);


    $sqlUpdate = "UPDATE empresas SET galeriaEmpresa = ? WHERE idEmpresa = ?";
    $stmtUpdate = $link->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $galeriaAtualizada, $idEmpresa);

    if ($stmtUpdate->execute()) {
        echo "Fotos adicionadas com sucesso!";
    } else {
        echo "Erro ao atualizar a galeria.";
    }

    $stmt->close();
    $stmtUpdate->close();
    $link->close();

    header("Location: meuPerfil.php");
    exit;
} else {
    echo "Nenhuma foto foi selecionada.";
    exit;
}
*/
?>
