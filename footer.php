</div>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" 
integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
    </div>

        </div>

        </div>
        <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão somente se não houver uma sessão ativa
}

// Verifique se o usuário está logado
if (isset($_SESSION['tipoUsuario'])) {
    $tipoUsuario = $_SESSION['tipoUsuario'];
} else {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>


<!-- Rodapé da página -->
<br><br>

<div class="navbar navbar-expand-sm text-white text-center fixed-bottom bg-dark navbar-dark " style="height:8%; width:20% margin-top:60px;">
<div class="container-fluid">
<div class="container">   
  
<a href="<?php echo ($tipoUsuario === 'banda') ? 'meuPerfilBanda.php' : 'meuPerfil.php'; ?>" title="Ver meu perfil">
    <button type="submit" class="btn btn-outline-light">
        <span class="fa fa-user"></span><b> Meu Perfil</b>
    </button>
</a>
<a href="<?php echo ($tipoUsuario === 'banda') ? 'meusEventos.php' : 'meusContratos.php'; ?>" title="Ver meus eventos">
    <button type="submit" class="btn btn-outline-light">
        <span class="fa fa-user"></span><b> Meus Eventos</b>
    </button>
</a>

        <a href="logout.php?pagina=logout" title="Sair">
        <button type="submit" class="btn btn-outline-light">
          <span class="fa fa-door-open"></span><b> Sair</b>
        </button></a>
</div>

<!--<p>SoundDio -
<?php echo date("Y"); ?>
</p> -->
</div>

</body>
</html>