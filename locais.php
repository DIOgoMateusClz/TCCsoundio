<?php include("validarSessao.php"); ?>
<?php include("header.php")?>
<title>Locais</title>


<!--  <h1><strong>_______________________________________________________________________</strong></h1> -->
<div class="jumbotron text-left">
    <h2><strong>LOCAIS</strong></h2>
    <form class="d-flex" action="#codigoBuscar.php">   
        <input class="form-control me-2" type="text" placeholder="Buscar..">
     <button type="submit" class="btn btn-outline-light">Buscar</button><img src="icones/iconFilter.png"width="35" height="35">
            </form>
<br><br>

<div class="media">
  <div class="media-left">
    <img src="img/bunkerLogo.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Bunker Beer</strong></h4>
    <p>&nbsp;&nbsp;Bar</p>
    <div class="text-right"></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/quintsLogo.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Quint's</strong></h4>
    <p>&nbsp;&nbsp;Bar</p>
    <div class="text-right"></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/texaslogo.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Texas Food Park</strong></h4>
    <p>&nbsp;&nbsp;Bar e lanchonete</p>
    <div class="text-right"></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/tecsLogo.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Tec's</strong></h4>
    <p>&nbsp;&nbsp;Bar e Lanchonete</p>
    <div class="text-right"></div>
  </div>
</div>
</body>
<?php include("footer.php");