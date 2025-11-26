<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desafío Financiero</title>
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background: #f2f2f2;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .quiz-container {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .progress-bar {
      background: #e0e0e0;
      border-radius: 8px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .progress {
      height: 10px;
      background: #4CAF50;
      width: 0%;
      transition: width 0.3s;
    }

    .question {
      margin-bottom: 20px;
      font-size: 18px;
      color: #333;
    }

    .options button {
      display: block;
      width: 100%;
      margin: 8px 0;
      padding: 10px;
      background: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    .options button:hover {
      background: #e8f5e9;
      border-color: #4CAF50;
    }

    .score {
      font-weight: bold;
      margin-top: 10px;
      color: #333;
    }

    .result-modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      text-align: center;
      max-width: 400px;
    }

    .modal-content h3 {
      margin-bottom: 10px;
      color: #000;
    }

    .modal-content p {
      color: #333;
    }

    .close-btn {
      margin-top: 15px;
      padding: 8px 20px;
      background: #000;
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="quiz-container">
    <h2>💰 Desafío Financiero</h2>
    <div class="progress-bar"><div class="progress" id="progress"></div></div>
    <div class="question" id="question">Cargando...</div>
    <div class="options" id="options"></div>
    <div class="score" id="score">Puntos: 0</div>
  </div>

  <!-- Modal de resultados -->
  <div class="result-modal" id="resultModal">
    <div class="modal-content">
      <h3>🎉 ¡Completaste el desafío!</h3>
      <p id="finalScore"></p>
      <button class="close-btn" id="closeBtn">Aceptar</button>
    </div>
  </div>

  <script>
    const questions = [
      {
        question: "¿Qué es un presupuesto personal?",
        options: [
          "Un plan para gastar el dinero sin control.",
          "Una herramienta para organizar ingresos y gastos.",
          "Un préstamo bancario a largo plazo.",
          "Un documento para solicitar empleo."
        ],
        answer: 1
      },
      {
        question: "¿Qué porcentaje se recomienda ahorrar del salario?",
        options: ["5%", "10%", "50%", "90%"],
        answer: 1
      },
      {
        question: "¿Cuál de los siguientes es un gasto fijo?",
        options: ["Cine", "Alquiler", "Vacaciones", "Ropa"],
        answer: 1
      }
    ];

    let currentQuestion = 0;
    let score = 0;

    const questionEl = document.getElementById('question');
    const optionsEl = document.getElementById('options');
    const scoreEl = document.getElementById('score');
    const progressEl = document.getElementById('progress');
    const resultModal = document.getElementById('resultModal');
    const finalScoreEl = document.getElementById('finalScore');

    function loadQuestion() {
      const q = questions[currentQuestion];
      questionEl.textContent = q.question;
      optionsEl.innerHTML = "";
      q.options.forEach((opt, index) => {
        const btn = document.createElement("button");
        btn.textContent = opt;
        btn.onclick = () => checkAnswer(index);
        optionsEl.appendChild(btn);
      });
      progressEl.style.width = `${(currentQuestion / questions.length) * 100}%`;
    }

    function checkAnswer(selected) {
      if (selected === questions[currentQuestion].answer) {
        score += 10;
        scoreEl.textContent = `Puntos: ${score}`;
      }
      currentQuestion++;
      if (currentQuestion < questions.length) {
        loadQuestion();
      } else {
        progressEl.style.width = "100%";
        showResult();
      }
    }

    function showResult() {
      finalScoreEl.textContent = `Tu puntaje final: ${score} puntos`;
      resultModal.style.display = "flex";
    }

    document.getElementById('closeBtn').addEventListener('click', () => {
      resultModal.style.display = "none";
      location.reload();
    });

    loadQuestion();
  </script>
</body>
</html>
