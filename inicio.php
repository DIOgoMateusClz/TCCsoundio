<?php include("validarSessao.php"); ?>
<?php include("header.php")?>
<?php include("conexaoBD.php"); ?>
<?php $pagina = isset($pagina) ? $pagina : ''; ?>
<!--  <h1><strong>_______________________________________________________________________</strong></h1> -->
<div class="container mt-5">
    <div class="jumbotron text-left">
    <h1><strong>BANDAS</strong></h1>
<br><br>

<?php

$sql = "SELECT idBanda, nomeBanda, fotoBanda, rock, heavyMetal, punk, hardcore, sertanejo, pagode, samba, gospel, rap, funk, MPB, estadoBanda FROM bandas ORDER BY RAND() LIMIT 5";
$result = $link->query($sql);

if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
     
        $generos = [];
        if ($row['rock']) $generos[] = "Rock";
        if ($row['heavyMetal']) $generos[] = "Heavy Metal";
        if ($row['punk']) $generos[] = "Punk";
        if ($row['hardcore']) $generos[] = "Hardcore";
        if ($row['sertanejo']) $generos[] = "Sertanejo";
        if ($row['pagode']) $generos[] = "Pagode";
        if ($row['samba']) $generos[] = "Samba";
        if ($row['gospel']) $generos[] = "Gospel";
        if ($row['rap']) $generos[] = "Rap";
        if ($row['funk']) $generos[] = "Funk";
        if ($row['MPB']) $generos[] = "MPB";
        

$generosTexto = implode(", ", $generos);

echo '
<div class="d-flex align-items-start mb-4">
    <div class="me-3">
        <img src="' . $row["fotoBanda"] . '" class="rounded-circle" alt="' . $row["nomeBanda"] . '" width="140" height="140">
    </div>
    <div>
        <h2 class="h4"><strong>' . $row["nomeBanda"] . '</strong></h2>
        <p class="mb-1"><strong>Gênero:</strong> ' . $generosTexto . '</p>
        <p class="mb-1"><strong>Estado:</strong> ' . $row["estadoBanda"] . '</p>
        <a href="perfisBandas.php?idBanda=' . $row["idBanda"] . '">Ver Perfil</a>
    </div>
</div>
';
    }
} else {
    echo "<p>Nenhuma banda encontrada.</p>";
}


?>

      <div class="jumbotron text-center">
      <a <?php if($pagina == 'bandas')
      {echo 'active';}?> href="bandas.php?pagina=bandas" title="Ver mais...">
      <h4><p style="color:Black;"><strong>Ver Mais</strong></h4></p></a>
</div>

<div class="container mt-5">
    <div class="jumbotron text-left">
    <h1><strong>EMPRESAS</strong></h1>
    <br><br>

    <?php

    $sql = "SELECT idEmpresa, nomeEmpresa, fotoEmpresa, bar, lanchonete, restaurante, casadeShows, pizzaria, centrodeEventos, estadoEmpresa FROM empresas ORDER BY RAND() LIMIT 5";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
  
            $tipo = [];
            if ($row['bar']) $tipo[] = "Bar";
            if ($row['lanchonete']) $tipo[] = "Lanchonete";
            if ($row['restaurante']) $tipo[] = "Restaurante";
            if ($row['casadeShows']) $tipo[] = "Casa de Shows";
            if ($row['pizzaria']) $tipo[] = "Pizzaria";
            if ($row['centrodeEventos']) $tipo[] = "Centro de Eventos";
            
       
$tipoTexto = implode(", ", $tipo);

echo '
<div class="d-flex align-items-start mb-4">
    <div class="me-3">
        <img src="' . $row["fotoEmpresa"] . '" class="rounded-circle" alt="' . $row["nomeEmpresa"] . '" width="140" height="140">
    </div>
    <div>
        <h2 class="h4"><strong>' . $row["nomeEmpresa"] . '</strong></h2>
        <p class="mb-1"><strong>Tipo:</strong> ' . $tipoTexto . '</p>
        <p class="mb-1"><strong>Estado:</strong> ' . $row["estadoEmpresa"] . '</p>
        <a href="perfisEmpresas.php?idEmpresa=' . $row["idEmpresa"] . '">Ver Perfil</a>
    </div>
</div>
';

        }
    } else {
        echo "<p>Nenhuma Empresa encontrada.</p>";
    }


$link->close();
?>
 </div> 

      <div class="jumbotron text-center">
      <a <?php if($pagina == 'locais')
      {echo 'active';}?> href="locais.php?pagina=locais" title="Ver mais...">
      <h4><p style="color:Black;"><strong>Ver Mais</strong></h4></p></a>
     
      <div class="jumbotron text-center">
      <a <?php if($pagina == 'locais')
      {echo 'active';}?> href="locais.php?pagina=locais" title="Ver mais...">
      <h4><p style="color:white;"><strong>...</strong></h4></p></a>
  </div>
</div>

<?php include("footer.php");