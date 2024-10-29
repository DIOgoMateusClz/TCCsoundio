<?php include("validarSessao.php"); ?>
<?php include("header.php"); ?>
    
    <h2>Criação de Evento</h2>
    <p>*Campo Obrigatório</p>
    <br>

    <form action="criarEvento.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="fotoEvento">Foto de divulgação:</label>
            <input type="file" class="btn btn-link" name="fotoEvento">
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o nome do evento" name="nomeEvento" required>
            <label for="nomeEvento" class="form-label">*Nome:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="time" class="form-control" placeholder="Informe a hora de ínicio do evento" name="horaEvento"
             id="horaEvento" required><label for="horaEvento" class="form-label" id="horaEvento">*Hora:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="date" class="form-control" placeholder="Informe a data do evento" name="dataEvento"
             id="dataEvento" required><label for="dataEvento" class="form-label" id="dataEvento">*Data:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Descreva as informações importantes do evento" name="descricaoEvento"></input>
            <label for="descricaoEvento" class="form-label">Descrição:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Informe a cidade que ocorrerá o evento" name="cidadeEvento"></input>
            <label for="cidadeEvento" class="form-label">*Cidade:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input class="form-control" placeholder="Informe o Estado do evento" name="estadoEvento"></input>
            <label for="estadoEvento" class="form-label">*Estado:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="number" class="form-control" placeholder="Informe o preco do evento (opicional)" name="precoEvento"
             id="precoEvento" required><label for="precoEvento" class="form-label" id="precoEvento">Valor R$:</label>
        </div>  
        <div class="form-floating mb-3 mt-3">
        <input class="form-control" placeholder="Informe o telefone de contato do evento" name="contatoEvento"></input>
        <label for="contatoEvento" class="form-label">*Telefone:</label>
        </div>

        <div class="jumbotron text-center">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Criar Evento</button>
        </div></div>
        </form>
        <?php include("footer.php");       

