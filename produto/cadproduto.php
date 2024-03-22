<?php 
    include "../include/functions.php";
    include "../include/MySql.php";


    $msgErr = "";
    $descricao = "";
    $nome = "";
    $valor = 0;


    if (isset($_POST["submit"])){
        if (!empty($_FILES["image"]["name"])){
            //PEGAR INFORMAÇÕES
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            //PERMITIR SOMENTE ALGUNS FORMATOS
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');

            if (in_array($fileType, $allowTypes)){
                $image = $_FILES['image']['tmp_name'];
                $imgContent = file_get_contents($image);

                if (isset($_POST['nome'])){
                    $nome = $_POST['nome'];
                } else {
                    $nome = "";
                };

                if (isset($_POST['descricao'])){
                    $descricao = $_POST['descricao'];
                } else {
                    $descricao = "";
                };

                if (isset($_POST['valor'])){
                    $valor = $_POST['valor'];
                } else {
                    $valor = "";
                };

                //GRAVAR NO BANCO
                $sql = $pdo->prepare("INSERT INTO produto (codigo, nome, descricao, valor, imagem) VALUES (null, ?,?,?,?)");
                if ($sql->execute(array($nome, $descricao, $valor, $imgContent))){
                    header('location:listproduto.php');
                } else {
                    $msgErr = "Dados não cadastrados!";
                }



            } else {
                $msgErr = "Desculpe, somente jpg, png, jpeg, gif são permitidas";
            };
        } else {
            $msgErr = "Selecione uma imagem para upload";
        };
    };


?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
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
                <li><a href="../paginas/principal.php"> Voltar</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <h1 class="titulo-txt">Cadastro de Produtos</h1>
            <fieldset>
                <div class="div-form">
                    <label for="nome"></label>
                    <input class="input-login" type="text" name="nome" placeholder="Nome" value=<?php echo $nome?>>
                    <span class="obrigatorio">*</span>
                </div>
                <div class="div-form">
                    <label for="descricao"></label>
                    <input class="input-login" type="text" name="descricao" placeholder="Descrição" value=<?php echo $descricao?>>
                    <span class="obrigatorio">*</span>
                </div>

                <div class="div-form">
                    <label for="valor"></label>
                    <input class="input-login" type="number" name="valor" placeholder="Valor" value=<?php echo $valor?>>
                    <span class="obrigatorio">*</span>
                </div>

                <div class="div-form">
                    <label class="label-image" for="img">Selecione uma imagem</label>
                    <input type="file" name="image" id='img'>
                    <span class="obrigatorio">*</span>
                </div>

                <div class="div-form">        
                    <input class="button-form" type="submit" value="Enviar" name='submit'>
                </div>

                <div class="div-form">        
                    <a class="button-log" href="../produto/listproduto.php">Ver lista de produtos</a>
                </div>
            </fieldset>
        </form>
    </div>    
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