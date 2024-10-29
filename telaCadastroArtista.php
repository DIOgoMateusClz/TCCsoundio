<?php include("header.php"); ?>
<div class="jumbotron text-center">
        <div style="margin-top:1px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">
            <a <?php if($pagina == 'telaCadastroEmpresa'){echo 'active';} ?>href="telaCadastroEmpresa.php?pagina=telaCadastroEmpresa" 
            title="Cadastro de Empresas">Sou uma Empresa: Clique aqui!</a></button>
        </div></div> 
    
    <h2>Cadastrar-se como Artista</h2>
    <p>*Campo Obrigatório</p>
    <br>

    <form action="cadastroArtista.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fotoArtista">Foto:</label>
            <input type="file" class="btn btn-link" name="fotoArtista">
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe seu nome completo" name="nomeArtista" required>
            <label for="nomeArtista" class="form-label">*Nome:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o CPF" name="cpfArtista" maxlength="14"
             id="cpfArtista" required><label for="cpfArtista" class="form-label" id="cpfArtista">*CPF:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Informe o CEP do artista" name="cepArtista"></input>
            <label for="cepArtista" class="form-label">*CEP:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
        <select class="form-control" name="estadoArtista" required>
            <option value="" disabled selected>Selecione o estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
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
        <label for="estadoArtista" class="form-label">*Estado:</label>
    </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Informe a Cidade" name="cidadeArtista"></input>
            <label for="cidadeArtista" class="form-label">*Cidade:</label>
        </div>
    
        <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Informe o telefone" name="telefoneArtista"></input>
        <label for="telefoneArtista" class="form-label">*Telefone:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Fale um pouco de você" name="descricaoArtista"></input>
        <label for="descricaoArtista" class="form-label">Descricao:</label>
        </div>

        <label for="colegiados">Habilidades:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="violao">Violão
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="guitarra">Guitarra
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="vocal">Vocal/Canto
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="bateria">Bateria
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="baixo">ContraBaixo
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="piano">Piano/Teclado
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="cavaquinho">Cavaquinho
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="sanfona">Sanfona (Acordeão)
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="percusao">Percussão
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="saxofone">Saxofone
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="violino">Violino
            </label>
        </div>
        

        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailArtista" required>
            <label for="emailArtista" class="form-label">*Email:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaArtista" required>
            <label for="senhaArtista" class="form-label">*Senha:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Confirme a Senha" name="confirmarSenhaArtista" required>
            <label for="confirmarSenhaArtista" class="form-label">*Confirme a Senha:</label>
        </div>

        <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Cadastrar</button>
        </div></div>
        </form>
        <?php include("footer.php");        