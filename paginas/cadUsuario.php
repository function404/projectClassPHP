<?php
    include "../include/MySql.php";

    $email = $senha = $nome = $telefone = $administrador = "";
    $emailErr = $senhaErr = $nomeErr = $telefoneErr = $msgErr = "";

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cadastro'])){
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

        //Inserir no banco de dados
          $sql = $pdo->prepare('SELECT * FROM usuario WHERE email = ?');
          if($sql->execute(array($email))){
            if($sql->rowCount() > 0){
                echo 'Email ja cadastrado';
            }else {
                $sql = $pdo->prepare("INSERT INTO USUARIO (codigo, nome, email, senha, telefone, administrador)
                                    VALUES (null, ?, ?, ?, ?, ?)");
                if ($sql->execute(array($nome, $email, $senha, $telefone, $administrador))){
                $msgErr = "Dados cadastrados com sucesso!";
                header("location: login.php");  
                } else {
                $msgErr = "Dados não cadastrados!";
                };
            };
          };                    

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de usuario</title>
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
                <li><a href="../paginas/login.php">Login</a></li>
            </ul>
        </div>
    </nav>    

<form action="" method="POST">
<h1 class="titulo-txt">Cadastro de usuarios</h1>
    <fieldset>
        <div class="div-form">
            <input class="input-login" type="email" name="email" placeholder="Email" value="<?php echo $email?>">
            <span class="obrigatorio">* <?php echo $emailErr ?></span>
        </div>
        
        <div class="div-form">
            <input class="input-login" type="text" name="nome" placeholder="Nome" value="<?php echo $nome?>">
         <span class="obrigatorio">* <?php echo $nomeErr ?></span>
        </div>
        
        <div class="div-form">
            <input class="input-login" type="text" name="telefone" placeholder="Telefone" value="<?php echo $telefone?>">
            <span class="obrigatorio">* <?php echo $telefoneErr ?></span>
        </div>
        
        <div class="div-form">
            <input class="input-login" type="password" name="senha" placeholder="Senha" value="<?php echo $senha?>">
            <span class="obrigatorio">* <?php echo $senhaErr ?></span>
        </div>
        
        <div class="div-form">
            <input type="checkbox" name="administrador" id="administrador">
            <label for="administrador">Administrador</label>
        </div>
        <br>
        <div>
            <input class="button-form" type="submit" value="Salvar" name="cadastro">
            <span class="obrigatorio"><?php echo $msgErr ?></span>
        </div>

        <div class="div-form">
                <a class="button-log" href="login.php">Já tem uma conta? Logue-se aqui!</a>
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
    </body>
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
</html>
