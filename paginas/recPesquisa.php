<?php
    $site = filter_input(INPUT_GET, 'site');
    $secao = filter_input(INPUT_GET, 'secao');
    $outra = filter_input(INPUT_GET, 'outra');
    $comentario = filter_input(INPUT_GET, 'comentario');
    $nome = filter_input(INPUT_GET, 'nome');
    $email = filter_input(INPUT_GET, 'email');
    $fone = filter_input(INPUT_GET, 'fone');
    $novidades = filter_input(INPUT_GET, 'novidades');

    echo $site."<br>";
    
    echo $comentario."<br>";
    echo $nome."<br>";
    echo $email."<br>";
    echo $fone."<br>";
    echo $novidades."<br>";

    if ($secao){
        echo $secao."<br>";
    } else {
        echo $outra."<br>";
    }
    
    if ($novidades){
        echo "<br>Quero receber as novidades do site por email";
    } else {
        echo "<br>NÃO quero receber as novidades do site por email";
    }

?>