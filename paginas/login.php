<?php
    include "../include/MySql.php";
    include "../include/functions.php";

    session_start();
    $_SESSION['nome'] = "";
    $_SESSION['adminitrador'] = ""; 

    $email = $senha = "";
    $emailErr = $senhaErr = "";


    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (empty($_POST['email'])){
            $emailErr = "Email é obrigatório!";
        } else {
            $email = test_input($_POST["email"]);
        }

        if (empty($_POST['senha'])){
            $senhaErr = "Senha é obrigatória!";
        } else {
            $senha = test_input($_POST['senha']);
        }

        // Codigo para consultar os dados no Banco de Dados
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = $pdo->prepare("SELECT * FROM usuario 
                              WHERE email = ? AND senha = ?");
        if($sql->execute(array($email,$senha))){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($info) > 0) {
                foreach($info as $key => $values){
                    $_SESSION['nome'] = $values['nome'];
                    $_SESSION['administrador'] = $values['administrador'];

                }
                header('location:principal.php');
            } else {
                echo '<h6>Email de usuario não cadastrado</h6>';
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <nav class="navbar">
        <div class="brand-title">
            <i href="../paginas/login.php" class="fa-solid fa-meteor"></i>
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

    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h1 class="titulo-txt">Login</h1>
            <fieldset>
                <div class="div-form">
                    <label for="email"></label>
                    <input class="input-login" type="text" name="email" placeholder="Email" value=<?php echo $email?>>
                    <span class="obrigatorio">* <?php echo $emailErr ?></span>
                </div>

                <div class="div-form">
                    <label for="senha"></label>
                    <input class="input-login" type="password" name="senha" placeholder="Senha" value=<?php echo $senha?>>
                    <span class="obrigatorio">* <?php echo $senhaErr ?></span>
                </div>

                <div class="div-form">        
                    <input class="button-form" type="submit" value="Entrar">
                </div>

                <div class="div-form">
                    <a class="button-log" href="../paginas/cadUsuario.php">Cadastre-se aqui!</a>
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
