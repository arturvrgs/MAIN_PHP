<?php 
    include("src/conexao.php");
    session_start();
    $nome = $_SESSION["nome_usuario"];
    $sobrenome = $_SESSION["sobrenome_usuario"];
    $foto = $_SESSION["foto_usuario"];
    $id = $_SESSION["id_usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen ">
   <div class="flex flex-col p-10 justify-center items-center w-1/4 bg-gray-200">
        <img class="rounded-lg object-cover h-56 w-56" src="<?php echo $foto ?>" alt="foto de perfil" >
        <h1 class="mt-3 text-lg font-base"><?php echo $nome.' '.$sobrenome ?></h1>
        <a href="#" class="mt-5 bg-red-600 py-3 w-full text-center text-white hover:bg-red-700 cursor-pointer rounded-md">Editar perfil</a>
        <a href="#" class="mt-5 bg-red-600 py-3 w-full text-center text-white hover:bg-red-700 cursor-pointer rounded-md">Sair</a>
   </div>
   <div class="flex flex-col w-full">
        <div class="flex h-2/4 bg-gray-300 gap-10 items-center p-10">
                <?php 
                    $sql = mysqli_query($banco, "select * from usuario");
                    $linha = mysqli_num_rows($sql);  

                    for($i=0;$i<$linha;$i++) {
                        $registro = mysqli_fetch_row($sql);
                        if($registro[0] != $id) {
                            echo "<div class='flex flex-col items-center'>
                            <h1 class='text-sm'>$registro[1]</h1>
                            <img class='rounded-lg object-cover h-20 w-20' src='$registro[7]'>
                            </div>  
                            ";
                        }
                    }
                ?>
        </div>
        <div class="flex h-2/4 p-10 gap-10 items-center">
                <a href="materiais.php" class="mt-5 bg-red-800 py-6 w-full text-center text-white hover:bg-red-700 cursor-pointer rounded-md">Materiais</a>
                <a href="#" class="mt-5 bg-red-800 py-6 w-full text-center text-white hover:bg-red-700 cursor-pointer rounded-md">Bate-Papo</a>
                <a href="#" class="mt-5 bg-red-800 py-6 w-full text-center text-white hover:bg-red-700 cursor-pointer rounded-md">Usuários</a>
        </div>
   </div>
   
</body>
</html>

