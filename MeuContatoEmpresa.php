<?php 
include("validarSessao.php"); 
include("header.php"); 
include("conexaoBD.php"); 


if (isset($_SESSION['idEmpresa'])) {
    $idEmpresa = $_SESSION['idEmpresa'];

  
    if (!$link) {
        echo "Erro: Falha ao conectar com o banco de dados.";
        exit;
    }

   
    $sql = "SELECT nomeEmpresa, emailEmpresa, telefoneEmpresa FROM empresas WHERE idEmpresa = ?";
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $idEmpresa);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $empresa = mysqli_fetch_assoc($result);
            $nome = $empresa['nomeEmpresa'];
            $email = $empresa['emailEmpresa'];
            $telefone = $empresa['telefoneEmpresa'];
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

    header("Location: login.php");
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
                <a href="meuPerfil.php" class="btn btn-outline-warning btn-lg">Voltar para meu perfil</a>
            </div>
        </div>
        <br><br>
       
    </div>
   
</div>
</body>

<?php 
include("footer.php"); 
?>
