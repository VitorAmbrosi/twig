<?php

require('carregar_pdo.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = (int) $_POST["id"] ?? false;
    $nome = (string) $_POST["nome"] ?? false;
    $estilo = (string) $_POST["estilo"] ?? false;
    $capa = (string) $_POST["capa"] ?? false;

    move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

    if ($id) {
        $editar = $pdo->prepare('UPDATE jogos SET nome = :nome, estilo = :estilo, capa = :capa WHERE id = :id');
        $editar->bindParam(':id', $id);
        $editar->bindParam(':nome', $nome);
        $editar->bindParam(':estilo', $estilo);
        $editar->bindParam(':capa', $capa);
        $editar->execute();
    }
    header('location:jogos.php');
    die;
}

require('carregar_twig.php');

$id = (int) $_GET["id"] ?? false;

$dados = $pdo->prepare('SELECT * FROM jogos WHERE id = :id');
$dados->execute([':id' => $id]);

if ($dados->rowCount() != 1) {
    header('location:jogos.php');
    die;
}

$jogo = $dados->fetch(PDO::FETCH_ASSOC);

echo $twig->render('jogos_editar.html', [
    'jogo' => $jogo,
]);