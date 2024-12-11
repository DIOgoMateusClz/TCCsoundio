<?php
    session_start(); 
    include("conexaoBD.php");


    if(empty($_POST['emailBanda']) || empty($_POST['senhaBanda'])){
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=dadosInvalidos');
        exit();
    }


    $emailBanda = mysqli_real_escape_string($link, $_POST['emailBanda']);
    $senhaBanda = mysqli_real_escape_string($link, $_POST['senhaBanda']);

   
    $buscarLogin = "SELECT idBanda, emailBanda, nomeBanda, senhaBanda FROM bandas WHERE emailBanda = ? and senhaBanda = md5(?)";
    $stmt = mysqli_prepare($link, $buscarLogin);
    mysqli_stmt_bind_param($stmt, 'ss', $emailBanda, $senhaBanda);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

  
    if($registro = mysqli_fetch_assoc($resultado)){
       
        //if(password_verify($senhaEmpresa, $registro['senhaEmpresa'])){
            $_SESSION['idBanda'] = $registro['idBanda'];
            $_SESSION['emailBanda'] = $registro['emailBanda'];
            $_SESSION['nomeBanda'] = $registro['nomeBanda'];
            $_SESSION['tipoUsuario'] = 'banda'; 

          
            header('location:inicio.php?pagina=inicio');
            exit();
        /*} else {
            // Senha inválida
            header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
            exit();
        }*/
    } else {
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=dadosInvalidos');
        exit();
    }
?>