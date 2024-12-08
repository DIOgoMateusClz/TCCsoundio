<?php 
include("validarSessao.php"); 
include("header.php"); 
include("conexaoBD.php");

// Certifique-se de que o ID da empresa está na sessão
if (!isset($_SESSION['idEmpresa'])) {
    echo "Erro: Empresa não encontrada. Faça login novamente.";
    exit;
}

// Obtém o ID da empresa logada
$idEmpresa = $_SESSION['idEmpresa'];

// Busca todas as bandas cadastradas no banco de dados
$sql = "SELECT idBanda, nomeBanda FROM bandas";
$result = $link->query($sql);

if ($result === false) {
    echo "Erro ao buscar bandas.";
    exit;
}

// Prepara as bandas para enviar ao JavaScript
$bandas = [];
while ($row = $result->fetch_assoc()) {
    $bandas[] = $row;
}
?>

<div class="container mt-5 mb-5 p-5 bg-light rounded">
    <h2 class="text-center mb-4">Criação de Evento</h2>
    <p class="text-center">*Campo Obrigatório</p>

    <form action="criarEventoBD.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idEmpresa" value="<?php echo $idEmpresa; ?>">

        <div class="mb-3">
            <label for="fotoEvento" class="form-label">Foto de divulgação:</label>
            <input type="file" class="form-control" name="fotoEvento">
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nomeEvento" placeholder="Informe o nome do evento" required>
            <label for="nomeEvento">*Nome do evento:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="time" class="form-control" name="horaEvento" required>
            <label for="horaEvento">*Hora:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control" name="dataEvento" required>
            <label for="dataEvento">*Data:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="localEvento" placeholder="Local do evento">
            <label for="localEvento">Local do evento:</label>
            <small class="text-muted">(Ex: Rua xxxxx, 000 - Bairro xxx).</small>
        </div>

        <div class="form-floating mb-3 mt-3">
            <textarea class="form-control" name="descricaoEvento" placeholder="Descreva o evento" maxlength="1000" style="height: 150px;"></textarea>
            <label for="descricaoEvento">Descrição:</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="precoEvento" id="precoEvento" placeholder="0,00" required>
            <label for="precoEvento">*Valor R$:</label>
            <small class="text-muted">Caso o evento seja gratuito, coloque "0,00".</small>
        </div>

        <script>
            function formatarMoeda(event) {
                let elemento = event.target;
                let valor = elemento.value.replace(/\D/g, "");
                valor = (valor / 100).toFixed(2).replace(".", ",");
                elemento.value = "R$ " + valor;
            }

            document.getElementById("precoEvento").addEventListener("input", formatarMoeda);
        </script>

        <script>
            // Passando as bandas do PHP para o JavaScript
            const bandas = <?php echo json_encode($bandas); ?>;

            function filtrarBandas() {
                const input = document.getElementById('searchBanda').value.toLowerCase();
                const lista = document.getElementById('resultadosBandas');
                lista.innerHTML = ''; // Limpar os resultados anteriores

                // Filtrar as bandas localmente
                const resultados = bandas.filter(banda => 
                    banda.nomeBanda.toLowerCase().includes(input)
                );

                if (resultados.length > 0) {
                    resultados.forEach(banda => {
                        const li = document.createElement('li');
                        li.classList.add('list-group-item', 'list-group-item-action');
                        li.textContent = banda.nomeBanda;
                        li.onclick = () => {
                            document.getElementById('searchBanda').value = banda.nomeBanda;
                            document.getElementById('idBandaSelecionada').value = banda.idBanda;
                            lista.innerHTML = ''; // Limpar a lista após a seleção
                        };
                        lista.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item', 'list-group-item-action', 'disabled');
                    li.textContent = 'Nenhuma banda encontrada';
                    lista.appendChild(li);
                }
            }
        </script>

        <div class="mb-3">
            <label for="searchBanda" class="form-label">*Selecione a Banda:</label>
            <input type="text" id="searchBanda" class="form-control" placeholder="Digite o nome da banda..." onkeyup="filtrarBandas()">
            <ul id="resultadosBandas" class="list-group mt-2" style="max-height: 200px; overflow-y: auto;">
                <!-- Resultados das bandas serão inseridos aqui -->
            </ul>
            <input type="hidden" name="idBanda" id="idBandaSelecionada" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark btn-lg">Criar Evento</button>
        </div>
    </form>
</div>

<?php include("footer.php"); ?>
