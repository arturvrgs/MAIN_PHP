
<?php
    include("conexao.php");
   
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = mysqli_query($banco, "select * from usuario where email = '$email'");
    $linha = mysqli_num_rows($sql);  
    
    for($i=0;$i<$linha;$i++) {
        $registro = mysqli_fetch_row($sql);  
        if ($senha == $registro[6]) {
           session_start();
           $_SESSION["id_usuario"] = $registro[0];
           $_SESSION["nome_usuario"] = $registro[1];
           $_SESSION["sobrenome_usuario"] = $registro[2];
           $_SESSION["telefone_usuario"] = $registro[3];
           $_SESSION["curso_usuario"] = $registro[4];
           $_SESSION["email_usuario"] = $registro[5];
           $_SESSION["foto_usuario"] = $registro[7];
           header("location:../menu.php");
        } else {
            echo "<h1>Errou a senha</h1>";
        }
    }
?>

<script type="text/javascript">
    function submit()
    {
        document.getElementById("btn").click();
        document.form.submit(); 
    }
</script>
