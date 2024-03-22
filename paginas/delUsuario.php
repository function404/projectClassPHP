<?php
    include '../include/MySql.php';

    if(isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
    
        $sql = $pdo->prepare("DELETE FROM usuario WHERE codigo=?");
        if ($sql->execute(array($codigo))){
            echo 'Usuario excluido com sucesso.';
            header('location:listUsuario.php');
        } else{
            echo 'Erro: dados não froam excluidos';
            echo 'comando: $sql';
        }

    }

?>