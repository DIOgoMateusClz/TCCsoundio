<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["emailEmpresa"])) {
    header('Location: loginEmpresa.php?pagina=loginEmpresa&erroLogin=naoLogado');
    exit();
}

include("header.php");
?>

<h2>Bem-vindo, <?php echo $_SESSION["nomeEmpresa"]; ?>!</h2>
<p>Você está logado na sua conta.</p>

<a href="logout.php">Sair</a>

<?php include("footer.php"); ?>
