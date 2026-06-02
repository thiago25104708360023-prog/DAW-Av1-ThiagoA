<?php
require_once 'config.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$perguntas = lerPerguntas();

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        echo json_encode($perguntas[$_GET['id']] ?? null);
    } else {
        echo json_encode($perguntas);
    }
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $id = isset($data['id']) && $data['id'] !== '' ? $data['id'] : null;
    $titulo = str_replace('|', '-', $data['titulo']);
    $tipo = $data['tipo'];
    $resposta = str_replace('|', '-', $data['resposta']);

    $nova_pergunta = [$titulo, $tipo, $resposta];

    if ($id !== null) {
        $perguntas[$id] = $nova_pergunta;
    } else {
        $perguntas[] = $nova_pergunta;
    }
    
    salvarPerguntas($perguntas);
    echo json_encode(['success' => true]);
    exit;
}

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id !== null) {
        unset($perguntas[$id]);
        $perguntas = array_values($perguntas);
        salvarPerguntas($perguntas);
        echo json_encode(['success' => true]);
    }
    exit;
}
?>
