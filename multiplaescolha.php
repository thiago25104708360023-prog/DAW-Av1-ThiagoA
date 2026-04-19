<?php
require_once 'config.php';
$id = $_GET['editar'] ?? null;
$perguntas = lerPerguntas();
$editando = ($id !== null) ? $perguntas[$id] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = str_replace('|', '-', $_POST['titulo']);
    $respostas = str_replace('|', '-', $_POST['alternativas']); // Salva como string separada por vírgula ou traço
    $nova_pergunta = [$titulo, 'multipla', $respostas];

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
    <title>Gerenciar Múltipla Escolha</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        form { background: white; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        input, textarea { width: 100%; margin: 10px 0; padding: 8px; }
        .btn-save { background: #28a745; color: white; border: none; cursor: pointer; padding: 10px; }
    </style>
</head>
<body>
    <h2><?php echo $editando ? "Editar" : "Criar"; ?> Pergunta de Múltipla Escolha</h2>
    <form method="POST">
        <label>Enunciado da Situação:</label>
        <input type="text" name="titulo" value="<?php echo $editando[0] ?? ''; ?>" required>
        
        <label>Alternativas (separe por ponto e vírgula ";"):</label>
        <textarea name="alternativas" rows="4" required><?php echo $editando[2] ?? ''; ?></textarea>
        
        <button type="submit" class="btn-save">Salvar Desafio</button>
        <a href="index.php">Voltar</a>
    </form>
</body>
</html>
