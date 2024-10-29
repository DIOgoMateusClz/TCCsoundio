<?php
    session_start(); // Iniciar uma sessão
    include("conexaoBD.php");

    // Verificar se os campos foram preenchidos
    if(empty($_POST['emailBanda']) || empty($_POST['senhaBanda'])){
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=dadosInvalidos');
        exit();
    }

    // Escapar os dados de entrada
    $emailBanda = mysqli_real_escape_string($link, $_POST['emailBanda']);
    $senhaBanda = mysqli_real_escape_string($link, $_POST['senhaBanda']);

    // Preparar a consulta SQL usando prepared statements para maior segurança
    $buscarLogin = "SELECT emailBanda, nomeBanda, senhaBanda FROM bandas WHERE emailBanda = ? and senhaBanda = md5(?)";
    $stmt = mysqli_prepare($link, $buscarLogin);
    mysqli_stmt_bind_param($stmt, 'ss', $emailBanda, $senhaBanda);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar se a consulta retornou algum resultado
    if($registro = mysqli_fetch_assoc($resultado)){
        // Verificar a senha usando password_verify (se você estiver usando password_hash para armazená-la)
        //if(password_verify($senhaEmpresa, $registro['senhaEmpresa'])){
            $_SESSION['emailBanda'] = $registro['emailBanda'];
            $_SESSION['nomeBanda'] = $registro['nomeBanda'];

            // Redirecionar para a página de início
            header('location:inicio.php?pagina=inicio');
            exit();
        /*} else {
            // Senha inválida
            header('location:loginEmpresa.php?pagina=loginEmpresa&erroLogin=dadosInvalidos');
            exit();
        }*/
    } else {
        // Login inválido
        header('location:loginBanda.php?pagina=loginBanda&erroLogin=dadosInvalidos');
        exit();
    }
?>