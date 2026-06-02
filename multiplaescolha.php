<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Múltipla Escolha</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        form { background: white; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        input, textarea { width: 100%; margin: 10px 0; padding: 8px; box-sizing: border-box; }
        .btn-save { background: #28a745; color: white; border: none; cursor: pointer; padding: 10px; width: 100%; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2 id="titulo-pagina">Criar Pergunta de Múltipla Escolha</h2>
    <form id="form-pergunta">
        <input type="hidden" id="id-pergunta">
        
        <label>Enunciado da Situação:</label>
        <input type="text" id="titulo" required>
        
        <label>Alternativas (separe por ponto e vírgula ";"):</label>
        <textarea id="alternativas" rows="4" required></textarea>
        
        <button type="submit" class="btn-save">Salvar Desafio</button>
        <a href="index.php">Voltar</a>
    </form>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const idEdit = urlParams.get('editar');

        if (idEdit !== null) {
            document.getElementById('titulo-pagina').innerText = "Editar Pergunta de Múltipla Escolha";
            fetch(`api.php?id=${idEdit}`)
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        document.getElementById('id-pergunta').value = idEdit;
                        document.getElementById('titulo').value = data[0];
                        document.getElementById('alternativas').value = data[2];
                    }
                });
        }

        document.getElementById('form-pergunta').addEventListener('submit', async function(e) {
            e.preventDefault(); 

            const dados = {
                id: document.getElementById('id-pergunta').value,
                titulo: document.getElementById('titulo').value,
                tipo: 'multipla',
                resposta: document.getElementById('alternativas').value
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
