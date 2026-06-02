<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Pergunta de Texto</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        form { background: white; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        input { width: 100%; margin: 10px 0; padding: 8px; box-sizing: border-box; }
        .btn-save { background: #007bff; color: white; border: none; cursor: pointer; padding: 10px; width: 100%; margin-bottom: 10px;}
    </style>
</head>
<body>
    <h2 id="titulo-pagina">Criar Pergunta de Texto</h2>
    <form id="form-pergunta">
        <input type="hidden" id="id-pergunta">
        
        <label>Pergunta/Situação:</label>
        <input type="text" id="titulo" required>
        
        <label>Resposta Correta Sugerida:</label>
        <input type="text" id="resposta_texto" required>
        
        <button type="submit" class="btn-save">Salvar Pergunta</button>
        <a href="index.php">Voltar</a>
    </form>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const idEdit = urlParams.get('editar');

        if (idEdit !== null) {
            document.getElementById('titulo-pagina').innerText = "Editar Pergunta de Texto";
            fetch(`api.php?id=${idEdit}`)
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        document.getElementById('id-pergunta').value = idEdit;
                        document.getElementById('titulo').value = data[0];
                        document.getElementById('resposta_texto').value = data[2];
                    }
                });
        }

        document.getElementById('form-pergunta').addEventListener('submit', async function(e) {
            e.preventDefault();

            const dados = {
                id: document.getElementById('id-pergunta').value,
                titulo: document.getElementById('titulo').value,
                tipo: 'texto',
                resposta: document.getElementById('resposta_texto').value
            };

            await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dados)
            });

            window.location.href = 'index.php';
        });
    </script>
</body>
</html>
