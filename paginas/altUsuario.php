<?php
    include "../include/MySql.php";
    include "../include/functions.php";

    $email = $senha = $nome = $telefone = $administrador = "";
    $emailErr = $senhaErr = $nomeErr = $telefoneErr = $msgErr = "";


    if (isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        $sql = $pdo->prepare('SELECT * FROM usuario WHERE codigo = ?');
        if ($sql->execute(array($codigo))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($info as $key => $value){
                $codigo = $value['codigo'];
                $nome = $value['nome'];
                $email = $value['email'];
                $telefone = $value['telefone'];
                $senha = $value['senha'];
                $administrador = $value['administrador'];
            };
        };
    };


    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
        if (isset($_POST['codigo'])){
            $codigo = $_POST['codigo'];
        }
        
        if (empty($_POST['email'])){
            $emailErr = "Email é obrigatório!";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST['senha'])){
            $senhaErr = "Senha é obrigatório!";
        } else {
            $senha = test_input($_POST["senha"]);
        }
        if (empty($_POST['nome'])){
            $nomeErr = "Nome é obrigatório!";
        } else {
            $nome = test_input($_POST["nome"]);
        }
        if (empty($_POST['telefone'])){
            $telefoneErr = "Telefone é obrigatório!";
        } else {
            $telefone = test_input($_POST["telefone"]);
        }
        if (empty($_POST['administrador'])){
            $administrador = false;
        } else {
            $administrador = true;
        }


        if($email && $nome && $senha && $telefone){
            $sql = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ? AND codigo <> ?");
            if($sql->execute(array($email, $codigo))){
                if ($sql->rowCount() > 0){
                    $msgErr = "Email ja cadastrado para outro usuario.";
                } else{
                    $sql = $pdo->prepare("UPDATE usuario SET nome=?, 
                                                            email=?,
                                                            senha=?, 
                                                            telefone=?, 
                                                            administrador=? WHERE codigo=?");
                    if ($sql->execute(array($nome, $email, $senha, $telefone, $administrador, $codigo))){
                        $msgErr = "dados alterados com sucesso!";
                        header('location: listUsuario.php');
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
    <meta charset="UTF-8">
    <title>Alterações de Usuarios</title>
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
            <li><a href="../paginas/listusuario.php">Voltar</a></li>
            </ul>
        </div>
    </nav>

<form action="" method="POST">

<h1 class="titulo-txt">Alterações do usuario</h1>
    <fieldset>
        <div>
            <label class="codigo" for="codigo"><p> Codigo: <?php echo $codigo?> </p></label>
            <br>
        </div>

        <div class="div-form">
            <label for="email"><p class="txt-alt"> Email: </p></label>
            <input class="input-login" type="mail" name="email" value="<?php echo $email?>">
            <span class="obrigatorio">* <?php echo $emailErr ?></span>
        </div>
        
        <div class="div-form">
            <label for="nome"><p class="txt-alt"> Nome: </p></label>
            <input class="input-login" type="text" name="nome" value="<?php echo $nome?>">
         <span class="obrigatorio">* <?php echo $nomeErr ?></span>
        </div>
        
        <div class="div-form">
            <label for="telefone"><p class="txt-alt"> Fone: </p></label>
            <input class="input-login" type="text" name="telefone" value="<?php echo $telefone?>">
            <span class="obrigatorio">* <?php echo $telefoneErr ?></span>
        </div>
        
        <div class="div-form">
            <label for="senha"><p class="txt-alt"> Senha: </p></label>
            <input class="input-login" type="password" name="senha" value="<?php echo $senha?>">
            <span class="obrigatorio">* <?php echo $senhaErr ?></span>
        </div>
        
        <div class="div-form">
            <input class="input-login" type="checkbox" name="administrador" <?php if($administrador==1){?> checked="check"<?php } ?>>
            <label for="administrador"><p class="txt-alt"> Administrador</p></label>
        </div>
        <br>
        <div>
            <input class="button-form" type="submit" value="Salvar" name="cadastro">
            <span class="obrigatorio"><?php echo $msgErr ?></span>
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
    })

        //admin
        document.getElementById('administrador').onclick = function(){
        const administrador = prompt('Insira a famosa senha')

        if (administrador === null){
            document.getElementById('administrador').setAttribute('disabled', 'disabled');
        };

        if (administrador.toLowerCase() == 'a famosa senha') {
            document.getElementById('administrador').removeAttribute('disabled');
        } else {
            document.getElementById('administrador').setAttribute('disabled', 'disabled');        
        };
    };
    </script>
    </body>
</html>