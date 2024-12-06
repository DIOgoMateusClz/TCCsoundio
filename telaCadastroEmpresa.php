<?php include("header.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>



<body>
    <!-- Seu conteúdo HTML -->
    <script src="cidades.js"></script>
</body>
<div class="jumbotron text-center">
        <div style="margin-top:1px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">
            <a <?php if($pagina == 'telaCadastroArtista'){echo 'active';} ?>href="telaCadastroBanda.php?pagina=telaCadastroBanda" 
            title="Cadastro de Banda">Sou uma Banda: Clique aqui!</a></button>
        </div></div> 

        <div class="jumbotron text-center">
      <a <?php if($pagina == 'loginEmpresa')
      {echo 'active';}?> href="loginEmpresa.php?pagina=loginEmpresa" title="Ir para login">
      <h4><p style="color:Black;"><strong>Já tenho cadastro... Entrar agora!</strong></h4></p></a>
</div>
<div class="container mt-5">
    <div class="jumbotron text-left">
    <h2>Cadastrar-se como Empresa</h2>
    <p>*Campo Obrigatório</p>
    <br>

    <form action="cadastroEmpresa.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fotoEmpresa">Foto:</label>
            <input type="file" class="btn btn-link" name="fotoEmpresa">
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o nome da empresa" name="nomeEmpresa" required>
            <label for="nomeEmpresa" class="form-label">*Nome:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Informe o CNPJ" name="cnpjEmpresa" maxlength="14"
        id="cnpjEmpresa" required>
        <label for="cnpjEmpresa" class="form-label">*CNPJ:</label>
    </div>
    <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Informe o CEP da empresa" name="cepEmpresa" maxlength="8" required></input>
        <label for="cepEmpresa" class="form-label">*CEP:</label>
    </div>
    <div class="form-floating mb-3 mt-3">
    <select class="form-control" id="estadoEmpresa" name="estadoEmpresa" required onchange="carregarCidades()">
        <option value="" disabled selected>Selecione o estado</option>
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AM">Amazonas</option>
        <option value="AP">Amapá</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MG">Minas Gerais</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MT">Mato Grosso</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
    </select>
    <label for="estadoEmpresa" class="form-label">*Estado:</label>
</div>

<div class="form-floating mb-3 mt-3">
    <select class="form-control" id="cidadeEmpresa" name="cidadeEmpresa" required>
        <option value="" disabled selected>Selecione a cidade</option>
    </select>
    <label for="cidadeEmpresa" class="form-label">*Cidade:</label>
</div>

    
        <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Informe o telefone" name="telefoneEmpresa" maxlength="12"></input>
        <label for="telefoneEmpresa" class="form-label">*Telefone:</label>
        </div>
        
   
        <label for="colegiados">Tipo de Local:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="bar">Bar
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="lanchonete">Lanchonete
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="restaurante">Restaurante
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="casadeShows">Casa de Shows
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="pizzaria">Pizzaria
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="centrodeEventos">Centro de Eventos
            </label>
        </div>
        <div class="form-floating mb-3 mt-3">
    <textarea class="form-control" placeholder="Fale um pouco da sua empresa" name="descricaoEmpresa" id="descricaoEmpresa" maxlength="1000" style="height: 150px;"></textarea>
    <label for="descricaoEmpresa" class="form-label">Descrição:</label>
</div>

        <br>

        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailEmpresa" required>
            <label for="emailEmpresa" class="form-label">*Email:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaEmpresa" required>
            <label for="senhaEmpresa" class="form-label">*Senha:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Confirme a Senha" name="confirmarSenhaEmpresa" required>
            <label for="confirmarSenhaEmpresa" class="form-label">*Confirme a Senha:</label>
        </div>

        <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Cadastrar</button>
        </div>
    </div>
        </form>
        
        <?php include("footer.php");        
        