<?php
    session_start(); // Iniciar uma sessão
    include("conexaoBD.php");

    // Verificar se os campos foram preenchidos
    if (empty($_POST['emailEmpresa']) || empty($_POST['senhaEmpresa'])) {
        header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
        exit();
    }

    // Escapar os dados de entrada
    $emailEmpresa = mysqli_real_escape_string($link, $_POST['emailEmpresa']);
    $senhaEmpresa = mysqli_real_escape_string($link, $_POST['senhaEmpresa']);

    // Preparar a consulta SQL usando prepared statements para maior segurança
    $buscarLogin = "SELECT idEmpresa, emailEmpresa, nomeEmpresa FROM empresas WHERE emailEmpresa = ? AND senhaEmpresa = md5(?)";
    $stmt = mysqli_prepare($link, $buscarLogin);
    mysqli_stmt_bind_param($stmt, 'ss', $emailEmpresa, $senhaEmpresa);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar se a consulta retornou algum resultado
    if ($registro = mysqli_fetch_assoc($resultado)) {
        // Armazena os dados na sessão
        $_SESSION['idEmpresa'] = $registro['idEmpresa'];
        $_SESSION['emailEmpresa'] = $registro['emailEmpresa'];
        $_SESSION['nomeEmpresa'] = $registro['nomeEmpresa'];

        // Redirecionar para a página de início
        header('location:inicio.php?pagina=inicio');
        exit();
    } else {
        // Login inválido
        header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
        exit();
    }
?>
