
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <title>Lista de Usuarios</title>
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
                <li><a href="../paginas/logout.php"> Sair</a></li>
            </ul>
        </div>
    </nav>    

    <div class="container">]
        <?php
            include '../include/MySql.php';

            $sql = $pdo->prepare("SELECT * FROM usuario");
            if ($sql->execute()){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);

                echo "<center>";
                echo "<table style='padding: 20px;' border='1'>";
                echo "<tr>";
                echo " <th class='tab' >Código</th>";
                echo " <th class='tab' >Nome</th>";
                echo " <th class='tab' >Email</th>";
                echo " <th class='tab' >Telefone</th>";
                echo " <th class='tab' >Senha</th>";
                echo " <th class='tab' >Administrador</th>";
                echo " <th class='tab' >Alterar</th>";
                echo " <th class='tab' >Excluir</th>";
                echo " </tr>";

                foreach($info as $key => $value){
                    echo "<tr>";
                    echo "<td class='tab' style='padding: 7px;'>  ".$value['codigo']."</td>";
                    echo "<td class='tab' style='padding: 7px;'>  ".$value['nome']."</td>";
                    echo "<td class='tab' style='padding: 7px;'>  ".$value['email']."</td>";
                    echo "<td class='tab' style='padding: 7px;'>  ".$value['telefone']."</td>";
                    echo "<td class='tab' style='padding: 7px;'>  ".$value['senha']."</td>";
                    echo "<td class='tab' style='padding: 7px;'> ".$value['administrador']."</td>";
                    echo "<td class='tab' style='padding: 7px;'><center><a style='text-decoration: none; color: green;' href='altUsuario.php?codigo=".$value['codigo']."'><i class='fa-solid fa-circle-up'></i></a></center></td>";
                    echo "<td class='tab' style='padding: 7px;'><center><a style='text-decoration: none; color: red;' href='delUsuario.php?codigo=".$value['codigo']."'><i class='fa-solid fa-circle-xmark'></i></a></center></td>";
                    echo "</tr>";
                    echo "</center>";
                }

                echo "</table>";
            };
        ?>
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