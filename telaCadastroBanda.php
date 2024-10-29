<?php include("header.php"); ?>
<div class="jumbotron text-center">
        <div style="margin-top:1px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">
            <a <?php if($pagina == 'telaCadastroEmpresa'){echo 'active';} ?>href="telaCadastroEmpresa.php?pagina=telaCadastroEmpresa" 
            title="Cadastro de Empresas">Sou uma Empresa: Clique aqui!</a></button>
        </div></div> 
    
    <h2>Cadastrar-se como Banda</h2>
    <p>*Campo Obrigatório</p>
    <br>

    <form action="cadastroBanda.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fotoBanda">Foto:</label>
            <input type="file" class="btn btn-link" name="fotoBanda">
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe seu nome completo" name="nomeBanda" required>
            <label for="nomeBanda" class="form-label">*Nome:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Descreva sua banda" name="descricaoBanda"></input>
            <label for="descricaoBanda" class="form-label">*Descrição:</label>
        </div>
  
        <div class="form-floating mb-3 mt-3">
        <select class="form-control" name="estadoBanda" required>
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
        <label for="estadoBanda" class="form-label">*Estado:</label>
    </div>
    <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Informe a cidade da banda" name="cidadeBanda"></input>
            <label for="cidadeBanda" class="form-label">*Cidade:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Informe o telefone" name="telefoneBanda"></input>
        <label for="telefoneBanda" class="form-label">*Telefone:</label>
        </div>

        <label for="colegiados">Gênero:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="rock">Rock
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="heavyMetal">Heavy Metal
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="punk">Punk
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="hardcore">Hardcore
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="sertanejo">Sertanejo
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="pagode">Pagode
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="samba">Samba
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="gospel">Gospel
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="rap">Rap
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="funk">Funk
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="MPB">MPB
            </label>
        </div>
        

        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailBanda" required>
            <label for="emailBanda" class="form-label">*Email:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Informe uma Senha" name="senhaBanda" required>
            <label for="senhaBanda" class="form-label">*Senha:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="password" class="form-control" placeholder="Confirme a Senha" name="confirmarSenhaBanda" required>
            <label for="confirmarSenhaBanda" class="form-label">*Confirme a Senha:</label>
        </div>
        
        <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Cadastrar</button>
        </div></div>
        </form>
        <?php include("footer.php");        