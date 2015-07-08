<?php

//echo '<pre>';
//var_dump($_POST);


$con = new mysqli('127.0.0.1', 'root', '', 'cervejas'); //abre conexão com o banco de dados

//cria comando SQL para inserir os dados na tabela
$sql = $con->prepare('
INSERT INTO cervejas (
  marca,
  ml,
  valor
) VALUES (?,?,?)');

$valor = str_replace(',', '.', $_POST['valor']); //como o preço no brasil usa vírgula, substitui virgula por ponto, usando a função str_replace, para o banco aceitar (como double)

$sql->bind_param('sid', $_POST['cerveja'], $_POST['ml'], $valor); //substitui as ? na SQL pelos valores informados, tratando eles conforme o tipo de dado do banco de dados (sid = string, inteiro, double)

if (!$sql->execute()) { //testa se a execução da SQL teve sucesso
    dd($sql->error); //se deu erro, mostra o erro na tela
}

header('location:novascervejas.php'); //se deu tudo certo, redireciona para o arquivo  novascervejass.php
