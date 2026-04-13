<?php
require_once 'config.php';

if (isset($_GET['excluir'])) {
    $perguntas = lerPerguntas();
    unset($perguntas[$_GET['excluir']]);
    salvarPerguntas($perguntas);
    header("Location: index.php");
    exit;
}

$perguntas = lerPerguntas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Water Falls</title>
    <style>
        body { font-family: Arial; margin: 30px; background: #f0f2f5; }
        .menu { margin-bottom: 20px; padding: 15px; background: white; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; }
        .btn-add { background: #28a745; }
        .btn-edit { background: #007bff; }
        .btn-del { background: #dc3545; }
    </style>
</head>
<body>
    <h1>Sistema de Treinamento Corporativo</h1>
    
    <div class="menu">
        <strong>Novo Desafio:</strong>
        <a href="multipla_escolha.php" class="btn btn-add">+ Múltipla Escolha</a>
        <a href="pergunta_texto.php" class="btn btn-add">+ Resposta de Texto</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Pergunta</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($perguntas as $id => $p): ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $p[0]; ?></td>
            <td><?php echo ($p[1] == 'multipla') ? 'Múltipla Escolha' : 'Texto'; ?></td>
            <td>
                <a href="<?php echo ($p[1] == 'multipla' ? 'multipla_escolha.php' : 'pergunta_texto.php'); ?>?editar=<?php echo $id; ?>" class="btn btn-edit">Editar</a>
                <a href="index.php?excluir=<?php echo $id; ?>" class="btn btn-del" onclick="return confirm('Deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
