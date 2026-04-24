<?php

require('carregar_twig.php');
require('carregar_pdo.php');

use Carbon\Carbon;

$jogos = $pdo->query('SELECT * FROM jogos');
$todosJogos = $jogos->fetchAll(PDO::FETCH_ASSOC);
// print_r($todosJogos);  die;

foreach($todosJogos as &$jogo) {  
// & na frente da variável -> pega a variável $jogo que está fora do foreach e a altera, ao invés de criar uma nova variável dentro do foreach
    $jogo['lancamento'] = Carbon::parse($jogo['lancamento']) -> locale('pt_BR') -> isoFormat('LL');
}



$hoje = Carbon::now();
$proximaSexta = Carbon::now()->next('Friday');
$vinteDias = Carbon::now()->addDays(20);

echo $twig->render('jogos.html', [
    'jogos' => $todosJogos,
    'hoje' => $hoje,
    'proximaSexta' => $proximaSexta,
    'vinteDias' => $vinteDias,
]);