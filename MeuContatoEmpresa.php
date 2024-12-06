<?php 
include("validarSessao.php"); 
include("header.php"); 
include("conexaoBD.php"); 

// Verifica se o ID da empresa logada está disponível na sessão
if (isset($_SESSION['idEmpresa'])) {
    $idEmpresa = $_SESSION['idEmpresa'];

    // Verifica se a conexão com o banco de dados foi estabelecida
    if (!$link) {
        echo "Erro: Falha ao conectar com o banco de dados.";
        exit;
    }

    // Consulta ao banco de dados para buscar dados da empresa logada
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
            // Valores padrão se a consulta não retornar resultados
            $nome = "Sem Nome";
            $email = "sem_email@exemplo.com";
            $telefone = "(00) 0000-0000";
        }
    } else {
        echo "Erro: Não foi possível preparar a consulta.";
        exit;
    }
} else {
    // Caso não haja ID na sessão, redireciona para a página de login ou exibe uma mensagem de erro
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
    
    <!-- Exibe o nome, email e telefone da empresa logada puxados do banco -->
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
         <!-- Botão para voltar ao perfil -->
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
