<?php
include '../Controller/config.php';
include '../Controller/loginHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Fonts (Gaming Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron&display=swap" rel="stylesheet">
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #1e1e2f, #2c2c54);
            place-items: center;
        }

        /* Particles.js Container */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .image-container {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .navbar {
            position: absolute;
            top: 20px;
            width: 100%;
            z-index: 10;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2.5rem;
            color: #00ffcc;
            text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            animation: glow 1.5s ease-in-out infinite alternate;
            text-align: center;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc;
            }
            to {
                text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            }
        }

        .form-card {
            background: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 15px;
            border: 2px solid #00ffcc;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            max-width: 400px;
            width: 100%;
            animation: fadeInUp 1s ease-in-out;
        }

        .form-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .form-subtitle {
            color: #00ffcc;
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00ffcc;
            border-radius: 10px;
            padding: 10px 40px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            box-shadow: 0 0 10px #00ffcc;
            background: rgba(255, 255, 255, 0.2);
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #00ffcc;
            font-size: 1.2rem;
        }

        .login-btn, .register-btn {
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            color: #1e1e2f;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #ffcc00;
        }

        .login-btn:hover, .register-btn:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00;
            transform: scale(1.05);
        }

        .register-text {
            color: #00ffcc;
            margin-top: 1rem;
        }

        .register-link {
            text-decoration: none;
        }
    </style>

    <title>Mood Quest</title>
</head>

<body>
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <div class="image-container">
        <nav class="navbar">
            <h1 class="logo">Mood Quest</h1>
        </nav>

        <div class="form-card">
            <h1 class="form-title animate__animated animate__pulse animate__infinite">Welcome to Mood Quest</h1>
            <p class="form-subtitle">Log in to start your adventure!</p>
            <form class="form-align" method="post">
                <div class="form-group">
                    <label for="email"><i class="bi bi-envelope-fill"></i></label>
                    <input type="email" class="input-field" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="bi bi-lock-fill"></i></label>
                    <input type="password" class="input-field" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <div class="text-center">
                    <button class="login-btn" id="loginbtn" name="login">Login</button>
                </div>
            </form>
            <div class="text-center">
                <p class="register-text">Don't Have a Profile?</p>
                <a href="register.php" class="register-link">
                    <button class="register-btn" id="regbtn">Register</button>
                </a>
            </div>
        </div>
    </div>

    <!-- Initialize Particles.js -->
    <script>
        particlesJS("particles-js", {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#00ffcc" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#00ffcc",
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" },
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