<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Clientes</h1>
        
        <div class="actions">
            <a href="index.php?action=cadastrar" class="btn btn-primary">Novo Cliente</a>
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">Operação realizada com sucesso!</div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nome']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['telefone']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($c['data_cadastro'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum cliente cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>