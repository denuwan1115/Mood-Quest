<?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}

$sql = mysqli_query($conn, "SELECT * FROM scores ORDER BY score DESC, id DESC LIMIT 1");
$result = mysqli_fetch_array($sql);
$playerID = $result["playerID"];
$score = $result["score"];
$datentime = $result["datentime"];
$gameID = $result["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Champion's Throne</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #1a0033, #330066, #6600cc); /* Deep cosmic gradient */
            position: relative;
        }

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
            background: rgba(26, 0, 51, 0.9);
            border-bottom: 2px solid #ffd700;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #ffd700;
            text-shadow: 0 0 10px #ffd700, 0 0 20px #ffd700;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #ffd700;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #ffd700;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff00ff;
            text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff;
            transform: scale(1.05);
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .container {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5;
        }

        .content {
            background: rgba(26, 0, 51, 0.9);
            border: 3px solid #ffd700;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .badge-wrapper {
            text-align: center;
            position: relative;
        }

        .badge-icon {
            font-size: 6rem;
            color: #ffd700;
            text-shadow: 0 0 20px #ffd700, 0 0 40px #ffd700;
            animation: trophyPulse 2s ease-in-out infinite;
            margin-bottom: 2rem;
        }

        .badge-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff00ff;
            text-shadow: 0 0 10px #ff00ff;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowMagenta 1.5s ease-in-out infinite alternate;
        }

        .badge-details p {
            margin: 1rem 0;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .badge-label {
            color: #ffd700;
            font-weight: bold;
            text-shadow: 0 0 5px #ffd700;
            margin-right: 0.5rem;
        }

        .badge-details p:hover {
            transform: scale(1.05);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

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
            opacity: 0.3;
            animation: scanlineMove 10s linear infinite;
        }

        .crt-flicker {
            pointer-events: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 9;
            opacity: 0.1;
            animation: flicker 0.3s infinite;
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px #ffd700, 0 0 10px #ffd700; }
            to { text-shadow: 0 0 10px #ffd700, 0 0 20px #ffd700, 0 0 30px #ffd700; }
        }

        @keyframes glowMagenta {
            from { text-shadow: 0 0 5px #ff00ff, 0 0 10px #ff00ff; }
            to { text-shadow: 0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 30px #ff00ff; }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes glowBorder {
            0% { box-shadow: 0 0 10px #ffd700; }
            50% { box-shadow: 0 0 20px #ffd700, 0 0 30px #ffd700; }
            100% { box-shadow: 0 0 10px #ffd700; }
        }

        @keyframes trophyPulse {
            0% { transform: scale(1); text-shadow: 0 0 20px #ffd700; }
            50% { transform: scale(1.1); text-shadow: 0 0 30px #ffd700, 0 0 40px #ffd700; }
            100% { transform: scale(1); text-shadow: 0 0 20px #ffd700; }
        }

        @keyframes scanlineMove {
            from { background-position: 0 0; }
            to { background-position: 0 100px; }
        }

        @keyframes flicker {
            0% { opacity: 0.1; }
            5% { opacity: 0.2; }
            10% { opacity: 0.1; }
            15% { opacity: 0.15; }
            20% { opacity: 0.1; }
            50% { opacity: 0.12; }
            80% { opacity: 0.1; }
            90% { opacity: 0.15; }
            100% { opacity: 0.1; }
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="scanlines"></div>
    <div class="crt-flicker"></div>

    <nav class="navbar">
        <h1 class="logo">Mood Quest</h1>
        <div class="links">
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <div class="badge-wrapper">
                <div class="badge-icon">🏆</div>
                <h2 class="badge-title">Champion's Throne</h2>
                <div class="badge-details">
                    <p><span class="badge-label">Player:</span> <?= htmlspecialchars($playerID); ?></p>
                    <p><span class="badge-label">Game ID:</span> <?= $gameID; ?></p>
                    <p><span class="badge-label">Score:</span> <?= $score; ?></p>
                    <p><span class="badge-label">Date:</span> <?= $datentime; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: '#ffd700' },
                shape: { type: 'star', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffd700',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
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
    </script>
</body>
</html>