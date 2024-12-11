<?php include("header.php"); ?>

<div class="jumbotron text-center">
    <div style="margin-top:1px; margin-bottom:30px;">
        <a href="loginBanda.php?pagina=loginBanda" class="btn btn-outline-dark btn-lg <?php if ($pagina == 'loginBanda') { echo 'active'; } ?>" title="Login Banda">
            Sou uma Banda: Clique aqui!
        </a>
    </div>
</div>

<?php
   
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


<form action="loginEmpresaBD.php" method="POST" enctype="multipart/form-data">
<div class="container mt-5">
    <div class="jumbotron text-left">
  
    <div class="form-floating mb-3 mt-3">
        <input type="email" class="form-control" id="emailEmpresa" placeholder="Informe o email" name="emailEmpresa" required>
        <label for="emailEmpresa" class="form-label">*Email:</label>
    </div>

    
    <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" id="senhaEmpresa" placeholder="Informe uma Senha" name="senhaEmpresa" required>
        <label for="senhaEmpresa" class="form-label">*Senha:</label>
    </div>

    <div class="jumbotron text-center">
      <a <?php if($pagina == 'telaCadastroEmpresa')
      {echo 'active';}?> href="telaCadastroEmpresa.php?pagina=telaCadastroEmpresa" title="Ir para cadastro">
      <h4><p style="color:Black;"><strong>Não possui conta? Cadastre-se agora!</strong></h4></p></a>
</div>

 
    <div class="text-center" style="margin-top:30px; margin-bottom:30px;">
        <button type="submit" class="btn btn-outline-dark btn-lg">Entrar</button>
    </div>
    </div> </div>

</form>

<?php include("footer.php"); ?>
