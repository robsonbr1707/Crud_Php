<?php

    class Registros {

        public function __construct()
        {
                #Conexao Com O Banco;;
            global $pdo;
            $banco = 'crud_1';
            $localhost = 'localhost';
            $user = 'root';
            $senha = '';
        
            try{
                $pdo = new PDO("mysql:dbname=".$banco.";host=".$localhost,$user,$senha, array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            }catch(PDOException $e){
                echo 'Erro com banco de dados erro :'.$e->getMessage();
            }
        }

        public function verificar()
        {
            #Verificar Se OS Campos Estão Vazios;;
            if(empty(trim($_POST['titulo'])) || empty(trim($_POST['plataforma'])) || empty($_POST['generos'])):
                die("<p class='text_center'>Preencha Todos Os Campos</p>");
            endif;
                        #Verificar Imagem;;
                if(isset($_FILES['imagens'])): 
                    $imagem = $_FILES['imagens']['name'];                   
                    $arquivo = pathinfo($_FILES['imagens']['name'], PATHINFO_EXTENSION);
                    $tipos = ['jpg','jpeg','png'];

                        if(!in_array($arquivo, $tipos )):
                            die("<p class='text_center'>Arquivo Não Suportado, Ou Não Preenchido</p>");
                        endif;
                    move_uploaded_file($_FILES['imagens']['tmp_name'],'imagens/'.$imagem);
                endif;
        }        

        public function inserir()
        {
            global $pdo;

            if(isset($_POST['registrar'])):

                $this->verificar(); 

                    #Inserir Os Registros;;
                $titulo = addslashes($_POST['titulo']);
                $plataforma = addslashes($_POST['plataforma']);
                $generos = $_POST['generos'];
                $generos_new = implode(',',$generos);
                $imagem = $_FILES['imagens']['name'];                   

                $insert = $pdo->prepare("INSERT INTO registros (titulo,plataforma,generos,imagens)VALUES(:titulo,:plataforma,:generos,:imagens)");
                $insert->bindParam(':titulo',$titulo);
                $insert->bindParam(':plataforma',$plataforma);
                $insert->bindParam(':generos',$generos_new);
                $insert->bindParam(':imagens',$imagem);
                $insert->execute();

                    if ($insert->rowCount() > 0):
                        echo "<div class='text_center sucesso'> <p> Registro Feito Com Sucesso!! </p> </div>";
                    endif;
            endif;
        }

        public function atualizar()
        {
            global $pdo;

            if(isset($_POST['atualizar'])):

                $this->verificar();
                    #Atualizar Os Registros;;
                $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                $titulo = addslashes($_POST['titulo']);
                $plataforma = addslashes($_POST['plataforma']);
                $generos = $_POST['generos'];
                $generos_new = implode(',',$generos);
                $imagem = $_FILES['imagens']['name'];

                $atualizar = $pdo->prepare("UPDATE registros SET titulo = :t, plataforma = :p, generos = :g, imagens = :i WHERE id = :id");
                $atualizar->bindParam(':id',$id);
                $atualizar->bindParam(':t',$titulo);
                $atualizar->bindParam(':p',$plataforma);
                $atualizar->bindParam(':g',$generos_new);
                $atualizar->bindParam(':i',$imagem);
                $atualizar->execute();    

                if($atualizar->rowCount() == 1):
                  die ("<div class='text_center sucesso'> <p>Registro Atualizado Com Sucesso!!</p>"."<a href='index.php'>Voltar Ao Menu</a> </div>");
                endif;    
            endif;
        }

        public function excluir()
        {
            global $pdo;
                #Exlcuir Registros;;
            if(isset($_GET['id'])):
                $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
                $excluir = $pdo->prepare("DELETE FROM registros WHERE id = :id");
                $excluir->bindParam(':id',$id);
                $excluir->execute();
                    if($excluir->rowCount() > 0):
                        echo "<p class='text_center delete'>Registro Excluido Com Sucesso!</p>";
                    endif;
            endif;
        }
        
    }

?>
