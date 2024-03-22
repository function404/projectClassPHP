<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <title>Lista de Produtos</title>
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
                <li><a href="../produto/cadproduto.php"> Voltar</a></li>
            </ul>
        </div>
    </nav>

    <?php 
    include "../include/MySql.php";

    $sql = $pdo->prepare('SELECT * FROM produto');

    if($sql->execute()){
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $key => $i){
            echo '<div style="height: 50%;
                              width: 100%;
                              text-align: center;">';

            echo '<div style="padding: 30px;">';

            echo '=> id: '.$i['codigo'];
            echo '<br>';
            echo '=> nome: '.$i['nome'];
            echo '<br>';
            echo '=> descrição: '.$i['descricao'];
            echo '<br>';
            echo '=> valor: '.number_format($i['valor'], 2, ',', '.');
            echo '<br>';
            echo '=> imagem: <br>';
            echo '<img style="border: 2px solid red; border-radius: 5px;" width="300" src="data:image/jpg;charset=utf8;base64,'.base64_encode($i['imagem']).'"/>';
            
            echo '</div>';

            echo '<div class="btn-altdel">';
            
            echo '<div style="display: column; 
                              padding: 8px;
                              text-align: center;   "><a class="btn-listp" href="delproduto.php?codigo='.$i["codigo"].'">Detelar</a>';
            echo '</div>';
            echo '<div style="display: column; 
                              padding: 8px;
                              text-align: center;   "><a class="btn-listp" href="altproduto.php?codigo='.$i["codigo"].'">Alterar</a>';    
            echo '</div>';

            

            echo '</div>';
            echo '<hr>';
        };
    };

?>
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