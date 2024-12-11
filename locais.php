<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<title>Empresas</title>

<div class="container mt-5">
    <div class="jumbotron text-left">
    <h2><strong>EMPRESAS</strong></h2>


 <form class="d-flex flex-column" method="GET" action="">
   
    <input class="form-control me-2" type="text" name="search" placeholder="Buscar empresas cadastradas...">
    

    <div class="mt-3">
        <label><input type="checkbox" name="tipos[]" value="bar"> Bar &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="tipos[]" value="lanchonete"> Lanchonete &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="tipos[]" value="restaurante"> Restaurante &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="tipos[]" value="casadeShows"> Casa de Shows &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="tipos[]" value="pizzaria"> Pizzaria &nbsp;&nbsp;</label>
        <label><input type="checkbox" name="tipos[]" value="centrodeEventos"> Centro de Eventos &nbsp;&nbsp;</label>
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
                    echo '<option value="' . $estado['siglaEstado'] . '" ' . (isset($_GET['estado']) && $_GET['estado'] == $estado['siglaEstado'] ? 'selected' : '') . '>' . $estado['nomeEstado'] . '</option>';
                }
                $link->close();
            ?>
        </select>
    </div>
   
    <div class="mt-3">
        <button type="submit" class="btn btn-outline-dark">Buscar</button>
        <button class="btn btn-outline-dark" onclick="window.location.href='locais.php';" type="button">Ver tudo</button>
    </div>
</form>
<br><br>
<?php

include("conexaoBD.php");


$search = isset($_GET['search']) ? $_GET['search'] : '';
$tipos = isset($_GET['tipos']) ? $_GET['tipos'] : [];
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';


$sql = "SELECT idEmpresa, nomeEmpresa, fotoEmpresa, bar, lanchonete, restaurante, casadeShows, pizzaria, centrodeEventos, estadoEmpresa 
        FROM empresas 
        WHERE nomeEmpresa LIKE ?";


$params = ['%' . $search . '%'];
$paramTypes = 's';


if (!empty($tipos)) {
    $tipoConditions = [];
    foreach ($tipos as $tipo) {
        $tipoConditions[] = "$tipo = 1";  
    }

   
    $sql .= " AND (" . implode(" OR ", $tipoConditions) . ")";
}
if ($estado) {
  $sql .= " AND estadoEmpresa = ?";
  $params[] = $estado;
  $paramTypes .= 's';
}


$sql .= " ORDER BY nomeEmpresa ASC";


$stmt = $link->prepare($sql);


if (!empty($tipos)) {
    
    $stmt->bind_param($paramTypes, ...$params);
} else {
    
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       
        $tiposEmpresa = [];
        if ($row['bar']) $tiposEmpresa[] = "Bar";
        if ($row['lanchonete']) $tiposEmpresa[] = "Lanchonete";
        if ($row['restaurante']) $tiposEmpresa[] = "Restaurante";
        if ($row['casadeShows']) $tiposEmpresa[] = "Casa de Shows";
        if ($row['pizzaria']) $tiposEmpresa[] = "Pizzaria";
        if ($row['centrodeEventos']) $tiposEmpresa[] = "Centro de Eventos";

        $tiposTexto = implode(", ", $tiposEmpresa);

       
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



$stmt->close();
$link->close();
?>

</div>
</div>
</div>
<?php include("footer.php"); ?>
