<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
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
                <li><?php if ($_SESSION['administrador']==1) echo "<a href='listUsuario.php'>Usuários</a>";  else echo "";?></a></li>
                <li><?php if ($_SESSION['administrador']==1) echo "<a href='../produto/cadproduto.php'>Produto</a>";  else echo "";?></a></li>
                <li><a href="logout.php"> Sair</a></li>
            </ul>
        </div>
    </nav>

    <div class="user">
        <img class="userr" src="../img/user-solid.svg" alt="err">
    </div>

    <h1 class="txt-prin">
        Olá seja bem-vindo(a) <?php echo $_SESSION['nome']?> <br>
        <?php if ($_SESSION['administrador']==1) echo "Você é administrador";  else echo "não tem permissão para acessar aos usuários!";?>
    </h1>
    <br>
    
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