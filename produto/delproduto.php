<?php
    include '../include/MySql.php';

    if(isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
    
        $sql = $pdo->prepare("DELETE FROM produto WHERE codigo=?");
        if ($sql->execute(array($codigo))){
            echo 'Produto excluido com sucesso.';
            header('location:listproduto.php');
        } else{
            echo 'Erro: dados não foram excluidos';
            echo 'comando: $sql';
        }

    }

?>