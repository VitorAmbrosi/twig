<?php

$erro = false;

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Preparar os dados para inserir no banco de dados
    $nome = $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;


    // verifica erro
    if (!$nome || !$estilo) {
        $erro = '☢️ PREENCHA TODOS OS CAMPOS!!!';
    } else {
        //Tudo certo, grava dados
        $ext = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);
        $capa = uniqid().'.'.$ext;

        // echo $capa; die;

        // print_r($_FILES); die;

        move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");
        

        require('carregar_pdo.php');
        $dados = $pdo->prepare('INSERT INTO jogos (nome, estilo, capa) VALUES (?,?,?)');

        $dados->bindParam(1, $nome);
        $dados->bindParam(2, $estilo);
        $dados->bindParam(3, $capa);

        $dados->execute();

        header('location:jogos.php');
        die;
    }

}

require('carregar_twig.php');

echo $twig->render('jogos_inserir.html' , [
    'erro' => $erro,
]);