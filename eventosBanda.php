<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
<?php include("conexaoBD.php"); ?>
<title>Eventos</title>


<div class="container mt-5">
    <div class="jumbotron text-left">
        <h2 class="mb-4"><strong>Eventos</strong></h2>
        <form class="d-flex flex-column" method="GET" action="">
    
            <input class="form-control me-2" type="text" name="search" placeholder="Buscar eventos...">

   
            <div class="mt-3">
                <label for="estado">Estado:</label>
                <select class="form-control" name="estado" id="estado">
                    <option value="">Selecione o Estado</option>
                    <?php
           
                        $sqlEstados = "SELECT siglaEstado, nomeEstado FROM estados ORDER BY nomeEstado";
                        $resultEstados = $link->query($sqlEstados);
                        while ($estado = $resultEstados->fetch_assoc()) {
                            echo '<option value="' . $estado['siglaEstado'] . '" ' . (isset($_GET['estado']) && $_GET['estado'] == $estado['siglaEstado'] ? 'selected' : '') . '>' . $estado['nomeEstado'] . '</option>';
                        }
                    ?>
                </select>
            </div>

     
            <div class="mt-3">
                <label for="dataInicio">Data Início:</label>
                <input class="form-control" type="date" name="dataInicio" id="dataInicio" value="<?php echo isset($_GET['dataInicio']) ? $_GET['dataInicio'] : ''; ?>">
            </div>

      
            <div class="mt-3">
                <button type="submit" class="btn btn-outline-dark">Buscar</button>
                <button class="btn btn-outline-dark" onclick="window.location.href='eventos.php';" type="button">Ver tudo</button>
            </div>
        </form>

        <?php
  
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
        $dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';


        $sql = "SELECT e.idEvento, e.nomeEvento, e.horaEvento, e.dataEvento, e.descricaoEvento, e.precoEvento, e.fotoEvento, e.localEvento, 
                       emp.idEmpresa, emp.nomeEmpresa, emp.estadoEmpresa, emp.cidadeEmpresa, b.idBanda, b.nomeBanda
                FROM eventos e
                JOIN empresas emp ON e.idEmpresa = emp.idEmpresa
                LEFT JOIN bandas b ON e.idBanda = b.idBanda
                WHERE e.nomeEvento LIKE ?";

     
        if ($estado != '') {
            $sql .= " AND emp.estadoEmpresa = ?";
        }

       
        if ($dataInicio != '') {
            $sql .= " AND e.dataEvento >= ?";
        }

        $stmt = $link->prepare($sql);
        $searchParam = '%' . $search . '%';


        if ($estado != '' && $dataInicio != '') {
            $stmt->bind_param("sss", $searchParam, $estado, $dataInicio);
        } elseif ($estado != '') {
            $stmt->bind_param("ss", $searchParam, $estado);
        } elseif ($dataInicio != '') {
            $stmt->bind_param("ss", $searchParam, $dataInicio);
        } else {
            $stmt->bind_param("s", $searchParam);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
 
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="media mb-5 p-3 border rounded bg-light">
                    <div class="row w-300">
                        <div class="col-md-3">
                            <img src="' . $row["fotoEvento"] . '" class="rounded w-200" alt="' . $row["nomeEvento"] . '" height="300">
                        </div>
                        <div class="col-md-8">
                            <h3><strong>' . $row["nomeEvento"] . '</strong></h3>
                            <p><strong>Data:</strong> <span style="color:#d2691e;">' . date("d/m/Y", strtotime($row["dataEvento"])) . '</span></p>
                            <p><strong>Valor:</strong> <span style="color:#d2691e;">R$ ' . number_format($row["precoEvento"], 2, ',', '.') . '</span></p>
                            <p><strong>Banda:</strong> <span style="color:#d2691e;"><a href="perfisBandas.php?idBanda=' . $row["idBanda"] . '">' . $row["nomeBanda"] . '</a></span></p>
                            <p><strong>Organizado por:</strong> <span style="color:#d2691e;"><a href="perfisEmpresas.php?idEmpresa=' . $row["idEmpresa"] . '">' . $row["nomeEmpresa"] . '</a></span></p>
                            <p><strong>Cidade:</strong> <span style="color:#d2691e;">' . $row["cidadeEmpresa"] .' - '. $row["estadoEmpresa"] .  '</span></p>
                            <a href="perfisEventos.php?idEvento=' . $row["idEvento"] . '"><strong>Ver evento completo</strong></a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p>Nenhum evento encontrado.</p>";
        }

        $stmt->close();
        $link->close();
        ?>
    </div>
</div>

<?php include("footer.php"); ?>
