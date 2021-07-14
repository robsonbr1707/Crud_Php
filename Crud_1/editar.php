<?php 
    include ('layout/header.php');
    require_once ('conexao.php');

        $registro = new Registros();

        if(isset($_GET['id'])):
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $select = $pdo->prepare("SELECT * FROM registros WHERE id = :id");
            $select->bindParam('id',$id);
            $select->execute();
                $registro->atualizar();
        endif;
?>
    <?php foreach ($select as $value){ ?>

        <h2 class="titulo">Tela De Edição</h2>
            
        <div style="text-align:center;">
            <img style=" max-width:150px;" src="imagens/<?php echo $value['imagens'] ?>" >
        </div>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="form">
    <div class="caixa_form">
           
    <div class="inputs_right">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" placeholder="Ex: The Witcher, O Resgate..."value="<?php echo $value['titulo']; ?> ">
    </div>

    <div class="inputs_right">
        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" placeholder="Ex: Netflix, Disney..."value="<?php echo $value['plataforma']; ?> ">
    </div>
            
        <h2 class="titulo">Gêneros</h2>

        <div class="inputs_center">
            <input type="checkbox" name="generos[]" value="Desenho">
            <label for="Desenho">Desenho</label>

            <input type="checkbox" name="generos[]" value="Série">
            <label for="Série">Série</label>

            <input type="checkbox" name="generos[]" value="Filme">
            <label for="Filme">Filme</label>
        </div>

    <div class="caixa_checkbox">
        <div class="inputs_right">
            <label for="Ação">Ação</label>
            <input type="checkbox" name="generos[]" value="Ação">
        </div>

        <div class="inputs_right">
            <label for="Aventura">Aventura</label>
            <input type="checkbox" name="generos[]" value="Aventura">
        </div>

        <div class="inputs_right">
            <label for="Comédia">Comédia</label>
            <input type="checkbox" name="generos[]" value="Comédia">
        </div>

        <div class="inputs_right">
            <label for="Fantasia">Fantasia</label>
            <input type="checkbox" name="generos[]" value="Fantasia">
        </div>

        <div class="inputs_right">
            <label for="Tiro">Tiro</label>
            <input type="checkbox" name="generos[]" value="Tiro">
        </div> 
    </div>

        <input type="file" name="imagens" >

        <input type="submit" name="atualizar" value="Atualizar">
    </div>
    </form>

<?php } include ('layout/footer.php'); ?>