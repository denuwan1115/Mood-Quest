<?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}

if (isset($_GET['new'])) {
    echo '<script>localStorage.removeItem("timeLeft");</script>';
    echo '<script>localStorage.removeItem("score");</script>';
    echo '<script>localStorage.removeItem("numQuestions");</script>';
    echo '<script>localStorage.removeItem("lives");</script>';

    echo '<script>const currentURL = new URL(window.location.href);</script>';
    echo '<script>const searchParams = new URLSearchParams(currentURL.search);</script>';
    echo '<script>searchParams.delete("new");</script>';
    echo '<script>history.replaceState({}, "", `${currentURL.pathname}?${searchParams.toString()}`);</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Relaxed Mode</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&family=Orbitron&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #2c5364, #203a43, #0f2027);
            position: relative;
        }

        /* Particles.js Container */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            background: rgba(44, 83, 100, 0.8);
            border-bottom: 2px solid #81c784;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            z-index: 10;
        }

        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            color: #81c784;
            text-shadow: 0 0 8px rgba(129, 199, 132, 0.5);
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            color: #b0e0e6;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: navLinkFadeIn 1s ease-in-out;
        }

        .nav-link:hover {
            color: #81c784;
            text-shadow: 0 0 8px rgba(129, 199, 132, 0.8);
            transform: translateY(-2px);
            display: inline-block;
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.4rem;
        }

        .container {
            position: relative;
            margin-top: 120px;
            padding: 2rem;
            border: 2px solid #81c784;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            background: rgba(44, 83, 100, 0.7);
            z-index: 5;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            animation: containerFadeIn 1.5s ease-in-out, containerPulse 4s ease-in-out infinite;
        }

        .single-Data {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            color: #b0e0e6;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: dataFadeIn 1.2s ease-in-out;
        }

        .single-Data span {
            padding: 8px 15px;
            background: rgba(129, 199, 132, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: scoreBoxPulse 3s ease-in-out infinite;
        }

        .single-Data span:hover {
            background: rgba(129, 199, 132, 0.4);
            transform: scale(1.05) rotate(2deg);
        }

        .lives-container {
            display: flex;
            gap: 5px;
            animation: heartBeat 2s ease-in-out infinite;
        }

        .heart {
            font-size: 1.2rem;
            color: #ff6b6b;
            text-shadow: 0 0 5px rgba(255, 107, 107, 0.5);
        }

        .game-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            animation: gameContainerSlide 1.5s ease-in-out;
        }

        .imgApi {
            width: 100%;
            max-width: 400px;
            border: 2px solid #81c784;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            animation: gentlePulse 3s ease-in-out infinite, imageZoom 2s ease-in-out;
        }

        .imgApi img {
            width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .imgApi img:hover {
            transform: scale(1.02) rotate(1deg);
        }

        .btn-container {
            text-align: center;
            color: #b0e0e6;
            animation: buttonContainerFade 1.8s ease-in-out;
        }

        .btn-container p {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        .btn-container button {
            margin: 5px;
            padding: 10px 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: #203a43;
            background: linear-gradient(135deg, #81c784, #b0e0e6);
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(129, 199, 132, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            animation: buttonPulse 2.5s ease-in-out infinite, buttonBounce 0.5s ease-in-out;
        }

        .btn-container button:hover {
            background: linear-gradient(135deg, #b0e0e6, #81c784);
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.5);
            transform: scale(1.1) rotate(3deg);
            animation: buttonHoverGlow 1s ease-in-out infinite;
        }

        @keyframes navLinkFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes containerFadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes containerPulse {
            0% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 25px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.3); }
        }

        @keyframes dataFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scoreBoxPulse {
            0% { box-shadow: 0 0 5px rgba(129, 199, 132, 0.2); }
            50% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.4); }
            100% { box-shadow: 0 0 5px rgba(129, 199, 132, 0.2); }
        }

        @keyframes gameContainerSlide {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes gentlePulse {
            0% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.3); }
        }

        @keyframes imageZoom {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes buttonContainerFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes textGlow {
            from { text-shadow: 0 0 5px rgba(176, 224, 230, 0.5); }
            to { text-shadow: 0 0 10px rgba(176, 224, 230, 0.8); }
        }

        @keyframes buttonPulse {
            0% { box-shadow: 0 0 8px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 12px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 8px rgba(129, 199, 132, 0.3); }
        }

        @keyframes buttonBounce {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        @keyframes buttonHoverGlow {
            0% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
            50% { box-shadow: 0 0 25px rgba(129, 199, 132, 0.7); }
            100% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
        }

        @keyframes heartBeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes scanlineMove {
            from { background-position: 0 0; }
            to { background-position: 0 100px; }
        }

        /* Soft scanlines for relaxed vibe */
        .scanlines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.02) 50%,
                    rgba(255, 255, 255, 0) 100%);
            background-size: 100% 2px;
            z-index: 9;
            pointer-events: none;
            opacity: 0.2;
            animation: scanlineMove 10s linear infinite;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="scanlines"></div>

    <nav class="navbar">
        <h1 class="logo">Mood Quest</h1>
        <div class="links">
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="single-Data">
            <span>Question: <span id="question-number">1</span></span>
            <span>Score: <span id="score">0</span></span>
            <span>Time: <span id="timer">80</span></span>
            <span>Lives: <span id="lives-container" class="lives-container">
                <i class="bi bi-heart-fill heart"></i>
                <i class="bi bi-heart-fill heart"></i>
                <i class="bi bi-heart-fill heart"></i>
            </span></span>
        </div>

        <div class="game-container">
            <div class="imgApi">
                <img src="" alt="Question Image" id="imgApi">
            </div>

            <div class="btn-container">
                <p>Select the Correct Answer:</p>
                <div>
                    <script>
                        for (let i = 0; i <= 10; i++) {
                            document.write(`
                                <button onclick="handleAnswer(${i})">${i}</button>
                            `);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div id="note" class="text-center" style="display: none;"></div>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 60, density: { enable: true, value_area: 800 } },
                color: { value: '#81c784' },
                shape: {
                    type: 'circle',
                    stroke: { width: 0, color: '#000000' },
                },
                opacity: {
                    value: 0.4,
                    random: true,
                    anim: { enable: false }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: { enable: false }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#81c784',
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1.5,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                },
                modes: {
                    repulse: { distance: 100, duration: 0.4 },
                    push: { particles_nb: 4 }
                }
            },
            retina_detect: true
        });

        // Game variables
        let timeLeft = parseInt(localStorage.getItem('timeLeft')) || 80;
        let score = parseInt(localStorage.getItem('score')) || 0;
        let numQuestions = parseInt(localStorage.getItem('numQuestions')) || 1;
        let lives = parseInt(localStorage.getItem('lives')) || 3;
        let timer;
        let imgApi;
        let solution;
        let scoreSent = false;
        let isGameActive = true;

        function updateUI() {
            document.getElementById("question-number").textContent = numQuestions;
            document.getElementById("score").textContent = score;
            document.getElementById("timer").textContent = timeLeft;
            updateLivesDisplay();
        }

        function updateLivesDisplay() {
            const livesContainer = document.getElementById("lives-container");
            livesContainer.innerHTML = '';
            for (let i = 0; i < lives; i++) {
                livesContainer.innerHTML += '<i class="bi bi-heart-fill heart"></i>';
            }
        }

        function handleTimeOut() {
            if (!isGameActive || scoreSent) return;
            
            isGameActive = false;
            clearInterval(timer);
            
            fetch('../Controller/updateScore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    score: score,
                    timeLeft: 0,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Score successfully updated on the server:', data);
                scoreSent = true;
                Swal.fire({
                    title: "Time's UP!",
                    text: `Your final score is ${score}.`,
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: "Play Again",
                    cancelButtonText: "View Scores",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetGame();
                    } else {
                        window.location.href = "scores.php";
                    }
                });
            })
            .catch(error => {
                console.error('Error updating score:', error);
                Swal.fire({
                    title: "Error",
                    text: "Failed to update the score on the server. Please try again later.",
                    icon: "error",
                });
            });
        }

        function handleGameOver() {
            if (!isGameActive || scoreSent) return;
            
            isGameActive = false;
            clearInterval(timer);
            fetch('../Controller/updateScore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    score: score,
                    timeLeft: timeLeft,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Score successfully updated on the server:', data);
                scoreSent = true;
                Swal.fire({
                    title: "Game Over!",
                    text: `You ran out of lives! Final score: ${score}.`,
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: "Play Again",
                    cancelButtonText: "View Scores",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetGame();
                    } else {
                        window.location.href = "scores.php";
                    }
                });
            })
            .catch(error => {
                console.error('Error updating score:', error);
                Swal.fire({
                    title: "Error",
                    text: "Failed to update the score on the server. Please try again later.",
                    icon: "error",
                });
            });
        }

        function handleAnswer(selectedNumber) {
            if (!isGameActive) return;
            
            if (timeLeft > 0 && lives > 0) {
                if (selectedNumber == solution) {
                    score += 10;
                    localStorage.setItem('score', score);
                    numQuestions++;
                    updateUI();
                    fetchImage();
                    Swal.fire({
                        title: "Correct Answer!",
                        text: "You earned 10 points!",
                        icon: "success"
                    });
                } else {
                    lives--;
                    localStorage.setItem('lives', lives);
                    updateUI();
                    Swal.fire({
                        title: "Wrong Answer",
                        text: `That answer is incorrect. Lives remaining: ${lives}`,
                        icon: "error"
                    });
                    if (lives <= 0) {
                        handleGameOver();
                    }
                }
            } else if (timeLeft <= 0) {
                handleTimeOut();
            } else if (lives <= 0) {
                handleGameOver();
            }
        }

        function fetchImage() {
            if (!isGameActive) return;
            
            fetch('https://marcconrad.com/uob/banana/api.php')
                .then(response => response.json())
                .then(data => {
                    if (!isGameActive) return;
                    
                    imgApi = data.question;
                    solution = data.solution;
                    document.getElementById("imgApi").src = imgApi;
                    document.getElementById("note").innerHTML = 'Ready?';
                    clearInterval(timer);
                    timer = setInterval(() => {
                        if (!isGameActive) {
                            clearInterval(timer);
                            return;
                        }
                        timeLeft--;
                        localStorage.setItem('timeLeft', timeLeft);
                        document.getElementById("timer").textContent = timeLeft;
                        if (timeLeft <= 0) {
                            handleTimeOut();
                        }
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error fetching image from the API:', error);
                });
        }

        function resetGame() {
            timeLeft = 80;
            score = 0;
            numQuestions = 1;
            lives = 3;
            isGameActive = true;
            scoreSent = false;
            localStorage.setItem('timeLeft', timeLeft);
            localStorage.setItem('score', score);
            localStorage.setItem('numQuestions', numQuestions);
            localStorage.setItem('lives', lives);
            updateUI();
            fetchImage();
        }

        window.addEventListener('beforeunload', function() {
            localStorage.setItem('timeLeft', timeLeft);
            localStorage.setItem('score', score);
            localStorage.setItem('numQuestions', numQuestions);
            localStorage.setItem('lives', lives);
        });

        document.addEventListener("DOMContentLoaded", function() {
            updateUI();
            fetchImage();
        });

        window.addEventListener('beforeunload', function() {
            if (!scoreSent && (score > 0 || timeLeft > 0 || lives < 3)) {
                fetch('../Controller/updateScore.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        score: score,
                        timeLeft: timeLeft,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Score sent before leaving the page:', data);
                })
                .catch(error => {
                    console.error('Error sending score before leaving the page:', error);
                });
                scoreSent = true;
            }
            localStorage.removeItem('timeLeft');
            localStorage.removeItem('score');
            localStorage.removeItem('numQuestions');
            localStorage.removeItem('lives');
        });
    </script>
</body>
</html><?php
if (isset($_GET['new'])) {
    echo '<script>localStorage.removeItem("timeLeft");</script>';
    echo '<script>localStorage.removeItem("score");</script>';
    echo '<script>localStorage.removeItem("numQuestions");</script>';
    echo '<script>localStorage.removeItem("lives");</script>';

    echo '<script>const currentURL = new URL(window.location.href);</script>';
    echo '<script>const searchParams = new URLSearchParams(currentURL.search);</script>';
    echo '<script>searchParams.delete("new");</script>';
    echo '<script>history.replaceState({}, "", `${currentURL.pathname}?${searchParams.toString()}`);</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Relaxed Mode</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&family=Orbitron&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #2c5364, #203a43, #0f2027);
            position: relative;
        }

        /* Particles.js Container */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            background: rgba(44, 83, 100, 0.8);
            border-bottom: 2px solid #81c784;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            z-index: 10;
        }

        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            color: #81c784;
            text-shadow: 0 0 8px rgba(129, 199, 132, 0.5);
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            color: #b0e0e6;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: navLinkFadeIn 1s ease-in-out;
        }

        .nav-link:hover {
            color: #81c784;
            text-shadow: 0 0 8px rgba(129, 199, 132, 0.8);
            transform: translateY(-2px);
            display: inline-block;
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.4rem;
        }

        .container {
            position: relative;
            margin-top: 120px;
            padding: 2rem;
            border: 2px solid #81c784;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            background: rgba(44, 83, 100, 0.7);
            z-index: 5;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            animation: containerFadeIn 1.5s ease-in-out, containerPulse 4s ease-in-out infinite;
        }

        .single-Data {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            color: #b0e0e6;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: dataFadeIn 1.2s ease-in-out;
        }

        .single-Data span {
            padding: 8px 15px;
            background: rgba(129, 199, 132, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            animation: scoreBoxPulse 3s ease-in-out infinite;
        }

        .single-Data span:hover {
            background: rgba(129, 199, 132, 0.4);
            transform: scale(1.05) rotate(2deg);
        }

        .lives-container {
            display: flex;
            gap: 5px;
            animation: heartBeat 2s ease-in-out infinite;
        }

        .heart {
            font-size: 1.2rem;
            color: #ff6b6b;
            text-shadow: 0 0 5px rgba(255, 107, 107, 0.5);
        }

        .game-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            animation: gameContainerSlide 1.5s ease-in-out;
        }

        .imgApi {
            width: 100%;
            max-width: 400px;
            border: 2px solid #81c784;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.3);
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            animation: gentlePulse 3s ease-in-out infinite, imageZoom 2s ease-in-out;
        }

        .imgApi img {
            width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .imgApi img:hover {
            transform: scale(1.02) rotate(1deg);
        }

        .btn-container {
            text-align: center;
            color: #b0e0e6;
            animation: buttonContainerFade 1.8s ease-in-out;
        }

        .btn-container p {
            margin-bottom: 1rem;
            font-size: 1.2rem;
            text-shadow: 0 0 5px rgba(176, 224, 230, 0.5);
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        .btn-container button {
            margin: 5px;
            padding: 10px 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 1.1rem;
            color: #203a43;
            background: linear-gradient(135deg, #81c784, #b0e0e6);
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(129, 199, 132, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            animation: buttonPulse 2.5s ease-in-out infinite, buttonBounce 0.5s ease-in-out;
        }

        .btn-container button:hover {
            background: linear-gradient(135deg, #b0e0e6, #81c784);
            box-shadow: 0 0 15px rgba(129, 199, 132, 0.5);
            transform: scale(1.1) rotate(3deg);
            animation: buttonHoverGlow 1s ease-in-out infinite;
        }

        @keyframes navLinkFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes containerFadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes containerPulse {
            0% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 25px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.3); }
        }

        @keyframes dataFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scoreBoxPulse {
            0% { box-shadow: 0 0 5px rgba(129, 199, 132, 0.2); }
            50% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.4); }
            100% { box-shadow: 0 0 5px rgba(129, 199, 132, 0.2); }
        }

        @keyframes gameContainerSlide {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes gentlePulse {
            0% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 10px rgba(129, 199, 132, 0.3); }
        }

        @keyframes imageZoom {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @keyframes buttonContainerFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes textGlow {
            from { text-shadow: 0 0 5px rgba(176, 224, 230, 0.5); }
            to { text-shadow: 0 0 10px rgba(176, 224, 230, 0.8); }
        }

        @keyframes buttonPulse {
            0% { box-shadow: 0 0 8px rgba(129, 199, 132, 0.3); }
            50% { box-shadow: 0 0 12px rgba(129, 199, 132, 0.5); }
            100% { box-shadow: 0 0 8px rgba(129, 199, 132, 0.3); }
        }

        @keyframes buttonBounce {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        @keyframes buttonHoverGlow {
            0% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
            50% { box-shadow: 0 0 25px rgba(129, 199, 132, 0.7); }
            100% { box-shadow: 0 0 15px rgba(129, 199, 132, 0.5); }
        }

        @keyframes heartBeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes scanlineMove {
            from { background-position: 0 0; }
            to { background-position: 0 100px; }
        }

        /* Soft scanlines for relaxed vibe */
        .scanlines {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.02) 50%,
                    rgba(255, 255, 255, 0) 100%);
            background-size: 100% 2px;
            z-index: 9;
            pointer-events: none;
            opacity: 0.2;
            animation: scanlineMove 10s linear infinite;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="scanlines"></div>

    <nav class="navbar">
        <h1 class="logo">Mood Quest</h1>
        <div class="links">
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="single-Data">
            <span>Question: <span id="question-number">1</span></span>
            <span>Score: <span id="score">0</span></span>
            <span>Time: <span id="timer">80</span></span>
            <span>Lives: <span id="lives-container" class="lives-container">
                <i class="bi bi-heart-fill heart"></i>
                <i class="bi bi-heart-fill heart"></i>
                <i class="bi bi-heart-fill heart"></i>
            </span></span>
        </div>

        <div class="game-container">
            <div class="imgApi">
                <img src="" alt="Question Image" id="imgApi">
            </div>

            <div class="btn-container">
                <p>Select the Correct Answer:</p>
                <div>
                    <script>
                        for (let i = 0; i <= 10; i++) {
                            document.write(`
                                <button onclick="handleAnswer(${i})">${i}</button>
                            `);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div id="note" class="text-center" style="display: none;"></div>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 60, density: { enable: true, value_area: 800 } },
                color: { value: '#81c784' },
                shape: {
                    type: 'circle',
                    stroke: { width: 0, color: '#000000' },
                },
                opacity: {
                    value: 0.4,
                    random: true,
                    anim: { enable: false }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: { enable: false }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#81c784',
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1.5,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                },
                modes: {
                    repulse: { distance: 100, duration: 0.4 },
                    push: { particles_nb: 4 }
                }
            },
            retina_detect: true
        });

        // Game variables
        let timeLeft = parseInt(localStorage.getItem('timeLeft')) || 80;
        let score = parseInt(localStorage.getItem('score')) || 0;
        let numQuestions = parseInt(localStorage.getItem('numQuestions')) || 1;
        let lives = parseInt(localStorage.getItem('lives')) || 3;
        let timer;
        let imgApi;
        let solution;
        let scoreSent = false;
        let isGameActive = true;

        function updateUI() {
            document.getElementById("question-number").textContent = numQuestions;
            document.getElementById("score").textContent = score;
            document.getElementById("timer").textContent = timeLeft;
            updateLivesDisplay();
        }

        function updateLivesDisplay() {
            const livesContainer = document.getElementById("lives-container");
            livesContainer.innerHTML = '';
            for (let i = 0; i < lives; i++) {
                livesContainer.innerHTML += '<i class="bi bi-heart-fill heart"></i>';
            }
        }

        function handleTimeOut() {
            if (!isGameActive || scoreSent) return;
            
            isGameActive = false;
            clearInterval(timer);
            
            fetch('../Controller/updateScore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    score: score,
                    timeLeft: 0,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Score successfully updated on the server:', data);
                scoreSent = true;
                Swal.fire({
                    title: "Time's UP!",
                    text: `Your final score is ${score}.`,
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: "Play Again",
                    cancelButtonText: "View Scores",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetGame();
                    } else {
                        window.location.href = "scores.php";
                    }
                });
            })
            .catch(error => {
                console.error('Error updating score:', error);
                Swal.fire({
                    title: "Error",
                    text: "Failed to update the score on the server. Please try again later.",
                    icon: "error",
                });
            });
        }

        function handleGameOver() {
            if (!isGameActive || scoreSent) return;
            
            isGameActive = false;
            clearInterval(timer);
            fetch('../Controller/updateScore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    score: score,
                    timeLeft: timeLeft,
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Score successfully updated on the server:', data);
                scoreSent = true;
                Swal.fire({
                    title: "Game Over!",
                    text: `You ran out of lives! Final score: ${score}.`,
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: "Play Again",
                    cancelButtonText: "View Scores",
                }).then((result) => {
                    if (result.isConfirmed) {
                        resetGame();
                    } else {
                        window.location.href = "scores.php";
                    }
                });
            })
            .catch(error => {
                console.error('Error updating score:', error);
                Swal.fire({
                    title: "Error",
                    text: "Failed to update the score on the server. Please try again later.",
                    icon: "error",
                });
            });
        }

        function handleAnswer(selectedNumber) {
            if (!isGameActive) return;
            
            if (timeLeft > 0 && lives > 0) {
                if (selectedNumber == solution) {
                    score += 10;
                    localStorage.setItem('score', score);
                    numQuestions++;
                    updateUI();
                    fetchImage();
                    Swal.fire({
                        title: "Correct Answer!",
                        text: "You earned 10 points!",
                        icon: "success"
                    });
                } else {
                    lives--;
                    localStorage.setItem('lives', lives);
                    updateUI();
                    Swal.fire({
                        title: "Wrong Answer",
                        text: `That answer is incorrect. Lives remaining: ${lives}`,
                        icon: "error"
                    });
                    if (lives <= 0) {
                        handleGameOver();
                    }
                }
            } else if (timeLeft <= 0) {
                handleTimeOut();
            } else if (lives <= 0) {
                handleGameOver();
            }
        }

        function fetchImage() {
            if (!isGameActive) return;
            
            fetch('https://marcconrad.com/uob/banana/api.php')
                .then(response => response.json())
                .then(data => {
                    if (!isGameActive) return;
                    
                    imgApi = data.question;
                    solution = data.solution;
                    document.getElementById("imgApi").src = imgApi;
                    document.getElementById("note").innerHTML = 'Ready?';
                    clearInterval(timer);
                    timer = setInterval(() => {
                        if (!isGameActive) {
                            clearInterval(timer);
                            return;
                        }
                        timeLeft--;
                        localStorage.setItem('timeLeft', timeLeft);
                        document.getElementById("timer").textContent = timeLeft;
                        if (timeLeft <= 0) {
                            handleTimeOut();
                        }
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error fetching image from the API:', error);
                });
        }

        function resetGame() {
            timeLeft = 80;
            score = 0;
            numQuestions = 1;
            lives = 3;
            isGameActive = true;
            scoreSent = false;
            localStorage.setItem('timeLeft', timeLeft);
            localStorage.setItem('score', score);
            localStorage.setItem('numQuestions', numQuestions);
            localStorage.setItem('lives', lives);
            updateUI();
            fetchImage();
        }

        window.addEventListener('beforeunload', function() {
            localStorage.setItem('timeLeft', timeLeft);
            localStorage.setItem('score', score);
            localStorage.setItem('numQuestions', numQuestions);
            localStorage.setItem('lives', lives);
        });

        document.addEventListener("DOMContentLoaded", function() {
            updateUI();
            fetchImage();
        });

        window.addEventListener('beforeunload', function() {
            if (!scoreSent && (score > 0 || timeLeft > 0 || lives < 3)) {
                fetch('../Controller/updateScore.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        score: score,
                        timeLeft: timeLeft,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Score sent before leaving the page:', data);
                })
                .catch(error => {
                    console.error('Error sending score before leaving the page:', error);
                });
                scoreSent = true;
            }
            localStorage.removeItem('timeLeft');
            localStorage.removeItem('score');
            localStorage.removeItem('numQuestions');
            localStorage.removeItem('lives');
        });
    </script>
</body>
</html>