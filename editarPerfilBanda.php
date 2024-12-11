
<?php include("validarSessao.php"); ?>
<?php include ("header.php"); ?>
<?php include("conexaoBD.php"); 


$idBanda = $_SESSION['idBanda'];
        

$buscarDadosBanda = "SELECT * FROM bandas WHERE idBanda = $idBanda";
$res = mysqli_query($link, $buscarDadosBanda) or die("<div class='alert alert-danger'>Erro ao tentar buscar dados da <strong>Banda</strong></div>");

if ($registro = mysqli_fetch_assoc($res)) {
    $fotoBanda = $registro["fotoBanda"];
    $nomeBanda = $registro["nomeBanda"];
    $descricaoBanda = $registro["descricaoBanda"];
    $cidadeBanda = $registro["cidadeBanda"];
    $estadoBanda = $registro["estadoBanda"];
    $telefoneBanda = $registro["telefoneBanda"];
    $rock = $registro["rock"];
    $heavyMetal = $registro["heavyMetal"];
    $punk = $registro["punk"];
    $hardcore = $registro["hardcore"];
    $sertanejo = $registro["sertanejo"];
    $pagode = $registro["pagode"];
    $samba = $registro["samba"];
    $gospel = $registro["gospel"];
    $rap = $registro["rap"];
    $funk = $registro["funk"];
    $MPB = $registro["MPB"];
    $emailBanda = $registro["emailBanda"];
    $senhaBanda = $registro["senhaBanda"];
}

    
?>
<div class="container mt-5">
    <div class="jumbotron text-left">
<h2>Editar dados da Banda</h2>
<br>

<form action="editarBanda.php" method="POST" enctype="multipart/form-data">

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="idBanda" value="<?php echo $idBanda;?>" readonly>
            <label for="idBanda" class="form-label">*ID:</label>
        </div>

        <div class="form-group">
            <img src="<?php echo $fotoBanda; ?>" width="100"> 
            <input type="hidden" name="fotoAtual" value="<?php echo $fotoBanda; ?>"> 
            <input type="file" class="btn btn-link" name="fotoBanda">
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o seu nome Completo" name="nomeBanda" value="<?php echo $nomeBanda;?>">
            <label for="nomeBanda" class="form-label">Nome:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
    <textarea class="form-control" placeholder="Fale um pouco sobre sua banda" name="descricaoBanda" style="height: 150px;"><?php echo $descricaoBanda;?></textarea>
    <label for="descricaoBanda" class="form-label">Descrição:</label>
</div>
<div class="form-floating mb-3 mt-3">
<select class="form-select" name="estadoBanda" id="estadoBanda" onchange="carregarCidadesBanda()" required>
    <option value="" disabled <?php echo empty($estadoBanda) ? 'selected' : ''; ?>>Selecione o estado</option>
    <?php
        $listarEstados = "SELECT * FROM estados";
        $res = mysqli_query($link, $listarEstados) or die("<div class='alert alert-danger text-center'>Erro ao tentar carregar <strong>ESTADOS</strong>!</div>");
        while ($registro = mysqli_fetch_assoc($res)) {
            $siglaEstado = $registro["siglaEstado"];
            $nomeEstado = $registro["nomeEstado"];
            $selected = (!empty($estadoBanda) && $siglaEstado == trim($estadoBanda)) ? "selected" : "";
            echo "<option value='$siglaEstado' $selected>$nomeEstado</option>";
        }
    ?>
</select>
    <label for="estadoBanda" class="form-label">Estado:</label>
</div>

<div class="form-floating mb-3 mt-3">
    <select class="form-control" id="cidadeBanda" name="cidadeBanda">
        <option value="" disabled selected>Selecione a cidade</option>
        <?php 
            if (!empty($cidadeBanda)) {
                echo "<option value='$cidadeBanda' selected>$cidadeBanda</option>";
            }
        ?>
    </select>
    <label for="cidadeBanda" class="form-label">*Cidade:</label>
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

function carregarCidadesBanda() {
    const estado = document.getElementById("estadoBanda").value;
    const cidadeSelect = document.getElementById("cidadeBanda");
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
            <input type="text" class="form-control" placeholder="Informe o TELEFONE" name="telefoneBanda" maxlength="11" value="<?php echo $telefoneBanda;?>">
            <label for="telefoneBanda" class="form-label" id="telefoneBanda">Telefone:</label>
        </div>

        <label for="genero">Genêro:</label>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="rock" <?php if($rock){echo "checked";} ?>>Rock
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="heavyMetal" <?php if($heavyMetal){echo "checked";} ?>>Heavy Metal
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="punk" <?php if($punk){echo "checked";} ?>>Punk
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="hardcore" <?php if($hardcore){echo "checked";} ?>>Hardcore
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="sertanejo" <?php if($sertanejo){echo "checked";} ?>>Sertanejo
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="pagode" <?php if($pagode){echo "checked";} ?>>Pagode
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="samba" <?php if($samba){echo "checked";} ?>>Samba
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="gospel" <?php if($gospel){echo "checked";} ?>>Gospel
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="rap" <?php if($rap){echo "checked";} ?>>Rap
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="funk" <?php if($funk){echo "checked";} ?>>Funk
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="MPB" <?php if($MPB){echo "checked";} ?>>MPB
        </label>
    </div>



        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailBanda" value="<?php echo $emailBanda; ?>">
            <label for="emailBanda" class="form-label">Email:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaBanda">
            <label for="senhaBanda" class="form-label">Senha:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Confirme a Senha" name="confirmarSenhaBanda">
            <label for="confirmarSenhaBanda" class="form-label">Confirme a Senha:</label>
        </div>

        <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Atualizar</button>
        </div></div>


    </div>
    </div>
</form>

<?php include ("footer.php"); ?>