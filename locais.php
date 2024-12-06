<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<title>Empresas</title>

<div class="container mt-5">
    <div class="jumbotron text-left">
    <h2><strong>EMPRESAS</strong></h2>

 <!-- Formulário de busca com botão -->
 <form class="d-flex flex-column" method="GET" action="">
    <!-- Campo de busca -->
    <input class="form-control me-2" type="text" name="search" placeholder="Buscar empresas cadastradas...">
    
    <!-- Filtro de tipos de empresas -->
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
                // Carregar estados do banco de dados
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
    <!-- Botões -->
    <div class="mt-3">
        <button type="submit" class="btn btn-outline-dark">Buscar</button>
        <button class="btn btn-outline-dark" onclick="window.location.href='locais.php';" type="button">Ver tudo</button>
    </div>
</form>
<br><br>
<?php
// Incluindo a conexão com o banco de dados
include("conexaoBD.php");

// Verificando se o formulário de busca foi submetido
$search = isset($_GET['search']) ? $_GET['search'] : '';
$tipos = isset($_GET['tipos']) ? $_GET['tipos'] : [];
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';

// Consulta SQL básica
$sql = "SELECT idEmpresa, nomeEmpresa, fotoEmpresa, bar, lanchonete, restaurante, casadeShows, pizzaria, centrodeEventos, estadoEmpresa 
        FROM empresas 
        WHERE nomeEmpresa LIKE ?";

// Inicializando os parâmetros para o bind
$params = ['%' . $search . '%'];
$paramTypes = 's';

// Se algum tipo de empresa for selecionado, adicionamos ao SQL
if (!empty($tipos)) {
    $tipoConditions = [];
    foreach ($tipos as $tipo) {
        $tipoConditions[] = "$tipo = 1";  // Verifica se o tipo está marcado
    }

    // Adiciona a condição para os tipos selecionados
    $sql .= " AND (" . implode(" OR ", $tipoConditions) . ")";
}
if ($estado) {
  $sql .= " AND estadoEmpresa = ?";
  $params[] = $estado;
  $paramTypes .= 's';
}

// Ordenação
$sql .= " ORDER BY nomeEmpresa ASC";

// Preparando a consulta
$stmt = $link->prepare($sql);

// Ajuste para usar os parâmetros dinamicamente
if (!empty($tipos)) {
    // Para os tipos, precisamos adicionar mais tipos e parâmetros ao bind
    $stmt->bind_param($paramTypes, ...$params);
} else {
    // Se não há tipos, apenas o parâmetro do nome
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Exibindo o resultado
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Tipos de empresa
        $tiposEmpresa = [];
        if ($row['bar']) $tiposEmpresa[] = "Bar";
        if ($row['lanchonete']) $tiposEmpresa[] = "Lanchonete";
        if ($row['restaurante']) $tiposEmpresa[] = "Restaurante";
        if ($row['casadeShows']) $tiposEmpresa[] = "Casa de Shows";
        if ($row['pizzaria']) $tiposEmpresa[] = "Pizzaria";
        if ($row['centrodeEventos']) $tiposEmpresa[] = "Centro de Eventos";

        $tiposTexto = implode(", ", $tiposEmpresa);

        // Exibindo a empresa
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


// Fechando a conexão corretamente
$stmt->close();
$link->close();
?>

</div>
</div>
</div>
<?php include("footer.php"); ?>
