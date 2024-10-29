<?php include("header.php"); ?>
<div class="jumbotron text-center">
        <div style="margin-top:1px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">
            <a <?php if($pagina == 'loginEmpresa'){echo 'active';} ?>href="loginEmpresa.php?pagina=loginEmpresa" 
            title="Login Empresas">Sou uma Empresa: Clique aqui!</a></button>
        </div></div> 
    
    <h2>Login Artista</h2>
    <p>*Campo Obrigatório</p>
    <br>

    <form action="cadastroEmpresa.php" method="POST" enctype="multipart/form-data">

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe seu email" name="emailArtista" required>
            <label for="emailArtista" class="form-label">*Email:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaArtista" required>
            <label for="senhaArtista" class="form-label">*Senha:</label>
        </div>
<br>
<div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Entrar</button>
        </div></div>
        </form>
        <br>
        <br>
        <br>
        <br>
        </div>
        <?php include("footer.php");        