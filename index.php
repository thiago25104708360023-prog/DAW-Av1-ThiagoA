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
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; margin-right: 5px; border: none; cursor: pointer; }
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
        <thead>
            <tr>
                <th>ID</th>
                <th>Pergunta</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabela-corpo">
            </tbody>
    </table>

    <script>
        async function carregarPerguntas() {
            const response = await fetch('api.php');
            const perguntas = await response.json();
            const tbody = document.getElementById('tabela-corpo');
            tbody.innerHTML = ''; 

            perguntas.forEach((p, id) => {
                const tipoTexto = p[1] === 'multipla' ? 'Múltipla Escolha' : 'Texto';
                const linkEditar = p[1] === 'multipla' ? 'multipla_escolha.php' : 'pergunta_texto.php';

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${id}</td>
                    <td>${p[0]}</td>
                    <td>${tipoTexto}</td>
                    <td>
                        <a href="${linkEditar}?editar=${id}" class="btn btn-edit">Editar</a>
                        <button onclick="excluirPergunta(${id})" class="btn btn-del">Excluir</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        async function excluirPergunta(id) {
            if (confirm('Deseja excluir?')) {
                await fetch(`api.php?id=${id}`, { method: 'DELETE' });
                carregarPerguntas(); 
            }
        }

        document.addEventListener('DOMContentLoaded', carregarPerguntas);
    </script>
</body>
</html>
