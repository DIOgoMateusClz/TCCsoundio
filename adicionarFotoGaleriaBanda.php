<?php
session_start();
include("conexaoBD.php");

if (!isset($_SESSION['idBanda'])) {
    echo "Erro: Banda não encontrada.";
    exit;
}

$idBanda = $_SESSION['idBanda'];

if (isset($_FILES['novasFotos']) && !empty($_FILES['novasFotos']['name'][0])) {
    $sql = "SELECT galeriaBanda FROM bandas WHERE idBanda = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $idBanda);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $banda = $result->fetch_assoc();
        $fotosExistentes = array_filter(explode(',', $banda['galeriaBanda']));
    } else {
        echo "Erro: Banda não encontrada.";
        exit;
    }
    
    $diretorioUpload = 'uploads2/';
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
*/}
}
?>
