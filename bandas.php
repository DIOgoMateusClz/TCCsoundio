<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<title>Bandas</title>

<div class="container mt-5">
    <div class="jumbotron text-left">
    <h2><strong>BANDAS</strong></h2>

 <form class="d-flex flex-column" method="GET" action="">
    <input class="form-control me-2" type="text" name="search" placeholder="Buscar bandas cadastradas...">
    <div class="mt-3">
        <label><input type="checkbox" name="generos[]" value="rock"> Rock &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="heavyMetal"> Heavy Metal &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="punk"> Punk &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="hardcore"> Hardcore &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="sertanejo"> Sertanejo &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="pagode"> Pagode &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="samba"> Samba &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="gospel"> Gospel &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="rap"> Rap &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="funk"> Funk &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="generos[]" value="MPB"> MPB &nbsp;&nbsp;</label>
    </div>
    <div class="mt-3">
        <label for="estado">Estado:</label>
        <select class="form-control" name="estado" id="estado">
            <option value="">Selecione o Estado</option>
            <?php
               
                include("conexaoBD.php");
                $sqlEstados = "SELECT siglaEstado, nomeEstado FROM estados ORDER BY nomeEstado";
                $resultEstados = $link->query($sqlEstados);
                while ($estado = $resultEstados->fetch_assoc()) {
                echo '<option value="' . $estado['siglaEstado'] . '" ' . (isset($_GET['estado']) && $_GET['estado']
                == $estado['siglaEstado'] ? 'selected' : '') . '>' . $estado['nomeEstado'] . '</option>';
                }
                $link->close();
            ?>
        </select>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-outline-dark">Buscar</button>
        <button class="btn btn-outline-dark" onclick="window.location.href='bandas.php';" type="button">Ver tudo</button>
    </div>
</form>


<br><br>
<?php

include("conexaoBD.php");


$search = isset($_GET['search']) ? $_GET['search'] : '';
$generos = isset($_GET['generos']) ? $_GET['generos'] : [];
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';


$sql = "SELECT idBanda, nomeBanda, fotoBanda, rock, heavyMetal, punk, hardcore, sertanejo, pagode, samba, gospel, rap, funk, MPB, estadoBanda 
        FROM bandas 
        WHERE nomeBanda LIKE ?";


$params = ['%' . $search . '%'];
$paramTypes = 's';

if (!empty($generos)) {
    $generoConditions = [];
    foreach ($generos as $genero) {
        $generoConditions[] = "$genero = 1"; 
    }

    $sql .= " AND (" . implode(" OR ", $generoConditions) . ")";
}
if ($estado) {
  $sql .= " AND estadoBanda = ?";
  $params[] = $estado;
  $paramTypes .= 's';
}

$sql .= " ORDER BY nomeBanda ASC";

$stmt = $link->prepare($sql);

if (!empty($generos)) {
    $stmt->bind_param($paramTypes, ...$params);
} else {
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

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


$stmt->close();
$link->close();
?>
   </div>
</div>
</div>
<?php include("footer.php"); ?>
