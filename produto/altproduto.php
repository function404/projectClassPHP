<?php
    include "../include/MySql.php";
    include "../include/functions.php";

    $nome = $descricao = $valor = $codigo = "";
    $nomeErr = $descricaoErr = $valorErr = "";


    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        $sql = $pdo->prepare('SELECT * FROM produto WHERE codigo = ?');
        if ($sql->execute(array($codigo))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $codigo = $value['codigo'];
                $nome = $value['nome'];
                $valor = $value['valor'];
                $descricao = $value['descricao'];
            };
        };
    };


    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
        }
        
        if (empty($_POST['nome'])){
            $nomeErr = "nome é obrigatório!";
        } else {
            $nome = test_input($_POST["nome"]);
        }
        if (empty($_POST['descricao'])){
            $descricaoErr = "descricao é obrigatório!";
        } else {
            $descricao = test_input($_POST["descricao"]);
        }
        if (empty($_POST['valor'])){
            $valorErr = "valor é obrigatório!";
        } else {
            $valor = test_input($_POST["valor"]);
        }


        if($nome && $descricao && $valor){
            $sql = $pdo->prepare("SELECT * FROM produto WHERE nome = ? AND codigo <> ?");
            if($sql->execute(array($nome, $codigo))){
                if ($sql->rowCount() > 0){
                    $msgErr = "nome ja cadastrado para outro produto.";
                } else{
                    $sql = $pdo->prepare("UPDATE produto SET nome=?, 
                                                            descricao=?,
                                                            valor=? WHERE codigo=?");
                    if ($sql->execute(array($nome, $descricao, $valor, $codigo))){
                        $msgErr = "dados alterados com sucesso!";
                        header('location: listproduto.php');
                    } else{
                        $msgErr = "dados não alterados";
                    }
                }
            }
        } else {
            $msgErr = "Dados não cadastrados!";
        };                   
    };
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<nav class="navbar">
        <div class="brand-title">
            <i class="fa-solid fa-meteor"></i>
        </div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="../paginas/principal.php">Voltar</a></li>
            </ul>
        </div>
    </nav>    

<form action="" method="POST">

<h1 class="titulo-txt">Alterações do produto</h1>
    <fieldset>
        <div>
            <label class="codigo" for="codigo"><p> Codigo: <?php echo $codigo?> </p></label>
            <br>
        </div>

        <div class="div-form">
            <label for="nome"><p class="txt-alt"> nome: </p></label>
            <input class="input-login" type="mail" name="nome" value="<?php echo $nome?>">
            <span class="obrigatorio">* <?php echo $nomeErr ?></span>
        </div>
        
        <div class="div-form">
            <label for="descricao"><p class="txt-alt"> descricao: </p></label>
            <input class="input-login" type="text" name="descricao" value="<?php echo $descricao?>">
         <span class="obrigatorio">* <?php echo $descricaoErr ?></span>
        </div>
        
        <div class="div-form">
            <label for="valor"><p class="txt-alt"> Valor: </p></label>
            <input class="input-login" type="text" name="valor" value="<?php echo $valor?>">
            <span class="obrigatorio">* <?php echo $valorErr ?></span>
        </div>
        
        <div>
            <input class="button-form" type="submit" value="Salvar" name="cadastro">
            <span class="obrigatorio"></span>
        </div>
    </fieldset>        
</form>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-info logo">
                <a href="#">
                    <i class="fa-solid fa-meteor"></i>
                </a>
            </div>
            <div class="footer-info">
                <a target="_blank" href="https://www.facebook.com"><i class="fa-brands fa-facebook"></i></a>
                <a target="_blank" href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a>
                <a target="_blank" href="https://www.youtube.com"><i class="fa-brands fa-youtube"></i></a>
                <a target="_blank" href="https://www.twitter.com"><i class="fa-brands fa-twitter"></i></a>
            </div>
            <div style="text-align: center;" class="footer-info">
                <p style="margin-top: 5px;">Developer website - <a target="_blank" href="https://github.com/function404">@function</a> (Lincoln) </p>
            </div>
            <div style="text-align: center;" class="footer-info">
                <p style="margin-top: 5px;">Email de contato - <i><a href="mailto:lincolnnovais15a@gmail.com">lincolnnovais15a@gmail.com</a></i></p>
            </div>
        </div>
    </footer>
    <script>
        const toggleButton = document.getElementsByClassName('toggle-button')[0]
        const navbarLinks = document.getElementsByClassName('navbar-links')[0]

        toggleButton.addEventListener('click', () => {
        navbarLinks.classList.toggle('active')
    });
    </script>
    </body>
</html>