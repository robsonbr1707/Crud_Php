<?php include ('layout/header.php'); ?>
    <h2 class="titulo">Crie Um Desenho, Filme Ou Série</h2>
<form action="index.php" method="POST" enctype="multipart/form-data" class="form">

    <div class="inputs_right">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" placeholder="Ex: The Witcher, O Resgate..." required>
    </div>

    <div class="inputs_right">
        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" placeholder="Ex: Netflix, Disney..." required>
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
    <input type="file" name="imagens" required>

    <input type="submit" value="Enviar" name="registrar">

</form>

<?php include ('layout/footer.php'); ?>