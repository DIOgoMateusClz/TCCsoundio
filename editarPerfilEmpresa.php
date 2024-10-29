<?php include("validarSessao.php"); ?>
<?php include ("header.php"); ?>

<?php
$idEmpresa = $_SESSION['idEmpresa']; // Recebe o ID da empresa que está logada
    if(isset($_GET["idEmpresa"])){
        

        include("conexaoBD.php");

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
            $bar              = $registro["bar"];
            $lanchonete       = $registro["lanchonete"];
            $restaurante      = $registro["restaurante"];
            $casadeShows      = $registro["casadeShows"];
            $pizzaria         = $registro["pizzaria"];
            $centrodeEventos  = $registro["centrodeEventos"];
            $emailEmpresa     = $registro["emailEmpresa"];
        }
    }
?>

<h2>Editar dados da Empresa</h2>
<p>*Campo Obrigatório</p>
<br>

<form action="editarEmpresa.php" method="POST" enctype="multipart/form-data">

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="idEmpresa" value="<?php echo $idEmpresa;?>" readonly>
            <label for="idEmpresa" class="form-label">*ID:</label>
        </div>

        <div class="form-group">
            <img src="<?php echo $fotoEmpresa; ?>" width="100"> <!-- Exibe a FOTO ATUAL cadastrada -->
            <input type="hidden" name="fotoAtual" value="<?php echo $fotoEmpresa; ?>"> <!-- Passa o local-->
            <input type="file" class="btn btn-link" name="fotoEmpresa">
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o seu nome Completo" name="nomeEmpresa" value="<?php echo $nomeEmpresa;?>" required>
            <label for="nomeEmpresa" class="form-label">*Nome:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o CNPJ" name="cnpjEmpresa" maxlength="14" id="cnpjEmpresa" value="<?php echo $cnpjEmpresa;?>" required>
            <label for="cnpjEmpresa" class="form-label" id="cnpjEmpresa">*CNPJ:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o CEP" name="cepEmpresa" maxlength="7" value="<?php echo $cepEmpresa;?>" required>
            <label for="cepEmpresa" class="form-label" id="cepEmpresa">*CEP:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <select class="form-select" name="estadoEmpresa">
                <?php
                    include("conexaoBD.php");
                    $listarEstados = "SELECT * FROM estados";
                    $res = mysqli_query($link, $listarEstados) or die("<div class='alert alert-danger text-center'>Erro ao tentar carregar <strong>ESTADOS</strong>!</div>");
                    while($registro = mysqli_fetch_assoc($res)){
                        $siglaEstado = $registro["siglaEstado"];
                        $nomeEstado  = $registro["nomeEstado"];

                        if($siglaEstado == $estadoEmpresa){
                            echo "<option value='$siglaEstado' selected>$nomeEstado</option>";
                        }
                        else{
                            echo "<option value='$siglaEstado'>$nomeEstado</option>";
                        }
                    }
                    
                ?>
            </select>
            <label for="estadoEmpresa" class="form-label">Estado:</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <textarea class="form-control" placeholder="Informe a CIDADE" name="cidadeEmpresa"><?php echo $cidadeEmpresa; ?></textarea>
            <label for="cidadeEmpresa" class="form-label">*Cidade:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe o TELEFONE" name="telefoneEmpresa" maxlength="11" value="<?php echo $telefoneEmpresa;?>" required>
            <label for="telefoneEmpresa" class="form-label" id="cepEmpresa">*Telefone:</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" placeholder="Informe a Descrição" name="descricaoEmpresa" maxlength="11" value="<?php echo $descricaoEmpresa;?>">
            <label for="telefoneEmpresa" class="form-label" id="descricaoEmpresa">Descrição:</label>
        </div>


        <label for="colegiados">Tipo de Local:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="bar" <?php if($bar){echo "checked";} ?> >Bar
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="lanchonete" <?php if($lanchonete){echo "checked";} ?> >Lanchonete
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="restaurante" <?php if($restaurante){echo "checked";} ?> >Restaurante
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="casadeShows" <?php if($casadeShows){echo "checked";} ?> >Casa de Shows
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="pizzaria" <?php if($pizzaria){echo "checked";} ?> >Pizzaria
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="centrodeEventos" <?php if($centrodeEventos){echo "checked";} ?> >Centro de Eventos
            </label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" placeholder="Informe o email" name="emailEmpresa" value="<?php echo $emailEmpresa; ?>" required>
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

        <div class="jumbotron">
        <div style="margin-top:30px; margin-bottom:30px;">
            <button type="submit" class="btn btn-outline-dark btn-lg">Cadastrar</button>
        </div></div>

    </form>


<?php include ("footer.php"); ?>