<?php include("header.php"); ?>

<?php
    // Inicializa as variáveis com valores vazios
    $fotoArtista = $nomeArtista = $cpfArtista = $cepArtista = $cidadeArtista = $estadoArtista = 
    $telefoneArtista = $descricaoArtista = $violao = $guitarra = $vocal = $bateria = $baixo = $piano = $cavaquinho = $sanfona =
    $percusao = $saxofone = $violino = $emailArtista = $senhaArtista = $confirmarSenhaArtista = "";

    $tudoCerto = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validação do campo nome
        if (empty($_POST["nomeArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $nomeArtista = testar_entrada($_POST["nomeArtista"]);
            if (!preg_match("/^[a-zA-ZãÃáÁàÀêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª\' \']*$/", $nomeArtista)) {
                echo "<div class='alert alert-warning text-center'>Atenção! No campo <strong>NOME</strong> somente letras são permitidas!</div>";
                $tudoCerto = false;
            }
        }

        // Validação do campo CPF
        if (empty($_POST["cpfArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CPF</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cpfArtista = testar_entrada($_POST["cpfArtista"]);
        }

        // Validação do campo CEP
        if (empty($_POST["cepArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CEP</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cepArtista = testar_entrada($_POST["cepArtista"]);
        }

        // Validação do campo Cidade
        if (empty($_POST["cidadeArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CIDADE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $cidadeArtista = testar_entrada($_POST["cidadeArtista"]);
        }

        // Validação do campo Estado
        if (empty($_POST["estadoArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>ESTADO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $estadoArtista = testar_entrada($_POST["estadoArtista"]);
        }

        // Validação do campo Telefone
        if (empty($_POST["telefoneArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $telefoneArtista = testar_entrada($_POST["telefoneArtista"]);
        }

        // Validação do campo Descrição
        if (empty($_POST["descricaoArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>DESCRIÇÃO</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $descricaoArtista = testar_entrada($_POST["descricaoArtista"]);
        }

        // Validação do campo Habilidades
        if(isset($_POST["violao"])){
            $violao = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $violao = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["guitarra"])){
            $guitarra = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $guitarra = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["vocal"])){
            $vocal = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $vocal = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["bateria"])){
            $bateria = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $bateria = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["baixo"])){
            $baixo = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $baixo = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["piano"])){
            $piano = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $piano = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["cavaquinho"])){
            $cavaquinho = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $cavaquinho = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["sanfona"])){
            $sanfona = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $sanfona = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["percusao"])){
            $percusao = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $percusao = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["saxofone"])){
            $saxofone = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $saxofone = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }

        if(isset($_POST["violino"])){
            $violino = 1; //Se o campo estiver marcado, atribui o valor 1
        }
        else{
            $violino = 0; //Se o campo NÃO estiver marcado, atribui o valor 0
        }




        // Validação do campo Email
        if (empty($_POST["emailArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $emailArtista = testar_entrada($_POST["emailArtista"]);
        }

        // Validação da senha
        if (empty($_POST["senhaArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $senhaArtista = md5(testar_entrada($_POST["senhaArtista"]));
        }

        // Validação da confirmação de senha
        if (empty($_POST["confirmarSenhaArtista"])) {
            echo "<div class='alert alert-warning'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $tudoCerto = false;
        } else {
            $confirmarSenhaArtista = md5(testar_entrada($_POST["confirmarSenhaArtista"]));
            if ($senhaArtista != $confirmarSenhaArtista) {
                echo "<div class='alert alert-warning'>Atenção! <strong>SENHAS DIFERENTES</strong>!</div>";
                $tudoCerto = false;
            }
        }

        // Upload da foto
        $diretorio = "img/";
        $fotoArtista = $diretorio . basename($_FILES["fotoArtista"]["name"]);
        $uploadOK = true;
        $tipoDaImagem = strtolower(pathinfo($fotoArtista, PATHINFO_EXTENSION));

        if ($_FILES["fotoArtista"]["size"] > 5000000) {
            echo "<div class='alert alert-warning'>Atenção! A foto ultrapassa o <strong>TAMANHO MÁXIMO</strong> permitido (5MB)!</div>";
            $uploadOK = false;
        }

        if ($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png") {
            echo "<div class='alert alert-warning'>Atenção! A foto precisa estar nos formatos <strong>JPG, JPEG ou PNG</strong>!</div>";
            $uploadOK = false;
        }

        if ($uploadOK) {
            if (!move_uploaded_file($_FILES["fotoArtista"]["tmp_name"], $fotoArtista)) {
                echo "<div class='alert alert-warning'>Erro ao tentar mover <strong>A FOTO</strong> para o diretório $diretorio!</div>";
                $uploadOK = false;
            }
        }

        // Se estiver tudo certo
        if ($tudoCerto && $uploadOK) {
            include("conexaoBD.php");

            $inserirArtista = "INSERT INTO artistas (fotoArtista, nomeArtista, cpfArtista, cepArtista, cidadeArtista,
            estadoArtista, telefoneArtista, descricaoArtista, violao, guitarra, vocal, bateria,
            baixo, piano, cavaquinho, sanfona, percusao, saxofone, violino, emailArtista, senhaArtista) 
            VALUES ('$fotoArtista', '$nomeArtista', '$cpfArtista', '$cepArtista', '$cidadeArtista',
            '$estadoArtista', '$telefoneArtista', '$descricaoArtista', '$violao', '$guitarra', '$vocal', '$bateria',
            '$baixo', '$piano', '$cavaquinho', '$sanfona', '$percusao', '$saxofone', '$violino', '$emailArtista', '$senhaArtista')";

            if (mysqli_query($link, $inserirArtista)) {
                echo "<div class='alert alert-success text-center'><strong>Artista</strong> cadastrada com sucesso!</div>";

                echo "<div class='container mt-3'>
                <div class='container mt-3 text-center'>
                    <img src='$fotoArtista' width='150'>
                </div>
                <table class='table'>
                    <tr>
                        <th>NOME</th>
                        <td>$nomeArtista</td>
                    </tr>
                    <tr>
                        <th>CPF</th>
                        <td>$cpfArtista</td>
                    </tr>
                    <tr>
                        <th>CEP</th>
                        <td>$cepArtista</td>
                    </tr>
                    <tr>
                        <th>CIDADE</th>
                        <td>$cidadeArtista</td>
                    </tr>
                    <tr>
                        <th>ESTADO</th>
                        <td>$estadoArtista</td>
                    </tr>
                    <tr>
                        <th>TELEFONE</th>
                        <td>$telefoneArtista</td>
                    </tr>
                    <tr>
                        <th>DESCRIÇÃO</th>
                        <td>$descricaoArtista</td>
                    </tr>
                    <tr>
                    <th>HABILIDADES</th>
                    <td>";
                        if($violao){
                            echo "<p>Violão</p>";
                        }
                        if($guitarra){
                            echo "<p>Guitarra</p>";
                        }
                        if($vocal){
                            echo "<p>Vocal/Canto</p>";
                        }
                        if($bateria){
                            echo "<p>Bateria</p>";
                        }
                        if($baixo){
                            echo "<p>ContraBaixo</p>";
                        }
                        if($piano){
                            echo "<p>Piano/Teclado</p>";
                        }
                        if($cavaquinho){
                            echo "<p>Cavaquinho</p>";
                        }
                        if($sanfona){
                            echo "<p>Sanfona</p>";
                        }
                        if($percusao){
                            echo "<p>Percussão</p>";
                        }
                        if($saxofone){
                            echo "<p>Saxofone</p>";
                        }
                        if($violino){
                            echo "<p>Violino</p>";
                        }
                echo"</td>
                </tr>
                    <tr>
                        <th>EMAIL</th>
                        <td>$emailArtista</td>
                    </tr>
                    <tr>
                        <th>SENHA</th>
                        <td>$senhaArtista</td>
                    </tr>
                    <tr>
                        <th>CONFIRMAR SENHA</th>
                        <td>$confirmarSenhaArtista</td>
                    </tr>
                </table>
            </div>
        ";
    }

            } else {
                echo "<div class='alert alert-danger'>Erro ao tentar cadastrar <strong>Artista</strong>!</div>" . mysqli_error($link);
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
