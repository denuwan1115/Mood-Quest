<?php
include '../Controller/config.php';

if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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

include '../Controller/updateHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Quest - Player Dashboard</title>
    
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
            background: linear-gradient(135deg, #0d1b2a, #1b263b, #415a77); /* Dark sci-fi gradient */
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
            background: rgba(13, 27, 42, 0.9);
            border-bottom: 2px solid #00d4ff;
            box-shadow: 0 0 20px rgba(0, 212, 255, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00d4ff;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover {
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63;
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
            background: rgba(13, 27, 42, 0.9);
            border: 3px solid #00d4ff;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 212, 255, 0.5);
            padding: 3rem;
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            max-width: 600px;
            width: 100%;
        }

        .profileform-wrapper {
            text-align: center;
        }

        .profile-title {
            font-family: 'Press Start 2P', cursive;
            color: #ff2e63;
            text-shadow: 0 0 10px #ff2e63;
            font-size: 2rem;
            margin-bottom: 2rem;
            animation: glowRed 1.5s ease-in-out infinite alternate;
        }

        .profileform-align {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .profileform-group {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .profileform-group label {
            color: #00d4ff;
            font-weight: bold;
            text-shadow: 0 0 5px #00d4ff;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .input-field {
            background: rgba(65, 90, 119, 0.5);
            border: 2px solid #00d4ff;
            border-radius: 8px;
            padding: 0.75rem;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 212, 255, 0.3);
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2e63;
            box-shadow: 0 0 15px rgba(255, 46, 99, 0.5);
            background: rgba(65, 90, 119, 0.7);
        }

        .updateformbtn {
            background: linear-gradient(135deg, #00d4ff, #ff2e63);
            border: none;
            border-radius: 10px;
            padding: 1rem 2rem;
            color: #0d1b2a;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #00d4ff;
            text-transform: uppercase;
            animation: pulse 2s ease-in-out infinite;
        }

        .updateformbtn:hover {
            background: linear-gradient(135deg, #ff2e63, #00d4ff);
            box-shadow: 0 0 20px #ff2e63, 0 0 40px #ff2e63;
            transform: scale(1.05);
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
            from { text-shadow: 0 0 5px #00d4ff, 0 0 10px #00d4ff; }
            to { text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
        }

        @keyframes glowRed {
            from { text-shadow: 0 0 5px #ff2e63, 0 0 10px #ff2e63; }
            to { text-shadow: 0 0 10px #ff2e63, 0 0 20px #ff2e63, 0 0 30px #ff2e63; }
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
            0% { box-shadow: 0 0 10px #00d4ff; }
            50% { box-shadow: 0 0 20px #00d4ff, 0 0 30px #00d4ff; }
            100% { box-shadow: 0 0 10px #00d4ff; }
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
            50% { transform: scale(1.05); box-shadow: 0 0 20px #00d4ff; }
            100% { transform: scale(1); box-shadow: 0 0 10px #00d4ff; }
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
            <?php if ($_SESSION['loggedIn']) { ?>
                <a href="profile.php" class="nav-link">Hi, <?= $_SESSION['user_name']; ?></a>
            <?php } ?>
            <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
            <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
        </div>
    </nav>

    <!-- Profile Form -->
    <div class="container">
        <div class="content">
            <div class="profileform-wrapper">
                <h1 class="text-center profile-title">Player Dashboard</h1>
                <form class="profileform-align" method="post">
                    <div class="profileform-group">
                        <label for="fullName">Full Name:</label>
                        <input type="text" class="input-field" id="updatefullName" name="updatefullName" required value="<?= $row['fullName'] ?>">
                    </div>
                    <div class="profileform-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="input-field" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="profileform-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="input-field" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="text-center">
                        <button class="updateformbtn" type="submit" id="updateformbtn" name="updatebtn">Update</button>
                    </div>
                </form>
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
                color: { value: '#00d4ff' },
                shape: { type: 'circle', stroke: { width: 0, color: '#000000' } },
                opacity: { value: 0.5, random: true, anim: { enable: false } },
                size: { value: 3, random: true, anim: { enable: false } },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00d4ff',
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