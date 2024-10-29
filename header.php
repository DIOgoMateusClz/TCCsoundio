<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=10.0">
        <title>
            <?php

               if(isset($_GET["pagina"])){
                    $pagina = $_GET['pagina'];

                      switch($pagina){
                    case "inicio" : echo "inicio"; break;
                    case "listarArtista" : echo "Listar Artista"; break;
                    case "formPesquisarArtista" : echo "Pesquisar Artista"; break;
                    case "login" : echo "Login"; break;

                    default  : echo "SounDio"; break;

                }
            }
                else{
                    echo "Soundio";
                }
              

                
            ?>
        </title>

        <!-- CDN da última versão compilada e minimizada do CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Adicionar esta versão de compilado css do w3schools -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <!-- CDN para importar os ícones -->
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <!-- CDNs para importar JQUERY e Máscaras -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        
        <!-- Script para Máscaras do Formulário -->
        <script>
            $(document).ready(function(){
                $("cpfArtista").mask("000.000.000-00");
            });
        </script>

    </head>
    
    
    <body class="w3-theme-l3 bg-white" >
    
  
        <div style="margin-top:80px; margin-bottom:80px; display:flex; align-items:center; justify-content:center;">
       
            <a  href="inicio.php?pagina=inicio" title="Ir para o inicio"><img src="img/logo.png" width="400" ></a>
        </div>
        
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav" >
                    <?php
                        error_reporting(0);
                        session_start();
                        $emailEmpresa = $_SESSION["emailEmpresa"]; 
                    ?>

                        
                        <li class="nav-item" >
                        <a class="nav-link <?php if($pagina == 'inicio'){echo 'active';} ?>" href="inicio.php?pagina=inicio" title="Ir para o inicio">Início</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?php if($pagina == 'telaCadastroEmpresa'){echo 'active';} ?>" href="telaCadastroEmpresa.php?pagina=telaCadastroEmpresa" title="Ir para o formulário de cadastro">Cadastrar-se</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'criarEvento'){echo 'active';} ?>"  href="criarEvento.php?pagina=criarEvento" title="Criar evento">Criar Evento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'bandas'){echo 'active';} ?>"  href="bandas.php?pagina=bandas" title="Ver bandas">Bandas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'eventos'){echo 'active';} ?>"  href="eventos.php?pagina=eventos" title="Ver eventos">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($pagina == 'locais'){echo 'active';} ?>"  href="locais.php?pagina=locais" title="Ver locais">Locais</a>
                        </li>
                        <li class="nav-item">
                        <div class="d-flex">
                            <?php
                            // Verifica se o usuário está logado como empresa
                         if (isset($_SESSION["emailEmpresa"])) {
                          // Exibe o link para logout da empresa
                         echo "<a class='nav-link' href='logout.php?pagina=loginEmpresa' title='Sair da conta'>Logout Empresa</a>";
                          } 
                         // Verifica se o usuário está logado como banda
                         elseif (isset($_SESSION["emailBanda"])) {
                          // Exibe o link para logout da banda
                        echo "<a class='nav-link' href='logout.php?pagina=loginBanda' title='Sair da conta'>Logout Banda</a>";
                         } 
                          // Se nenhum dos dois estiver logado, exibe as opções de login para ambos
                         else {
                          if ($pagina == 'loginEmpresa') {
                          echo "<a class='nav-link active' href='loginEmpresa.php?pagina=loginEmpresa' title='Fazer o Login'>Login Empresa</a>";
                          } else {
                        echo "<a class='nav-link' href='loginEmpresa.php?pagina=loginEmpresa' title='Fazer o Login'>Login Empresa</a>";
                        }
        
                        if ($pagina == 'loginBanda') {
                         echo "<a class='nav-link active' href='loginBanda.php?pagina=loginBanda' title='Fazer o Login'>Login Banda</a>";
                        } else {
                         echo "<a class='nav-link' href='loginBanda.php?pagina=loginBanda' title='Fazer o Login'>Login Banda</a>";
                        }
                    }
                            ?>
                        </li>
                        </li>
                    </ul>
                </div>
                <?php
                    if(isset($_SESSION["emailArtista"])){
                        echo "
                            <ul class= 'navbar-nav'>
                                <li class='nav-item active'>
                                    <a class='nav-link' style='color:white'>
                                        Logado(a) como <strong>$nomeArtista</strong>
                                        <span class='sr-only'></span>
                                    </a>
                                </li>
                            </ul>
                        ";
                    }
                ?>
            </div>
           <div>
           
        
        </nav>

        <!-- Esta é a div principal -->
        <div class="w3-container w3-content" style="max-width:1500px; margin-top:40px" >
            <!-- Grade -->
            <div class="w3-row" >
                <!-- Coluna Intermediária -->
                <div class="w3-col m16">
                    <!-- Div com bordas arredondadas para exibir os conteúdos das páginas -->
                    <div class="w3-container w3-card w3-white w3-round w3-margin">
                     <br>
       