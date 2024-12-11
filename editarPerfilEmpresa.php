
<?php 
include("validarSessao.php");
include ("header.php");
include("conexaoBD.php");

$idEmpresa = $_SESSION['idEmpresa']; 


$buscarDadosEmpresa = "SELECT * FROM empresas WHERE idEmpresa = $idEmpresa";
$res = mysqli_query($link, $buscarDadosEmpresa) or die("<div class='alert alert-danger'>Erro ao tentar buscar dados da <strong>Empresa</strong></div>");

if($registro = mysqli_fetch_assoc($res)){
    $idEmpresa        = $registro["idEmpresa"];
    $fotoEmpresa      = $registro["fotoEmpresa"];
    $nomeEmpresa      = $registro["nomeEmpresa"];
    $cnpjEmpresa      = $registro["cnpjEmpresa"];
    $cepEmpresa       = $registro["cepEmpresa"];
    $estadoEmpresa    = $registro["estadoEmpresa"];
    $cidadeEmpresa    = $registro["cidadeEmpresa"];
    $telefoneEmpresa  = $registro["telefoneEmpresa"];
    $descricaoEmpresa = $registro["descricaoEmpresa"];
    $emailEmpresa     = $registro["emailEmpresa"];
    $bar              = $registro["bar"];
    $lanchonete       = $registro["lanchonete"];
    $restaurante      = $registro["restaurante"];
    $casadeShows      = $registro["casadeShows"];
    $pizzaria         = $registro["pizzaria"];
    $centrodeEventos  = $registro["centrodeEventos"];
}
?>
<div class="container mt-5">
    <div class="jumbotron text-left">
<h2>Editar dados da Empresa</h2>
<br>

<form action="editarEmpresa.php" method="POST" enctype="multipart/form-data">

    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" name="idEmpresa" value="<?php echo $idEmpresa;?>" readonly>
        <label for="idEmpresa" class="form-label">*ID:</label>
    </div>

    <div class="form-group">
        <img src="<?php echo $fotoEmpresa; ?>" width="100"> 
        <input type="hidden" name="fotoAtual" value="<?php echo $fotoEmpresa; ?>"> 
        <input type="file" class="btn btn-link" name="fotoEmpresa">
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Informe o seu nome Completo" name="nomeEmpresa" value="<?php echo $nomeEmpresa;?>">
        <label for="nomeEmpresa" class="form-label">Nome:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Informe o CNPJ" name="cnpjEmpresa" maxlength="14" value="<?php echo $cnpjEmpresa;?>">
        <label for="cnpjEmpresa" class="form-label">CNPJ:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Informe o CEP" name="cepEmpresa" maxlength="7" value="<?php echo $cepEmpresa;?>">
        <label for="cepEmpresa" class="form-label">CEP:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
    <select class="form-select" name="estadoEmpresa" id="estadoEmpresa" onchange="carregarCidades()" required>
    <option value="" disabled <?php echo empty($estadoEmpresa) ? 'selected' : ''; ?>>Selecione o estado</option>
    <?php
        $listarEstados = "SELECT * FROM estados";
        $res = mysqli_query($link, $listarEstados) or die("<div class='alert alert-danger text-center'>Erro ao tentar carregar <strong>ESTADOS</strong>!</div>");
        while ($registro = mysqli_fetch_assoc($res)) {
            $siglaEstado = $registro["siglaEstado"];
            $nomeEstado = $registro["nomeEstado"];
            $selected = (!empty($estadoEmpresa) && $siglaEstado == trim($estadoEmpresa)) ? "selected" : "";
            echo "<option value='$siglaEstado' $selected>$nomeEstado</option>";
        }
    ?>
</select>
    <label for="estadoEmpresa" class="form-label">Estado:</label>
</div>

<div class="form-floating mb-3 mt-3">
    <select class="form-control" id="cidadeEmpresa" name="cidadeEmpresa">
        <option value="" disabled selected>Selecione a cidade</option>
        <?php 
            if (!empty($cidadeEmpresa)) {
                echo "<option value='$cidadeEmpresa' selected>$cidadeEmpresa</option>";
            }
        ?>
    </select>
    <label for="cidadeEmpresa" class="form-label">*Cidade:</label>
</div>

<script>
    const cidadesPorEstado = {
        'AC': ['Rio Branco', 'Cruzeiro do Sul', 'Senador Guiomard', 'Plácido de Castro', 'Tarauacá', 'Xapuri', 'Feijó', 'Brasiléia', 'Epitaciolândia'],
    'AL': ['Maceió', 'Arapiraca', 'Palmeira dos Índios', 'Rio Largo', 'Delmiro Gouveia', 'Penedo', 'União dos Palmares', 'Pilar', 'São Miguel dos Campos', 'Coruripe'],
    'AM': ['Manaus', 'Parintins', 'Itacoatiara', 'Maués', 'Manacapuru', 'Tefé', 'Coari', 'Tabatinga', 'Humaitá', 'São Gabriel da Cachoeira'],
    'AP': ['Macapá', 'Santana', 'Laranjal do Jari', 'Oiapoque', 'Pedra Branca do Amapá', 'Vitória do Jari', 'Tartarugalzinho', 'Porto Grande', 'Mazagão', 'Amapá'],
    'BA': ['Salvador', 'Feira de Santana', 'Vitória da Conquista', 'Camaçari', 'Ilhéus', 'Juazeiro', 'Lauro de Freitas', 'Itabuna', 'Jequié', 'Porto Seguro'],
    'CE': ['Fortaleza', 'Caucaia', 'Juazeiro do Norte', 'Maracanaú', 'Sobral', 'Crato', 'Aquiraz', 'Iguatu', 'Russas', 'Quixadá'],
    'DF': ['Brasília', 'Gama', 'Taguatinga', 'Ceilândia', 'Águas Claras', 'Samambaia', 'Planaltina', 'Santa Maria', 'Guará', 'Sobradinho'],
    'ES': ['Vitória', 'Serra', 'Cachoeiro de Itapemirim', 'Vila Velha', 'Linhares', 'Cariacica', 'Colatina', 'Guarapari', 'São Mateus', 'Aracruz'],
    'GO': ['Goiânia', 'Aparecida de Goiânia', 'Anápolis', 'Rio Verde', 'Luziânia', 'Goiatuba', 'Catalão', 'Jataí', 'Caldas Novas', 'Itumbiara'],
    'MA': ['São Luís', 'Imperatriz', 'Caxias', 'Timon', 'Codó', 'Açailândia', 'Bacabal', 'Chapadinha', 'Barreirinhas', 'Pinheiro'],
    'MG': ['Belo Horizonte', 'Uberlândia', 'Contagem', 'Juiz de Fora', 'Betim', 'Montes Claros', 'Uberaba', 'Governador Valadares', 'Nova Lima', 'Ipatinga'],
    'MS': ['Campo Grande', 'Dourados', 'Três Lagoas', 'Corumbá', 'Ponta Porã', 'Paranaíba', 'Naviraí', 'Coxim', 'Aquidauana', 'Itaquiraí'],
    'MT': ['Cuiabá', 'Várzea Grande', 'Rondonópolis', 'Sinop', 'Lucas do Rio Verde', 'Tangará da Serra', 'Cáceres', 'Sorriso', 'Barra do Garças', 'Alta Floresta'],
    'PA': ['Belém', 'Ananindeua', 'Santarém', 'Marabá', 'Castanhal', 'Parauapebas', 'Benevides', 'São Félix do Xingu', 'Bragança', 'Altamira'],
    'PB': ['João Pessoa', 'Campina Grande', 'Santa Rita', 'Patos', 'Bayeux', 'Cajazeiras', 'Sousa', 'Cabedelo', 'Monteiro', 'Esperança'],
    'PE': ['Recife', 'Olinda', 'Jaboatão dos Guararapes', 'Caruaru', 'Petrolina', 'Garanhuns', 'Camaragibe', 'Igarassu', 'Vitória de Santo Antão', 'Paudalho'],
    'PI': ['Teresina', 'Parnaíba', 'Picos', 'Campo Maior', 'Piripiri', 'Floriano', 'Altos', 'São Raimundo Nonato', 'Oeiras', 'Bom Jesus'],
    'PR': ['Curitiba', 'Maringá', 'Londrina', 'Ponta Grossa', 'Cascavel', 'Foz do Iguaçu', 'São José dos Pinhais', 'Colombo', 'Araucária', 'Guarapuava', 'Telêmaco Borba'],
    'RJ': ['Rio de Janeiro', 'Niterói', 'Nova Iguaçu', 'Duque de Caxias', 'Cabo Frio', 'São Gonçalo', 'Belford Roxo', 'Magé'],
    'RN': ['Natal', 'Mossoró', 'Parnamirim', 'Caicó', 'Currais Novos', 'Açu', 'São Gonçalo do Amarante', 'João Câmara', 'Pau dos Ferros', 'São José de Mipibu'],
    'RO': ['Porto Velho', 'Ji-Paraná', 'Ariquemes', 'Vilhena', 'Cacoal', 'Rolim de Moura', 'Jaru', 'Guajará-Mirim', 'Pimenta Bueno', 'Machadinho do Oeste'],
    'RR': ['Boa Vista', 'Rorainópolis', 'Caroebe', 'Serrinha', 'São João da Baliza', 'Mucajaí', 'Normandia', 'Iracema', 'Cantá', 'Pacaraima'],
    'RS': ['Porto Alegre', 'Caxias do Sul', 'Pelotas', 'Santa Maria', 'Gravataí', 'Canoas', 'Novo Hamburgo', 'São Leopoldo', 'Bagé', 'Passo Fundo'],
    'SC': ['Florianópolis', 'Joinville', 'Blumenau', 'Chapecó', 'São José', 'Itajaí', 'Lages', 'Criciúma', 'Laguna', 'Mafra'],
    'SE': ['Aracaju', 'Lagarto', 'Nossa Senhora do Socorro', 'Itabaiana', 'Estância', 'São Cristóvão', 'Propriá', 'Tobias Barreto', 'Barra dos Coqueiros', 'Simão Dias'],
    'SP': ['São Paulo', 'Guarulhos', 'Campinas', 'São Bernardo do Campo', 'Santo André', 'Osasco', 'Ribeirão Preto', 'Sorocaba', 'Mauá', 'São José dos Campos'],
    'TO': ['Palmas', 'Araguaína', 'Gurupi', 'Paraíso do Tocantins', 'Porto Nacional', 'Tocantinópolis', 'Miracema do Tocantins', 'Araguatins', 'Dianópolis', 'Xambioá']
};

function carregarCidades() {
    const estado = document.getElementById("estadoEmpresa").value;
    const cidadeSelect = document.getElementById("cidadeEmpresa");
    cidadeSelect.innerHTML = '<option value="" disabled selected>Selecione a cidade</option>';
    
    if (estado && cidadesPorEstado[estado]) {
        cidadesPorEstado[estado].forEach(cidade => {
            const option = document.createElement("option");
            option.value = cidade;
            option.textContent = cidade;
            cidadeSelect.appendChild(option);
        });
    }
}
    </script>

    <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Informe o TELEFONE" name="telefoneEmpresa" maxlength="11" value="<?php echo $telefoneEmpresa;?>">
        <label for="telefoneEmpresa" class="form-label">Telefone:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
    <textarea class="form-control" placeholder="Fale um pouco sobre sua empresa" name="descricaoEmpresa" style="height: 150px;"><?php echo $descricaoEmpresa;?></textarea>
    <label for="descricaoEmpresa" class="form-label">Descrição:</label>
</div>

    <label for="genero">Tipo de Local:</label>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="bar" <?php if($bar){echo "checked";} ?>>Bar
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="lanchonete" <?php if($lanchonete){echo "checked";} ?>>Lanchonete
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="restaurante" <?php if($restaurante){echo "checked";} ?>>Restaurante
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="casadeShows" <?php if($casadeShows){echo "checked";} ?>>Casa de Shows
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="pizzaria" <?php if($pizzaria){echo "checked";} ?>>Pizzaria
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="centrodeEventos" <?php if($centrodeEventos){echo "checked";} ?>>Centro de Eventos
        </label>
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="email" class="form-control" placeholder="Informe o email" name="emailEmpresa" value="<?php echo $emailEmpresa; ?>">
        <label for="emailEmpresa" class="form-label">Email:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaEmpresa">
        <label for="senhaEmpresa" class="form-label">Senha:</label>
    </div>

    <div class="form-floating mb-3 mt-3">
        <input type="password" class="form-control" placeholder="Confirme a Senha" name="confirmarSenhaEmpresa">
        <label for="confirmarSenhaEmpresa" class="form-label">Confirme a Senha:</label>
    </div>

    <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Atualizar</button>
        </div>
    </div>
    </div>
    </div>
</form>

<?php include("footer.php"); ?>