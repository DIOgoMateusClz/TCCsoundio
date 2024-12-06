<?php include("header.php"); ?>

<?php
    // Inicializa as variáveis com valores vazios
    $fotoBanda = $nomeBanda = $descricaoBanda = $cidadeBanda = $estadoBanda =
    $telefoneBanda = $rock = $heavyMetal = $punk = $hardcore = $sertanejo = $pagode = $samba = $gospel = $rap =
    $funk = $MPB = $emailBanda = $senhaBanda = $confirmarSenhaBanda = "";

    $tudoCerto = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação do campo nome
        if (empty($_POST["nomeBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $nomeBanda = testar_entrada($_POST["nomeBanda"]);
            //if (!preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª\' \']*$/", $nomeBanda)) {
              //  echo "<div class='alert alert-warning text-center'>Atenção! No campo <strong>NOME</strong> somente letras são permitidas!</div>";
              //  $tudoCerto = false;
            }
        }

         // Validação do campo Descrição
         if (empty($_POST["descricaoBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>DESCRIÇÃO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $descricaoBanda = testar_entrada($_POST["descricaoBanda"]);
        }

                // Validação do campo Estado
        if (empty($_POST["estadoBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>ESTADO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $estadoBanda = testar_entrada($_POST["estadoBanda"]);
        }

        // Validação do campo Cidade
        if (empty($_POST["cidadeBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cidadeBanda = testar_entrada($_POST["cidadeBanda"]);
        }



        // Validação do campo Telefone
        if (empty($_POST["telefoneBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $telefoneBanda = testar_entrada($_POST["telefoneBanda"]);
        }

       

        // Validação do campo Genero
        if(isset($_POST["rock"])){
            $rock = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $rock = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["heavyMetal"])){
            $heavyMetal = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $heavyMetal = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["punk"])){
            $punk = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $punk = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["hardcore"])){
            $hardcore = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $hardcore = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["sertanejo"])){
            $sertanejo = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $sertanejo = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["pagode"])){
            $pagode = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $pagode = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["samba"])){
            $samba = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $samba = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["gospel"])){
            $gospel = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $gospel = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["rap"])){
            $rap = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $rap = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["funk"])){
            $funk = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $funk = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["MPB"])){
            $MPB = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $MPB = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }



        // Validação do campo Email
        if (empty($_POST["emailBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $emailBanda = testar_entrada($_POST["emailBanda"]);
        }

        // Validação da senha
        if (empty($_POST["senhaBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $senhaBanda = md5(testar_entrada($_POST["senhaBanda"]));
        }

        // Validação da confirmação de senha
        if (empty($_POST["confirmarSenhaBanda"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $confirmarSenhaBanda = md5(testar_entrada($_POST["confirmarSenhaBanda"]));
            if ($senhaBanda != $confirmarSenhaBanda) {
                echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
                $tudoCerto = false;
            }
        }

     // Upload da foto
$diretorio = "img/";
$fotoBandaOriginal = basename($_FILES["fotoBanda"]["name"]);
$tipoDaImagem = strtolower(pathinfo($fotoBandaOriginal, PATHINFO_EXTENSION));

// Renomeia a imagem com um identificador único
$fotoBanda = $diretorio . uniqid() . '.' . $tipoDaImagem;

$uploadOK = true;

if ($_FILES["fotoBanda"]["size"] > 5000000) {
    echo "<div class='alert alert-warning'>Atenção! A foto ultrapassa o <strong>TAMANHO MÁXIMO</strong> permitido (5MB)!</div>";
    $uploadOK = false;
}

if ($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png") {
    echo "<div class='alert alert-warning'>Atenção! A foto precisa estar nos formatos <strong>JPG, JPEG ou PNG</strong>!</div>";
    $uploadOK = false;
}

if ($uploadOK) {
    if (!move_uploaded_file($_FILES["fotoBanda"]["tmp_name"], $fotoBanda)) {
        echo "<div class='alert alert-warning'>Erro ao tentar mover <strong>A FOTO</strong> para o diretório $diretorio!</div>";
        $uploadOK = false;
    }


        include("conexaoBD.php");
        // Se estiver tudo certo
        if ($tudoCerto && $uploadOK) {
     

            $inserirBanda = "INSERT INTO bandas (fotoBanda, nomeBanda, descricaoBanda,  estadoBanda, cidadeBanda,
            telefoneBanda, rock, heavyMetal, punk, hardcore, sertanejo, pagode, samba, gospel,
            rap, funk, MPB, emailBanda, senhaBanda) 
            VALUES ('$fotoBanda', '$nomeBanda', '$descricaoBanda', '$estadoBanda', '$cidadeBanda',
            '$telefoneBanda', '$rock', '$heavyMetal', '$punk', '$hardcore', '$sertanejo',
            '$pagode', '$samba', '$gospel', '$rap', '$funk', '$MPB', '$emailBanda', '$senhaBanda')";
            
            
            if (mysqli_query($link, $inserirBanda)) {
                echo "<div class='alert alert-success text-center'><strong>Banda</strong> cadastrada com sucesso!</div>";
                echo "<div class='jumbotron text-center'>
                <div style='margin-top:1px; margin-bottom:30px;'>
                    <a href='loginBanda.php' class='btn btn-outline-dark btn-lg' title='Login Banda'>
                        Ir para o Login!
                    </a>
                </div>
              </div>";
                echo "<div class='container mt-3'>
                <div class='container mt-3 text-center'>
                    <img src='$fotoBanda' width='150'>
                </div>
                <table class='table'>
                    <tr>
                        <th>NOME</th>
                        <td>$nomeBanda</td>
                    </tr>
                    <tr>
                        <th>DESCRIÇÃO</th>
                        <td>$descricaoBanda</td>
                    </tr>
                    <tr>
                        <th>ESTADO</th>
                        <td>$estadoBanda</td>
                    </tr>
                    <tr>
                    <th>CIDADE</th>
                    <td>$cidadeBanda</td>
                </tr>
                    <tr>
                        <th>TELEFONE</th>
                        <td>$telefoneBanda</td>
                    </tr>
                    <tr>
                    <th>GÊNERO</th>
                    <td>";
                        if($rock){
                            echo "<p>Rock</p>";
                        }
                        if($heavyMetal){
                            echo "<p>Heavy Metal</p>";
                        }
                        if($punk){
                            echo "<p>Punk</p>";
                        }
                        if($hardcore){
                            echo "<p>Hardcore</p>";
                        }
                        if($sertanejo){
                            echo "<p>Sertanejo</p>";
                        }
                        if($pagode){
                            echo "<p>Pagode</p>";
                        }
                        if($samba){
                            echo "<p>Samba</p>";
                        }
                        if($gospel){
                            echo "<p>Gospel</p>";
                        }
                        if($rap){
                            echo "<p>Rap</p>";
                        }
                        if($funk){
                            echo "<p>Funk</p>";
                        }
                        if($MPB){
                            echo "<p>MPB</p>";
                        }
                echo"</td>
                </tr>
                
                    <tr>
                        <th>EMAIL</th>
                        <td>$emailBanda</td>
                    </tr>
                    <tr>
                        <th>SENHA</th>
                        <td>$senhaBanda</td>
                    </tr>
                    <tr>
                        <th>CONFIRMAR SENHA</th>
                        <td>$confirmarSenhaBanda</td>
                    </tr>
                </table>
            </div>
            
        ";

    }

            } else {
                echo "<div class='alert alert-danger'>Erro ao tentar cadastrar <strong>Banda</strong>!</div>" . mysqli_error($link);
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