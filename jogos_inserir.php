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
        
    }

}

require('carregar_twig.php');

echo $twig->render('jogos_inserir.html' , [
    'erro' => $erro,
]);