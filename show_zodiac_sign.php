<?php
include('layouts/header.php'); // Inclui o cabeçalho com Bootstrap

// Recebe a data de nascimento do formulário
$data_nascimento = $_POST['data_nascimento'] ?? null;

if (!$data_nascimento) {
    echo "<div class='error-box'>
            <h2>Data não fornecida</h2>
            <p>Por favor, insira uma data de nascimento válida no formulário.</p>
          </div>";
    echo "<a href='index.php' class='btn btn-secondary btn-voltar'>Voltar</a>";
    exit;
}

// Carrega o arquivo XML
$signos = simplexml_load_file("signos.xml");

// Formata a data de nascimento para comparação
$dataNasc = DateTime::createFromFormat('Y-m-d', $data_nascimento);

// Inicializa a variável para armazenar o resultado
$resultadoSigno = null;

foreach ($signos->signo as $signo) {
    $dataInicio = DateTime::createFromFormat('d/m', $signo->dataInicio);
    $dataFim = DateTime::createFromFormat('d/m', $signo->dataFim);

    // Ajusta os anos para datas que cruzam o ano
    $dataInicio->setDate($dataNasc->format("Y"), $dataInicio->format("m"), $dataInicio->format("d"));
    $dataFim->setDate($dataNasc->format("Y"), $dataFim->format("m"), $dataFim->format("d"));

    // Caso o signo cruze o ano (ex: Capricórnio)
    if ($dataInicio > $dataFim) {
        // Ajusta para o próximo ano se necessário
        if ($dataNasc >= $dataInicio || $dataNasc <= $dataFim) {
            $resultadoSigno = $signo;
            break;
        }
    } else {
        // Caso normal: data de nascimento dentro do intervalo
        if ($dataNasc >= $dataInicio && $dataNasc <= $dataFim) {
            $resultadoSigno = $signo;
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php include('layouts/header.php'); ?>
    <title>Resultado do Signo</title>
    <style>
        .signo-box {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .signo-box h2 {
            font-family: 'Cursive', serif;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .signo-box img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }
        .signo-box p {
            font-size: 1.2rem;
            line-height: 1.6;
        }
        .signo-box .dates {
            font-size: 1.2rem;
            margin-top: 10px;
            font-style: italic;
        }
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-voltar {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column align-items-center" style="min-height: 100vh; justify-content: center;">
        <?php if ($resultadoSigno): ?>
            <div class="signo-box">
                <img src="assets/imgs/<?= $resultadoSigno->signoNome ?>.png" alt="<?= $resultadoSigno->signoNome ?>">
                <h2><?= $resultadoSigno->signoNome ?></h2>
                <p class="dates">De <?= $resultadoSigno->dataInicio ?> a <?= $resultadoSigno->dataFim ?></p>
                <p><?= $resultadoSigno->descricao ?></p>
            </div>
        <?php else: ?>
            <div class="error-box">
                <h2>Erro ao Identificar o Signo</h2>
                <p>Não foi possível identificar o signo. Por favor, tente novamente com uma data válida.</p>
            </div>
        <?php endif; ?>
        <a href="index.php" class="btn btn-secondary btn-voltar">Voltar</a>
    </div>
</body>
</html>
