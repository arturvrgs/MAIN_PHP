<?php 
    include("src/conexao.php");
    session_start();

    
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="bg-gray-200 p-8">
        <input id="btnAdd" class="bg-red-700 text-white p-5 rounded-xl hover:bg-red-800 hover:cursor-pointer" type="button" value="Adicionar Material &#43;" onclick="adicionarMaterial()">
        <div id="form" class="py-10" style="display: none;">
            <form method="post" class="flex flex-col" action="src/inserirMaterial.php">
                <h1 class="font-bold text-2xl">Adicione seu Material</h1>
                <label for="titulo">Título</label>
                <input type="text" class="border border-black" name="titulo" id="titulo" required>
                <label for="desc">Descrição</label>
                <input type="text" class="border border-black" name="desc" id="desc">
                <label for="titulo">Arquivo(link)</label>
                <input type="file" name="arquivo" id="arquivo">
                <input type="submit" class="bg-red-700 mt-3 w-1/6 text-white p-5 rounded-xl hover:bg-red-800 hover:cursor-pointer" value="Adicionar" onclick="refresh()">
            </form>
        </div>  
    </div>
    <div class="flex p-10 flex-wrap gap-12 justify-start">
        
        <?php            
            $sql = mysqli_query($banco, "select * from materiais");
            $linha = mysqli_num_rows($sql);  

            for($i=0;$i<$linha;$i++) {
                $registro = mysqli_fetch_row($sql);
               
                $registro[0] ?: $registro[0] = 'Não há informações';
                $registro[1] ?: $registro[1] = 'Não há informações';
                $registro[2] ?: $registro[2] = 'Não há informações';
                $registro[3] ?: $registro[3] = 'Não há informações';
                $registro[4] ?: $registro[4] = 'Não há informações';

                    echo "<div class='flex flex-col gap-3 bg-red-700 text-white w-1/4 p-5 rounded-2xl'>
                    <h2>Data de envio: $registro[2]</h2>
                    <h1 class='text-lg font-bold'>$registro[0]</h1>
                    <p class='text-sm'>Descrição: $registro[1]</p>
                    <a href='$registro[3]' class='underline'>Arquivo: $registro[3]</a>
                    <p class='text-sm'>Enviado por: $registro[4]</p>
                </div>  
                    ";
                
            }       
        ?>
</body>
</html>

<script>

    let form = document.getElementById("form")
    let btnAdd = document.getElementById("btnAdd")
    function adicionarMaterial() {
        btnAdd.style.display = "none"
        form.style.display = "block"
    
    }

    function refresh() {
        window.location.reload();
    }
</script>