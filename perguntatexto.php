<?php
require_once 'config.php';

$id = $_GET['editar'] ?? null;
$perguntas = lerPerguntas();
$editando = ($id !== null) ? $perguntas[$id] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = str_replace('|', '-', $_POST['titulo']);
    $resposta = str_replace('|', '-', $_POST['resposta_texto']);
    $nova_pergunta = [$titulo, 'texto', $resposta];

    if ($id !== null) {
        $perguntas[$id] = $nova_pergunta;
    } else {
        $perguntas[] = $nova_pergunta;
    }
    
    salvarPerguntas($perguntas);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Pergunta de Texto</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        form { background: white; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        input { width: 100%; margin: 10px 0; padding: 8px; }
        .btn-save { background: #007bff; color: white; border: none; cursor: pointer; padding: 10px; }
    </style>
</head>
<body>
    <h2><?php echo $editando ? "Editar" : "Criar"; ?> Pergunta de Texto</h2>
    <form method="POST">
        <label>Pergunta/Situação:</label>
        <input type="text" name="titulo" value="<?php echo $editando[0] ?? ''; ?>" required>
        
        <label>Resposta Correta Sugerida:</label>
        <input type="text" name="resposta_texto" value="<?php echo $editando[2] ?? ''; ?>" required>
        
        <button type="submit" class="btn-save">Salvar Pergunta</button>
        <a href="index.php">Voltar</a>
    </form>
</body>
</html>

