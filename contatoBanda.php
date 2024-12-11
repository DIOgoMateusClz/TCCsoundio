<?php 
include("validarSessao.php"); 
include("header.php"); 
include("conexaoBD.php"); 


if (isset($_GET['idBanda']) && intval($_GET['idBanda']) > 0) {
    $idBanda = intval($_GET['idBanda']); 


    if (!$link) {
        echo "Erro: Falha ao conectar com o banco de dados.";
        exit;
    }


    $sql = "SELECT nomeBanda, emailBanda, telefoneBanda FROM bandas WHERE idBanda = ?";
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $idBanda);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $banda = mysqli_fetch_assoc($result);
            $nome = $banda['nomeBanda'];
            $email = $banda['emailBanda'];
            $telefone = $banda['telefoneBanda'];
        } else {
        
            $nome = "Sem Nome";
            $email = "sem_email@exemplo.com";
            $telefone = "(00) 0000-0000";
        }
    } else {
        echo "Erro: Não foi possível preparar a consulta.";
        exit;
    }
} else {
  
    echo "Erro: ID da empresa não especificado.";
    exit();
}
?>
<body>
<div class="container text-center bg-dark p-5 text-light">
    <br><br>
    <h1>
        <p class="text-center">
            <strong>&nbsp;<?php echo htmlspecialchars($nome); ?></strong>
        </p>
    </h1>
    <br><br>
    
 
    <h2><strong>CONTATOS</strong></h2>
    <br><br>

    <div class="contact-info">
        <h3>
            <p class="text-center">
                <img src="icones/EmailWhite.png" width="40" height="40">
                &nbsp;<?php echo htmlspecialchars($email); ?>
            </p>
        </h3>
        <br>
        <h3>
            <p class="text-center">
                <img src="icones/TelefoneWhite.png" width="40" height="40">
                &nbsp;<?php echo htmlspecialchars($telefone); ?>
            </p>
        </h3>
        <br>
        
 
        <div class="container">
    <div style="margin-top:30px; margin-bottom:30px;">
   
        <a href="perfisBandas.php?idBanda=<?= $idBanda ?>" class="btn btn-outline-warning btn-lg">Voltar para perfil da Banda</a>
    </div>
</div>
        <br><br>
    </div>
</div>
</body>

<?php 
include("footer.php"); 
?>
