<?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Cosmic Scoreboard</title>
    
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
            overflow: hidden; /* Prevents body scrolling */
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #0a192f, #1a2a6c, #b21f1f); /* New cosmic vibe */
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
            background: rgba(10, 25, 47, 0.9);
            border-bottom: 2px solid #64ffda;
            box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #64ffda;
            text-shadow: 0 0 10px #64ffda, 0 0 20px #64ffda;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #64ffda;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #64ffda;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff6b6b;
            text-shadow: 0 0 10px #ff6b6b, 0 0 20px #ff6b6b;
            transform: scale(1.05);
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .container {
            position: relative;
            margin-top: 100px;
            padding: 2rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            z-index: 5;
        }

        .content {
            background: rgba(10, 25, 47, 0.9);
            border: 2px solid #64ffda;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
            padding: 2rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
        }

        .scores-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff6b6b;
            text-shadow: 0 0 10px #ff6b6b;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .table-container {
            max-height: 60vh; /* Limits height for scrolling */
            overflow-y: auto; /* Enables vertical scrolling */
            border-radius: 10px;
            scrollbar-width: thin;
            scrollbar-color: #64ffda #0a192f;
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #0a192f;
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #64ffda;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(100, 255, 218, 0.5);
        }

        .scores-table {
            background: rgba(26, 42, 108, 0.9);
            border: 1px solid #64ffda;
            color: #fff;
            width: 100%;
            animation: tablePulse 2s ease-in-out infinite;
        }

        .scores-table th {
            background: linear-gradient(135deg, #64ffda, #ff6b6b);
            color: #0a192f;
            text-shadow: 0 0 5px #fff;
            font-weight: bold;
            padding: 1rem;
            border-bottom: 2px solid #ff6b6b;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .scores-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(100, 255, 218, 0.2);
            transition: all 0.3s ease;
        }

        .scores-table tr:hover {
            background: rgba(100, 255, 218, 0.1);
            transform: scale(1.01);
            box-shadow: 0 0 15px rgba(100, 255, 218, 0.3);
        }

        .table-row:nth-child(1) td {
            color: #ffd700;
            text-shadow: 0 0 10px #ffd700;
            font-weight: bold;
        }

        .table-row:nth-child(2) td {
            color: #64ffda;
            text-shadow: 0 0 8px #64ffda;
        }

        .table-row:nth-child(3) td {
            color: #ff6b6b;
            text-shadow: 0 0 6px #ff6b6b;
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
            from { text-shadow: 0 0 5px #64ffda, 0 0 10px #64ffda; }
            to { text-shadow: 0 0 10px #64ffda, 0 0 20px #64ffda, 0 0 30px #64ffda; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff6b6b, 0 0 10px #ff6b6b; }
            to { text-shadow: 0 0 10px #ff6b6b, 0 0 20px #ff6b6b, 0 0 30px #ff6b6b; }
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
            0% { box-shadow: 0 0 10px #64ffda; }
            50% { box-shadow: 0 0 20px #64ffda, 0 0 30px #64ffda; }
            100% { box-shadow: 0 0 10px #64ffda; }
        }

        @keyframes tablePulse {
            0% { box-shadow: 0 0 10px rgba(100, 255, 218, 0.3); }
            50% { box-shadow: 0 0 20px rgba(100, 255, 218, 0.5); }
            100% { box-shadow: 0 0 10px rgba(100, 255, 218, 0.3); }
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
            <a href="gameMode.php" class="nav-link"><i class="bi bi-reply-fill custom-icon"></i> Play Again!</a>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="bestScored.php" class="nav-link"><i class="bi bi-shift-fill custom-icon"></i> Best Scored</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <h1 class="scores-title">Cosmic Scoreboard</h1>
            <div class="table-container">
                <table class="table scores-table">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Player</th>
                            <th scope="col">Score</th>
                            <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `scores` ORDER BY `score` DESC";
                        $scores = $conn->query($sql);
                        $rank = 1;

                        foreach ($scores as $score) { ?>
                            <tr class="table-row">
                                <td><?= $rank++; ?></td>
                                <td><?= htmlspecialchars($score['playerID']); ?></td>
                                <td><?= $score['score']; ?></td>
                                <td><?= $score['datentime']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                number: { value: 100, density: { enable: true, value_area: 800 } },
                color: { value: '#64ffda' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#64ffda',
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
</html><?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Cosmic Scoreboard</title>
    
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
            overflow: hidden; /* Prevents body scrolling */
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #0a192f, #1a2a6c, #b21f1f); /* New cosmic vibe */
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
            background: rgba(10, 25, 47, 0.9);
            border-bottom: 2px solid #64ffda;
            box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #64ffda;
            text-shadow: 0 0 10px #64ffda, 0 0 20px #64ffda;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #64ffda;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #64ffda;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff6b6b;
            text-shadow: 0 0 10px #ff6b6b, 0 0 20px #ff6b6b;
            transform: scale(1.05);
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .container {
            position: relative;
            margin-top: 100px;
            padding: 2rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            z-index: 5;
        }

        .content {
            background: rgba(10, 25, 47, 0.9);
            border: 2px solid #64ffda;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(100, 255, 218, 0.5);
            padding: 2rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
        }

        .scores-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff6b6b;
            text-shadow: 0 0 10px #ff6b6b;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .table-container {
            max-height: 60vh; /* Limits height for scrolling */
            overflow-y: auto; /* Enables vertical scrolling */
            border-radius: 10px;
            scrollbar-width: thin;
            scrollbar-color: #64ffda #0a192f;
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #0a192f;
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #64ffda;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(100, 255, 218, 0.5);
        }

        .scores-table {
            background: rgba(26, 42, 108, 0.9);
            border: 1px solid #64ffda;
            color: #fff;
            width: 100%;
            animation: tablePulse 2s ease-in-out infinite;
        }

        .scores-table th {
            background: linear-gradient(135deg, #64ffda, #ff6b6b);
            color: #0a192f;
            text-shadow: 0 0 5px #fff;
            font-weight: bold;
            padding: 1rem;
            border-bottom: 2px solid #ff6b6b;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .scores-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(100, 255, 218, 0.2);
            transition: all 0.3s ease;
        }

        .scores-table tr:hover {
            background: rgba(100, 255, 218, 0.1);
            transform: scale(1.01);
            box-shadow: 0 0 15px rgba(100, 255, 218, 0.3);
        }

        .table-row:nth-child(1) td {
            color: #ffd700;
            text-shadow: 0 0 10px #ffd700;
            font-weight: bold;
        }

        .table-row:nth-child(2) td {
            color: #64ffda;
            text-shadow: 0 0 8px #64ffda;
        }

        .table-row:nth-child(3) td {
            color: #ff6b6b;
            text-shadow: 0 0 6px #ff6b6b;
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
            from { text-shadow: 0 0 5px #64ffda, 0 0 10px #64ffda; }
            to { text-shadow: 0 0 10px #64ffda, 0 0 20px #64ffda, 0 0 30px #64ffda; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff6b6b, 0 0 10px #ff6b6b; }
            to { text-shadow: 0 0 10px #ff6b6b, 0 0 20px #ff6b6b, 0 0 30px #ff6b6b; }
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
            0% { box-shadow: 0 0 10px #64ffda; }
            50% { box-shadow: 0 0 20px #64ffda, 0 0 30px #64ffda; }
            100% { box-shadow: 0 0 10px #64ffda; }
        }

        @keyframes tablePulse {
            0% { box-shadow: 0 0 10px rgba(100, 255, 218, 0.3); }
            50% { box-shadow: 0 0 20px rgba(100, 255, 218, 0.5); }
            100% { box-shadow: 0 0 10px rgba(100, 255, 218, 0.3); }
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
            <a href="gameMode.php" class="nav-link"><i class="bi bi-reply-fill custom-icon"></i> Play Again!</a>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="bestScored.php" class="nav-link"><i class="bi bi-shift-fill custom-icon"></i> Best Scored</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="content">
            <h1 class="scores-title">Cosmic Scoreboard</h1>
            <div class="table-container">
                <table class="table scores-table">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Player</th>
                            <th scope="col">Score</th>
                            <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `scores` ORDER BY `score` DESC";
                        $scores = $conn->query($sql);
                        $rank = 1;

                        foreach ($scores as $score) { ?>
                            <tr class="table-row">
                                <td><?= $rank++; ?></td>
                                <td><?= htmlspecialchars($score['playerID']); ?></td>
                                <td><?= $score['score']; ?></td>
                                <td><?= $score['datentime']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                number: { value: 100, density: { enable: true, value_area: 800 } },
                color: { value: '#64ffda' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#64ffda',
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