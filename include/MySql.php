<?php
    define('HOST', 'localhost');
    define('DB', 'emi');
    define('USER', 'root');
    define('PASS', '');

    try{
        //conexao
        $pdo = new PDO('mysql:host='.HOST.';port=3306;dbname='.DB,
                       USER,
                       PASS,
                       array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
    } catch (Exception $e){
        echo 'Erro';
    }


?>