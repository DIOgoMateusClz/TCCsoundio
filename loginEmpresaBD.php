<?php
    session_start(); 
    include("conexaoBD.php");

  
    if (empty($_POST['emailEmpresa']) || empty($_POST['senhaEmpresa'])) {
        header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
        exit();
    }

    
    $emailEmpresa = mysqli_real_escape_string($link, $_POST['emailEmpresa']);
    $senhaEmpresa = mysqli_real_escape_string($link, $_POST['senhaEmpresa']);

    $buscarLogin = "SELECT idEmpresa, emailEmpresa, nomeEmpresa FROM empresas WHERE emailEmpresa = ? AND senhaEmpresa = md5(?)";
    $stmt = mysqli_prepare($link, $buscarLogin);
    mysqli_stmt_bind_param($stmt, 'ss', $emailEmpresa, $senhaEmpresa);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);


    if ($registro = mysqli_fetch_assoc($resultado)) {
   
        $_SESSION['idEmpresa'] = $registro['idEmpresa'];
        $_SESSION['emailEmpresa'] = $registro['emailEmpresa'];
        $_SESSION['nomeEmpresa'] = $registro['nomeEmpresa'];
        $_SESSION['tipoUsuario'] = 'empresa'; 

      
        header('location:inicio.php?pagina=inicio');
        exit();
    } else {
   
        header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
        exit();
    }
?>
