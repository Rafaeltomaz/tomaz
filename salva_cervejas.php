<?php

var_dump($_POST);

$con = new mysqli('127.0.0.1', 'root', '', 'cervejas'); //abre conexão com o banco de dados

//cria comando SQL para inserir os dados na tabela
$sql = $con->prepare('
INSERT INTO product (
  marca,
  descrição,
  valor,
) VALUES (?,?,?)');


$nome = $_POST['nome']; //pega a variável nome que vem do POST (formulário) e grava na variável $name
$descrição = $_POST['descrição'];//pega a variável descrição que vem do POST (formulário) e grava na variável $description
$varlor = str_replace(',', '.', $_POST['price']); //como o preço no brasil usa vírgula, substitui virgula por ponto, usando a função str_replace, para o banco aceitar (como double)

$sql->bind_param('sid', $nome, $descrição, $varlor); //substitui as ? na SQL pelos valores informados, tratando eles conforme o tipo de dado do banco de dados (sid = string, inteiro, double)

if (!$sql->execute()) { //testa se a execução da SQL teve sucesso
    dd($sql->error); //se deu erro, mostra o erro na tela
}

header('location:novascervejass.php'); //se deu tudo certo, redireciona para o arquivo  novascervejass.php
