<?php
session_start();
include("conexaoBD.php");

// Verifica se o ID da empresa está na sessão
if (!isset($_SESSION['idBanda'])) {
    echo "Erro: Banda não encontrada.";
    exit;
}

$idBanda = $_SESSION['idBanda'];

// Verifica se há arquivos enviados
if (isset($_FILES['novasFotos']) && !empty($_FILES['novasFotos']['name'][0])) {
    // Consulta a galeria atual da empresa
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
    
    // Diretório onde as fotos serão salvas
    $diretorioUpload = 'uploads2/';
    if (!is_dir($diretorioUpload)) {
        mkdir($diretorioUpload, 0755, true);
    }

    // Calcula o próximo índice para nomear as novas fotos
    $numFotosExistentes = count($fotosExistentes);
    $indiceFoto = $numFotosExistentes + 1;

    // Armazena os caminhos das novas fotos para atualizar no banco de dados
    $fotosNovas = [];
    foreach ($_FILES['novasFotos']['tmp_name'] as $key => $tmpName) {
        if ($indiceFoto > 6) break; // Limite de 6 fotos

    // Define o nome da foto com índice crescente (1, 2, 3, ...) e extensão adequada
$extensaoPermitida = ['image/jpg' => 'jpg', 'image/png' => 'png', 'image/jpeg' => 'jpeg','image/webp' => 'webp'];
$tipoArquivo = mime_content_type($tmpName);

if (array_key_exists($tipoArquivo, $extensaoPermitida)) {
    $extensao = $extensaoPermitida[$tipoArquivo];
    $nomeArquivo = $indiceFoto . "." . $extensao;
    $caminhoArquivo = $diretorioUpload . $nomeArquivo;

    // Move o arquivo para o diretório com o nome definido
    if (move_uploaded_file($tmpName, $caminhoArquivo)) {
        $fotosNovas[] = $caminhoArquivo;
        $indiceFoto++;
    }
} else {
    echo "Erro: Formato de arquivo não suportado.";
}
/*
    // Atualiza a galeria com as novas fotos, mantendo o limite de 6
    $novaGaleria = array_merge($fotosExistentes, $fotosNovas);
    $novaGaleria = array_slice($novaGaleria, 0, 6); // Garante no máximo 6 fotos
    $galeriaAtualizada = implode(',', $novaGaleria);

    // Atualiza a coluna `galeriaEmpresa` no banco de dados
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

    // Redireciona para a página anterior
    header("Location: meuPerfil.php");
    exit;
} else {
    echo "Nenhuma foto foi selecionada.";
    exit;
}
*/}
}
?>
