<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Signo Zodiacal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        h1 {
            font-family: 'Cursive', serif;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.7);
        }
        .form-label {
            font-weight: bold;
            color: #f7f7f7;
        }
        .btn-submit {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-submit:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(106, 17, 203, 0.8);
        }
        .icon-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .icon-container img {
            width: 50px;
            height: 50px;
            margin: 0 5px;
            filter: drop-shadow(0 2px 5px rgba(255, 255, 255, 0.5));
        }
        .error-message {
            color: #ff6f61;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Descubra Seu Signo</h1>
        <div class="icon-container">
            <!-- Ícones dos signos (exemplo usando imagens locais ou URLs) -->
            <img src="assets/imgs/aries.png" alt="Áries">
            <img src="assets/imgs/taurus.png" alt="Touro">
            <img src="assets/imgs/gemini.png" alt="Gêmeos">
            <img src="assets/imgs/cancer.png" alt="Câncer">
            <img src="assets/imgs/leo.png" alt="Leão">
            <img src="assets/imgs/virgo.png" alt="Virgem">
            <img src="assets/imgs/libra.png" alt="Libra">
            <img src="assets/imgs/scorpio.png" alt="Escorpião">
            <img src="assets/imgs/sagittarius.png" alt="Sagitário">
            <img src="assets/imgs/capricorn.png" alt="Capricórnio">
            <img src="assets/imgs/aquarius.png" alt="Aquário">
            <img src="assets/imgs/pisces.png" alt="Peixes">
        </div>
        <form id="signo-form" method="POST" action="show_zodiac_sign.php">
            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
                <div class="error-message" id="date-error"></div>
            </div>
            <button type="submit" class="btn-submit w-100">Consultar Signo</button>
        </form>
    </div>
    <script>
        const form = document.getElementById('signo-form');
        const dateInput = document.getElementById('data_nascimento');
        const errorDiv = document.getElementById('date-error');

        form.addEventListener('submit', (event) => {
            if (!dateInput.value) {
                event.preventDefault();
                errorDiv.textContent = "Por favor, insira uma data válida.";
            } else {
                errorDiv.textContent = "";
            }
        });
    </script>
</body>
</html>
