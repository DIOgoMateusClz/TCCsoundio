<?php include("header.php"); ?>

<div class="jumbotron text-center">
    <div style="margin-top:1px; margin-bottom:30px;">
        <a href="loginEmpresa.php?pagina=loginEmpresa" class="btn btn-outline-dark btn-lg <?php if ($pagina == 'loginEmpresa') { echo 'active'; } ?>" title="Login Empresa">
            Sou uma Empresa: Clique aqui!
        </a>
    </div>
</div>

<?php
    // Exibir mensagem de erro de login, se houver
    if(isset($_GET["erroLogin"])){
        $erroLogin = $_GET["erroLogin"];
        if($erroLogin == "dadosInvalidos"){
            echo "<div class='alert alert-warning text-center'>
                    <strong>USUÁRIO</strong> ou <strong>SENHA</strong> inválidos!
                </div>";
        }
        elseif($erroLogin == "naoLogado"){
            echo "<div class='alert alert-warning text-center'>
                    <strong>USUÁRIO</strong> não logado!
                </div>";
        }
    }
?>

<h2 class="text-center">Informe os seus dados para acessar a plataforma:</h2>


<!-- Formulário de login -->
<form action="loginBandaBD.php" method="POST" enctype="multipart/form-data">

    <!-- Campo para o email -->
    <div class="form-floating mb-3 mt-3">
        <input type="email" class="form-control" id="emailBanda" placeholder="Informe o email" name="emailBanda" required>
        <label for="emailBanda" class="form-label">*Email:</label>
    </div>

    <!-- Campo para a senha -->
    <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" id="senhaBanda" placeholder="Informe uma Senha" name="senhaBanda" required>
        <label for="senhaBanda" class="form-label">*Senha:</label>
    </div>

    <!-- Botão de envio -->
    <div class="text-center" style="margin-top:30px; margin-bottom:30px;">
        <button type="submit" class="btn btn-outline-dark btn-lg">Entrar</button>
    </div>

</form>

<?php include("footer.php"); ?>
