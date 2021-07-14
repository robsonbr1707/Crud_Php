<?php 
    require_once ('conexao.php');
    include ('layout/header.php');
    $registro = new Registros();
    $registro->inserir();
    $registro->excluir();
        if(!isset($_GET['pesquisa'])):
            $busca = $pdo->prepare("SELECT * FROM registros");
            $busca->execute();
        else:
            $pesquisa = "%".trim($_GET['pesquisa'])."%";
            $busca = $pdo->prepare("SELECT * FROM registros WHERE titulo LIKE :titulo ORDER BY titulo");
            $busca->bindParam(':titulo',$pesquisa);
            $busca->execute();
        endif;

        if($busca->rowCount() == 0):
            echo "<div class='text_center'> <p style='color:black;'> Nenhum registro Encontrado </p> </div>";
        endif;
?>
<form action="index.php" method="get" id="form_busca">
    <label for="pesquisa"><img src="imagens/icones/busca.png"></label>
    <input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquise pelo nome do registro">
    <input type="submit" value="Enviar">
</form>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Plataforma</th>
                <th>Gênero</th>
                <th></th>
            </tr>
        </thead>
<?php foreach ($busca as $value) { ?>
        <tbody>
            <tr>
                <td> <img src="imagens/<?php echo $value['imagens']; ?>" > </td>
                <td> <?php echo ucwords($value['titulo']); ?>  </td>
                <td> <?php echo ucwords($value['plataforma']); ?> </td>
                <td> <?php echo $value['generos'] ?> </td>

                <td class="td_links">
                   <a href="editar.php?id=<?php echo $value['id']; ?>"><button class="botao_editar"> Editar </button> </a>
                   <a href="index.php?id=<?php echo $value['id']; ?>"><button class="botao_excluir">  Deletar </button> </a> 
                </td>
            </tr>
            
        </tbody>
        
<?php } ?>

    </table>
<?php include ('layout/footer.php'); ?>