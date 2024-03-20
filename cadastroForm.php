<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #5DD9BC;
        }

        #botao-compra {
            background-color: #DC2D00;
        }
    </style>
</head>
<?php
// Importe a classe de conexão
require_once 'Conexao.php';

// Verifica se foi submetido um formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $ticker = $_POST['ticker'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];
    $data = $_POST['data'];
    
    // Valida os dados do formulário
    if (empty($nome) || empty($ticker) || empty($valor) || empty($quantidade) || empty($data)) {
        echo 'Todos os campos são obrigatórios.';
    } else {
        // Criar uma instância da classe Conexao
        $conexao = new Conexao('localhost', '3306', 'investimentos', 'root', '');

        // Verificar se a conexão foi bem-sucedida
        if ($conexao->conectar()) {
            // Inserir dados no banco de dados
            if ($conexao->inserir($nome, $ticker, $valor, $quantidade, $data)) {
                echo "Dados inseridos com sucesso!";
            } else {
                echo "Falha ao inserir dados.";
            }
        } else {
            echo "Falha na conexão!";
        }
    }
}
?>
<body>
    <div class="container">
        <form role="form" class="mt-5" method="POST" action="cadastroForm.php">
            <div class="form-group row">
                <label for="inputNome" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNome" name="nome" placeholder="Nome" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputTicker" class="col-sm-2 col-form-label">Ticker</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTicker" name="ticker" placeholder="Ticker" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputValor" class="col-sm-2 col-form-label">Valor</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputValor" name="valor" placeholder="Valor R$" required step="any" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputQuantidade" class="col-sm-2 col-form-label">Quantidade de cotas</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputQuantidade" name="quantidade" placeholder="Quantidade de cotas" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputData" class="col-sm-2 col-form-label">Data da compra</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="inputData" name="data" placeholder="Data da compra" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <input type="submit" value="Cadastrar Compra" name="submit" class="btn btn-primary" id="botao-compra"/>
                </div>
            </div>
        </form>
    </div>
</body>