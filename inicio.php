<?php include("validarSessao.php"); ?>
<?php include("header.php")?>

<title>Login Artista</title>
</style>
<style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>
  <div class="text-center">
  <h2><strong>DESTAQUES</strong></h2>
</div>
<body class="w3-light-grey w3-content" style="max-width:1700px" >
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="0" data-slide-to="0" class="active"></li>
    <li data-target="1" data-slide-to="1"></li>
    <li data-target="2" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/kartusDestaque.png" alt="kartus" width="900" height="300">
      <div class="carousel-caption">
        <h3><strong>KARTUS</strong></h3>
        <p>rock/metal</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/voltersDestaque.png" alt="volters" width="900" height="300">
      <div class="carousel-caption">
        <h3><strong>The Volters</strong></h3>
        <p>Punk/Hardcore</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="img/eufoniksDestaque.png" alt="eufoniks" width="900" height="300">
      <div class="carousel-caption">
        <h3><strong>Eufoniks</strong></h3>
        <p>Pop Rock</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<!--  <h1><strong>_______________________________________________________________________</strong></h1> -->
<div class="jumbotron text-left">
    <h2><strong>BANDAS</strong></h2>
<br><br>


    <!-- Left-aligned -->
<div class="media">
  <div class="media-left">
    <img src="img/logokartus.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;KARTUS</strong></h4>
    <p>&nbsp;&nbsp;Rock/Metal</p>
    <div class="text-right"><p style="color:Orange;"><img src="icones/icon-music.png"width="20" height="20">5,8</p></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/logoVolters.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;The Volters</strong></h4>
    <p>&nbsp;&nbsp;Punk/Hardcore</p>
    <div class="text-right"><p style="color:Orange;"><img src="icones/icon-music.png"width="20" height="20">5,8</p></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/logoEufoniks.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Eufoniks</strong></h4>
    <p>&nbsp;&nbsp;Pop Rock/Classic Rock</p>
    <div class="text-right"><p style="color:Orange;"><img src="icones/icon-music.png"width="20" height="20">5,8</p></div>
  </div>
</div>
<br>
<div class="media">
  <div class="media-left">
    <img src="img/logoGroselha.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><strong>&nbsp;Groselha Cry</strong></h4>
    <p>&nbsp;&nbsp;Pop Rock/Pop Punk</p>
    <div class="text-right"><p style="color:Orange;"><img src="icones/icon-music.png"width="20" height="20">5,8</p></div>
  </div>
</div>

      <div class="jumbotron text-center">
      <a <?php if($pagina == 'vermaisbandas')
      {echo 'active';}?> href="#verMaisBandas.php?pagina=verMaisBandas" title="Ver mais...">
      <h4><p style="color:Black;"><strong>Ver Mais<strong></h4></p></a>
</div>
</body>
<?php include("footer.php");