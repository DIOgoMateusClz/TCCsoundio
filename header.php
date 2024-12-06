<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            if (isset($_GET["pagina"])) {
                $pagina = $_GET['pagina'];
                switch ($pagina) {
                    case "inicio": echo "Início"; break;
                    case "listarArtista": echo "Listar Artista"; break;
                    case "formPesquisarArtista": echo "Pesquisar Artista"; break;
                    case "login": echo "Login"; break;
                    default: echo "SounDio"; break;
                }
            } else {
                echo "Soundio";
            }
        ?>
    </title>

    <!-- Bootstrap e W3.CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Máscaras -->
    <script>
        $(document).ready(function () {
            $("#telefoneBanda, #telefoneEmpresa").mask("(00) 00000-0000");
            $("#cnpjEmpresa").mask("00.000.000/0000-00");
            $("#cepEmpresa").mask("00000-000");
        });
    </script>
</head>

<body class="w3-theme-l3 bg-white">
    <!-- Logo centralizada com responsividade -->
    <div class="container my-5 text-center">
        <a href="inicio.php?pagina=inicio" title="Ir para o início">
            <img src="img/logo.png" class="img-fluid" width="400" alt="Logo Soundio">
        </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <?php
                        error_reporting(0);
                        session_start();
                        $emailEmpresa = $_SESSION["emailEmpresa"];
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($pagina == 'inicio') echo 'active'; ?>" href="inicio.php?pagina=inicio">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($pagina == 'telaCadastroEmpresa') echo 'active'; ?>" href="telaCadastroEmpresa.php?pagina=telaCadastroEmpresa">Cadastrar-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($pagina == 'bandas') echo 'active'; ?>" href="bandas.php?pagina=bandas">Bandas</a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link <?php if ($pagina == 'eventos') echo 'active'; ?>" href="<?php 
                        if (isset($_SESSION['emailEmpresa'])) {
                          echo 'eventos.php?pagina=eventos'; // Link para a empresa
                        } elseif (isset($_SESSION['emailBanda'])) {
                             echo 'eventosBanda.php?pagina=eventosBanda'; // Link para a banda
                         } else {
                       echo '#'; // Caso não esteja logado
                        }
                        ?>">
                      Eventos
                    </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($pagina == 'locais') echo 'active'; ?>" href="locais.php?pagina=locais">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex">
                            <?php
                                if (isset($_SESSION["emailEmpresa"])) {
                                    echo "<a class='nav-link' href='logout.php?pagina=loginEmpresa'>Logout Empresa</a>";
                                } elseif (isset($_SESSION["emailBanda"])) {
                                    echo "<a class='nav-link' href='logout.php?pagina=loginBanda'>Logout Banda</a>";
                                } else {
                                    echo "<a class='nav-link " . ($pagina == 'loginEmpresa' ? 'active' : '') . "' href='loginEmpresa.php?pagina=loginEmpresa'>Login Empresa</a>";
                                    echo "<a class='nav-link " . ($pagina == 'loginBanda' ? 'active' : '') . "' href='loginBanda.php?pagina=loginBanda'>Login Banda</a>";
                                }
                            ?>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($pagina == 'suporte') echo 'active'; ?>" href="suporte.php?pagina=suporte" title="Ajuda">
                        <span class="fa fa-question"></span>
                    </a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="w3-container w3-content" style="max-width:1500px; margin-top:40px;">
        <div class="w3-row">
            <div class="w3-col m16">
            <div class="w3-container w3-card w3-white w3-round w3-margin">
    <!-- Conteúdo dinâmico das páginas será inserido aqui -->
</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
