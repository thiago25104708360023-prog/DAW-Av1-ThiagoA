<?php
$arquivo_perguntas = 'perguntas.txt';
$arquivo_usuarios = 'usuarios.txt';

function lerPerguntas() {
    global $arquivo_perguntas;
    if (!file_exists($arquivo_perguntas)) return [];
    $linhas = file($arquivo_perguntas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $dados = [];
    foreach ($linhas as $linha) {
        $dados[] = explode('|', $linha);
    }
    return $dados;
}

function salvarPerguntas($perguntas) {
    global $arquivo_perguntas;
    $conteudo = "";
    foreach ($perguntas as $p) {
        $conteudo .= implode('|', $p) . PHP_EOL;
    }
    file_put_contents($arquivo_perguntas, $conteudo);
}
?>
