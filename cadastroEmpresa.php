<?php include("header.php"); ?>

<?php
    // Inicializa as variáveis com valores vazios
    $fotoEmpresa = $nomeEmpresa = $cnpjEmpresa = $cepEmpresa = $cidadeEmpresa = $estadoEmpresa = 
    $telefoneEmpresa = $descricaoEmpresa = $bar = $lanchonete = $restaurante = $casadeShows = $pizzaria = $centrodeEventos
    = $emailEmpresa = $senhaEmpresa = $confirmarSenhaEmpresa = "";

    $tudoCerto = true;

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação do campo nome
        if (empty($_POST["nomeEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $nomeEmpresa = testar_entrada($_POST["nomeEmpresa"]);
          
        }

        // Validação do campo CNPJ
        if (empty($_POST["cnpjEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CNPJ</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cnpjEmpresa = testar_entrada($_POST["cnpjEmpresa"]);
        }

        // Validação do campo CEP
        if (empty($_POST["cepEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CEP</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cepEmpresa = testar_entrada($_POST["cepEmpresa"]);
        }

        // Validação do campo Cidade
        if (empty($_POST["cidadeEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cidadeEmpresa = testar_entrada($_POST["cidadeEmpresa"]);
        }

        // Validação do campo Estado
        if (empty($_POST["estadoEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>ESTADO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $estadoEmpresa = testar_entrada($_POST["estadoEmpresa"]);
        }

        // Validação do campo Telefone
        if (empty($_POST["telefoneEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $telefoneEmpresa = testar_entrada($_POST["telefoneEmpresa"]);
        }

        // Validação do campo Descrição
        if (empty($_POST["descricaoEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>DESCRIÇÃO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $descricaoEmpresa = testar_entrada($_POST["descricaoEmpresa"]);
        }

        
        // Validação do campo Genero
        if(isset($_POST["bar"])){
            $bar = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $bar = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["lanchonete"])){
            $lanchonete = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $lanchonete = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["restaurante"])){
            $restaurante = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $restaurante = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["casadeShows"])){
            $casadeShows = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $casadeShows = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["pizzaria"])){
            $pizzaria = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $pizzaria = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["centrodeEventos"])){
            $centrodeEventos = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $centrodeEventos = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        // Validação do campo Email
        if (empty($_POST["emailEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $emailEmpresa = testar_entrada($_POST["emailEmpresa"]);
        }

        // Validação da senha
        if (empty($_POST["senhaEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $senhaEmpresa = md5(testar_entrada($_POST["senhaEmpresa"]));
        }

        // Validação da confirmação de senha
        if (empty($_POST["confirmarSenhaEmpresa"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $confirmarSenhaEmpresa = md5(testar_entrada($_POST["confirmarSenhaEmpresa"]));
            if ($senhaEmpresa != $confirmarSenhaEmpresa) {
                echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
                $tudoCerto = false;
            }
        }

        $diretorio = "img/";
        $fotoEmpresaOriginal = basename($_FILES["fotoEmpresa"]["name"]);
        $tipoDaImagem = strtolower(pathinfo($fotoEmpresaOriginal, PATHINFO_EXTENSION));
        
        // Renomeia a imagem com um identificador único
        $fotoEmpresa = $diretorio . uniqid() . '.' . $tipoDaImagem;
        
        $uploadOK = true;
        
        if ($_FILES["fotoEmpresa"]["size"] > 5000000) {
            echo "<div class='alert alert-warning'>Atenção! A foto ultrapassa o <strong>TAMANHO MÁXIMO</strong> permitido (5MB)!</div>";
            $uploadOK = false;
        }
        
        if ($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png") {
            echo "<div class='alert alert-warning'>Atenção! A foto precisa estar nos formatos <strong>JPG, JPEG ou PNG</strong>!</div>";
            $uploadOK = false;
        }
        
        if ($uploadOK) {
            if (!move_uploaded_file($_FILES["fotoEmpresa"]["tmp_name"], $fotoEmpresa)) {
                echo "<div class='alert alert-warning'>Erro ao tentar mover <strong>A FOTO</strong> para o diretório $diretorio!</div>";
                $uploadOK = false;
            }

            
        include("conexaoBD.php");
        // Se estiver tudo certo
        if ($tudoCerto && $uploadOK) {
     
           
             $inserirEmpresa = "INSERT INTO empresas (fotoEmpresa, nomeEmpresa, cnpjEmpresa, cepEmpresa, cidadeEmpresa,
             estadoEmpresa, telefoneEmpresa, descricaoEmpresa, bar, lanchonete, restaurante, casadeShows, pizzaria, centrodeEventos,
            emailEmpresa, senhaEmpresa) 
                               VALUES ('$fotoEmpresa', '$nomeEmpresa', '$cnpjEmpresa', '$cepEmpresa', '$cidadeEmpresa',
                                '$estadoEmpresa', '$telefoneEmpresa', '$descricaoEmpresa',  '$bar', '$lanchonete', '$restaurante',
                                 '$casadeShows', '$pizzaria', '$centrodeEventos', '$emailEmpresa', '$senhaEmpresa')";

                if (mysqli_query($link, $inserirEmpresa)) {
                    echo "<div class='alert alert-success text-center'><strong>Empresa</strong> cadastrada com sucesso!</div>";
                    echo "<div class='jumbotron text-center'>
                    <div style='margin-top:1px; margin-bottom:30px;'>
                        <a href='loginEmpresa.php' class='btn btn-outline-dark btn-lg' title='Login Empresa'>
                            Ir para o Login!
                        </a>
                    </div>
                  </div>";

                        echo "<div class='container mt-3'>
                        <div class='container mt-3 text-center'>
                        <img src='$fotoEmpresa' width='150'>
                        </div>
                        <table class='table'>
                            <tr>
                                <th>NOME</th>
                                <td>$nomeEmpresa</td>
                            </tr>
                            <tr>
                                <th>CNPJ</th>
                                <td>$cnpjEmpresa</td>
                            </tr>
                            <tr>
                                <th>CEP</th>
                                <td>$cepEmpresa</td>
                            </tr>
                            <tr>
                                <th>CIDADE</th>
                                <td>$cidadeEmpresa</td>
                            </tr>
                            <tr>
                                <th>ESTADO</th>
                                <td>$estadoEmpresa</td>
                            </tr>
                            <tr>
                                <th>TELEFONE</th>
                                <td>$telefoneEmpresa</td>
                            </tr>
                            <tr>
                                <th>DESCRIÇÃO</th>
                                <td>$descricaoEmpresa</td>
                            </tr>
                            <tr>
                            <th>GÊNERO</th>
                            <td>";
                                if($bar){
                                    echo "<p>Bar</p>";
                                }
                                if($lanchonete){
                                    echo "<p>Lanchonete</p>";
                                }
                                if($restaurante){
                                    echo "<p>Restaurante</p>";
                                }
                                if($casadeShows){
                                    echo "<p>Casa de Shows</p>";
                                }
                                if($pizzaria){
                                    echo "<p>Pizzaria</p>";
                                }
                                if($centrodeEventos){
                                    echo "<p>Centro de Eventos</p>";
                                }
                        echo"</td>
                        </tr>
                            <tr>
                                <th>EMAIL</th>
                                <td>$emailEmpresa</td>
                            </tr>
                            <tr>
                                <th>SENHA</th>
                                <td>$senhaEmpresa</td>
                            </tr>
                            <tr>
                                <th>CONFIRMAR SENHA</th>
                                <td>$confirmarSenhaEmpresa</td>
                            </tr>
                        </table>
                    </div>
                    
                ";

               
            }
        }
            } else {
                echo "<div class='alert alert-danger'>Erro ao tentar cadastrar <strong>Empresa</strong>!</div>" . mysqli_error($link);
            }
        }
    

    // Função para evitar SQL Injection
    function testar_entrada($dado) {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);
        return $dado;
    }
?>

<?php include("footer.php"); ?>
