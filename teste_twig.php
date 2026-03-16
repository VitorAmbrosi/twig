<?php

require('carregar_twig.php');

$nome = 'Vitor';
$dicsciplinas = [
    'Programação','Matemática','Português','História',
];

echo $twig->render('teste_twig.html', [
    'nome' => $nome,
    'legal' => true,
    'disciplinas' => $dicsciplinas
]);


