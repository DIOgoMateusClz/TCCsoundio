<?php
session_start();
include("conexaoBD.php");

if (!isset($_SESSION['idEmpresa'])) {
    echo "Erro: Empresa não encontrada.";
    exit;
}

$idEmpresa = $_SESSION['idEmpresa'];
$indiceFoto = isset($_POST['indiceFoto']) ? (int)$_POST['indiceFoto'] : null;

if ($indiceFoto === null || !isset($_FILES['fotoNova']) || $_FILES['fotoNova']['error'] !== UPLOAD_ERR_OK) {
    echo "Erro ao tentar substituir a foto.";
    exit;
}

// Verifica o tamanho do arquivo (500 MB em bytes)
if ($_FILES['fotoNova']['size'] > 500 * 1024 * 1024) {
    echo "Erro: O tamanho do arquivo excede o limite de 500 MB.";
    exit;
}

// Verifica o tipo de arquivo e a extensão
$tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

$tipoArquivo = mime_content_type($_FILES['fotoNova']['tmp_name']);
$extensaoArquivo = strtolower(pathinfo($_FILES['fotoNova']['name'], PATHINFO_EXTENSION));

if (!in_array($tipoArquivo, $tiposPermitidos) || !in_array($extensaoArquivo, $extensoesPermitidas)) {
    echo "Erro: Formato de arquivo não suportado. Permitidos: JPG, JPEG, PNG, GIF.";
    exit;
}

// Busca a galeria atual
$sql = "SELECT galeriaEmpresa FROM empresas WHERE idEmpresa = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $idEmpresa);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $empresa = $result->fetch_assoc();
    $fotos = explode(',', $empresa['galeriaEmpresa']);
} else {
    echo "Erro: Empresa não encontrada.";
    exit;
}

// Processa o upload da nova foto
$diretorioUpload = 'uploads/';
if (!is_dir($diretorioUpload)) {
    mkdir($diretorioUpload, 0755, true);
}

$nomeArquivo = $idEmpresa . "_galeria_" . ($indiceFoto + 1) . "." . $extensaoArquivo;
$caminhoArquivo = $diretorioUpload . $nomeArquivo;

if (move_uploaded_file($_FILES['fotoNova']['tmp_name'], $caminhoArquivo)) {
    $fotos[$indiceFoto] = $caminhoArquivo;
    $novaGaleria = implode(',', array_slice($fotos, 0, 6)); // Limita a 6 fotos

    $sqlUpdate = "UPDATE empresas SET galeriaEmpresa = ? WHERE idEmpresa = ?";
    $stmtUpdate = $link->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $novaGaleria, $idEmpresa);

    if ($stmtUpdate->execute()) {
        echo "Foto substituída com sucesso!";
    } else {
        echo "Erro ao atualizar a galeria.";
    }
} else {
    echo "Erro ao fazer upload da nova foto.";
}

$stmt->close();
$stmtUpdate->close();
$link->close();

// Redireciona para a página do perfil
header("Location: meuPerfil.php");
exit;
?>
