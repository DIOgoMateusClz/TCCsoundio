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

    console.log("Estado selecionado:", estado);  // Verifique se o valor do estado foi selecionado corretamente

    // Limpa as opções anteriores
    cidadeSelect.innerHTML = '<option value="" disabled selected>Selecione a cidade</option>';

    // Verifica se o estado tem cidades registradas
    if (estado && cidadesPorEstado[estado]) {
        console.log("Cidades encontradas para o estado:", cidadesPorEstado[estado]);  // Verifica se as cidades estão sendo carregadas
        const cidades = cidadesPorEstado[estado];
        cidades.forEach(cidade => {
            const option = document.createElement("option");
            option.value = cidade;
            option.textContent = cidade;
            cidadeSelect.appendChild(option);
        });
    } else {
        console.log("Nenhuma cidade encontrada para o estado selecionado.");
    }
}