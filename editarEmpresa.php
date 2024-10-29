<?php include("validarSessao.php"); ?>
<?php include("header.php") ?>

<?php

// Verifica se o ID da empresa está definido na sessão
if (isset($_SESSION['idEmpresa'])) {
    $idEmpresa = $_SESSION['idEmpresa'];
} else {
    echo "<div class='alert alert-danger'>Erro: ID da empresa não encontrado na sessão.</div>";
    exit;
}

    $nomeEmpresa = $cnpjEmpresa = $cepEmpresa = $cidadeEmpresa = $estadoEmpresa = 
    $telefoneEmpresa = $descricaoEmpresa = $bar = $lanchonete = $restaurante = $casadeShows = $pizzaria = $centrodeEventos =
    $emailEmpresa = $senhaEmpresa = $confirmarSenhaEmpresa = "";

    $tudoCerto = true; //Essa variável será responsável por verificar se os campos foram devidamente preenchidos;

    if($_SERVER["REQUEST_METHOD"] == "POST"){ //Verifica o método de envio do FORM
        $idEmpresa = $_SESSION['idEmpresa']; // Recebe o ID da empresa que está logada
    
        
        if(empty($_POST["nomeEmpresa"])){
            echo "<div class='alert alert-warning'>O campo<strong>NOME</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $nomeEmpresa = testar_entrada($_POST["nomeEmpresa"]);
            //A função preg_match define uma regra para aceitar apenas caracteres deste conjunto
            if (!preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª\' \']*$/", $nomeEmpresa)){
                echo "<div class='alert alert-warning text-center'>Atenção! No campo <strong>NOME</strong> somente letras são permitidas!</div>";
                $tudoCerto = false;
            }
        }

        //Validação do campo CNPJ
        if(empty($_POST["cnpjEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>CNPJ</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $cnpjEmpresa = testar_entrada($_POST["cnpjEmpresa"]);
        }

        //Validação do campo SIAPE
        if(empty($_POST["cepEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>CEP</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $cepEmpresa = testar_entrada($_POST["cepEmpresa"]);
        }

        //Validação do campo CIDADE
        if(empty($_POST["cidadeEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $cidadeEmpresa = testar_entrada($_POST["cidadeEmpresa"]);
        }

        $estadoEmpresa = testar_entrada($_POST["estadoEmpresa"]);

        //Validação do campo TELEFONE
        if(empty($_POST["telefoneEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $telefoneEmpresa = testar_entrada($_POST["telefoneEmpresa"]);
        }

        //Validação do campo DESCRIÇÃO
     //      if(empty($_POST["descricaoEmpresa"])){
     //       echo "<div class='alert alert-warning'>O campo <strong>DESCRICAO</strong> é obrigatório!</div>";
    //        $tudoCerto = false;
    //    }
   //     else{
        $descricaoEmpresa = testar_entrada($_POST["descricaoEmpresa"]);
  //      }

        //Validação dos campos CHECKBOX
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

        //Validação do campo EMAIL
        if(empty($_POST["emailEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $emailEmpresa = testar_entrada($_POST["emailEmpresa"]);
        }

        //Validação do campo SENHA
        if(empty($_POST["senhaEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            //Aplica a função md5 para criptografar a senha (e também a confirmação de senha)
            $senhaEmpresa = md5(testar_entrada($_POST["senhaEmpresa"]));
        }

        //Validação do campo CONFIRMAR SENHA
        if(empty($_POST["confirmarSenhaEmpresa"])){
            echo "<div class='alert alert-warning'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        }
        else{
            $confirmarSenhaEmpresa = md5(testar_entrada($_POST["confirmarSenhaEmpresa"]));
            if($senhaEmpresa != $confirmarSenhaEmpresa){
                echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
                $tudoCerto = false;
            }
        }

        if($_FILES['fotoEmpresa']['size'] != 0){ //Verifica se houve alteração da foto 

            $diretorio    = "img/"; //Define para qual diretório do sistema as imagens serão movidas
            $fotoEmpresa  = $diretorio . basename($_FILES["fotoEmpresa"]["name"]); //img/Empresa.png
            $uploadOK     = true; //Variável criada para verificar se houve sucesso no upload do arquivo
            $tipoDaImagem = strtolower(pathinfo($fotoEmpresa, PATHINFO_EXTENSION)); //Pegar o tipo do arquivo

            //Verificar o tamanho do arquivo
            if($_FILES["fotoEmpresa"]["size"] > 5000000) { //Verifica o tamanho em BYTES
                echo "<div class='alert alert-warning'>Atenção! A foto ultrapassa o <strong>TAMANHO MÁXIMO</strong> permitido (5MB)!</div>";
                $uploadOK = false;
            }

            //Verificar o tipo do arquivo (Pela extensão)
            if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png"){
                echo "<div class='alert alert-warning'>Atenção! A foto precisa estar nos formatos <strong>JPG, JPEG ou PNG</strong>!</div>";
                $uploadOK = false;
            }

            if(!$uploadOK){
                echo "<div class='alert alert-warning'>Erro ao tentar fazer o <strong>UPLOAD DA FOTO</strong>!</div>";
                $uploadOK = false;
            }
            else{
                //A função seguinte é responsável por mover o arquivo para o diretório definido
                if(!move_uploaded_file($_FILES["fotoEmpresa"]["tmp_name"], $fotoEmpresa)){
                    echo "<div class='alert alert-warning'>Erro ao tentar mover 
                        <strong>A FOTO</strong> para o diretório $diretorio!</div>";
                    $uploadOK = false;
                }
            }
        
        }
        else{ //Se não houver atualização da foto, mantém a FOTO ATUAL
            $fotoEmpresa = $_POST["fotoAtual"];
            $uploadOK = true;
        }

        //Se estiver tudo certo
        if($tudoCerto && $uploadOK){

            //Cria uma Query responsável por realizar a edição dos dados no BD
            $editarEmpresa = "UPDATE empresas
                              SET
                                fotoEmpresa           = '$fotoEmpresa',
                                nomeEmpresa           = '$nomeEmpresa',
                                cnpjEmpresa           = '$cnpjEmpresa',
                                cepEmpresa            = '$cepEmpresa',
                                cidadeEmpresa         = '$cidadeEmpresa',
                                estadoEmpresa         = '$estadoEmpresa',
                                telefoneEmpresa       = '$telefoneEmpresa',
                                descricaoEmpresa      = '$descricaoEmpresa',
                                bar                   = $bar,
                                lanchonete            = $lanchonete,
                                restaurante           = $restaurante,
                                casadeShows           = $casadeShows,
                                pizzaria              = $pizzaria,
                                centrodeEventos       = '$centrodeEventos',
                                senhaEmpresa         = '$senhaEmpresa'
                            WHERE idEmpresa           = $idEmpresa";

            include("conexaoBD.php");

            //Função para executar QUERYs no Banco de Dados
            if(mysqli_query($link, $editarEmpresa)){

                echo "<div class='alert alert-success text-center'>Dados da <strong>Empresa</strong> editados com sucesso!</div>";

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
                                <th>DESCRICAO</th>
                                <td>$descricaoEmpresa</td>
                            </tr>
                                <th>TIPO DE LOCAL:</th>
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
            else{
                echo "<div class='alert alert-danger'>Erro ao tentar editar dados da <strong>EMPRESA</strong>!</div>" . mysqli_error($link);
            }
        }
    }

    //Função para testar as entradas de dados e evitar SQL Injection
    function testar_entrada($dado){
        $dado = trim($dado); //TRIM - Remove caracteres desnecessários (TABS, espaços, etc)
        $dado = stripslashes($dado); //Remove barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML
        return($dado);
    }

?>

<?php include("footer.php") ?>