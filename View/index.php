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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Fonts (Gaming Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron&display=swap" rel="stylesheet">
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Lottie Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    <!-- GSAP (GreenSock Animation Platform) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #120838, #1e0f4d);
        }

        /* Particles.js Container */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Video Background (Optional) */
        .video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .video-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.4;
            /* Slightly increased opacity */
        }

        .home-container {
            position: relative;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 1;
        }

        .navbar {
            position: absolute;
            top: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid #00ffcc;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            z-index: 10;
            animation: float 3s ease-in-out infinite;
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2.5rem;
            color: #00ffcc;
            text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc;
            }

            to {
                text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc, 0 0 30px #00ffcc;
            }
        }

        .links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00ffcc;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00ffcc;
        }

        .nav-link:hover {
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00, 0 0 20px #ffcc00;
            transform: scale(1.05);
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .landing-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border: 2px solid #00ffcc;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            background: rgba(0, 0, 0, 0.8);
            animation: fadeInUp 1s ease-in-out, glowBorder 2s ease-in-out infinite;
            position: relative;
            z-index: 5;
            max-width: 90%;
            width: 600px;
        }

        .landing-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .tagline {
            color: #00ffcc;
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-shadow: 0 0 5px #00ffcc;
            animation: fadeIn 2s ease-in-out;
        }

        .play-button {
            display: inline-block;
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            color: #1e1e2f;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #ffcc00;
            text-decoration: none;
            animation: pulse 2s ease-in-out infinite;
            position: relative;
            z-index: 7;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .play-button:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00, 0 0 40px #ffcc00;
            transform: scale(1.05);
            color: #000;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 10px #00ffcc;
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px #00ffcc;
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 10px #00ffcc;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes glowBorder {
            0% {
                box-shadow: 0 0 10px #00ffcc;
            }

            50% {
                box-shadow: 0 0 20px #00ffcc, 0 0 30px #00ffcc;
            }

            100% {
                box-shadow: 0 0 10px #00ffcc;
            }
        }

        /* Game elements floating in background */
        .game-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .game-element {
            position: absolute;
            opacity: 0.2;
            filter: drop-shadow(0 0 10px #00ffcc);
            animation: floatElement 10s ease-in-out infinite;
        }

        @keyframes floatElement {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(20px, -20px) rotate(10deg);
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        /* Scanlines effect for retro feel */
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
        }

        /* CRT flicker effect */
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

        @keyframes flicker {
            0% {
                opacity: 0.1;
            }

            5% {
                opacity: 0.2;
            }

            10% {
                opacity: 0.1;
            }

            15% {
                opacity: 0.15;
            }

            20% {
                opacity: 0.1;
            }

            50% {
                opacity: 0.12;
            }

            80% {
                opacity: 0.1;
            }

            90% {
                opacity: 0.15;
            }

            100% {
                opacity: 0.1;
            }
        }

        .cyber-button {
            display: inline-block;
            padding: 15px 30px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1e1e2f;
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            border: 2px solid #ff6600;
            border-radius: 10px;
            box-shadow: 0 0 10px #ffcc00;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            z-index: 7;
            transition: all 0.3s ease;
        }

        .cyber-button:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00, 0 0 40px #ffcc00;
            transform: scale(1.05);
            color: #000;
        }

        .cyber-button-text {
            position: relative;
            z-index: 10;
        }

        .cyber-button-glitch {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(120deg,
                    rgba(255, 204, 0, 0) 0%,
                    rgba(255, 204, 0, 0.1) 7%,
                    rgba(255, 204, 0, 0) 10%);
            opacity: 0;
            z-index: 3;
            animation: glitch 3s infinite;
        }

        .cyber-button-glow {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: radial-gradient(circle, rgba(255, 204, 0, 0.8) 0%, rgba(255, 102, 0, 0) 70%);
            opacity: 0;
            z-index: 2;
            animation: glow-pulse 2s infinite;
        }

        @keyframes glitch {
            0% {
                opacity: 0;
                transform: translate(0);
            }

            2% {
                opacity: 1;
                transform: translate(-10px, 5px);
            }

            4% {
                opacity: 0;
                transform: translate(10px, -5px);
            }

            6% {
                opacity: 1;
                transform: translate(-5px, 10px);
            }

            8% {
                opacity: 0;
                transform: translate(5px, -10px);
            }

            10% {
                opacity: 0;
                transform: translate(0);
            }

            100% {
                opacity: 0;
            }
        }

        @keyframes glow-pulse {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.2);
            }

            100% {
                opacity: 0;
                transform: scale(0.8);
            }
        }
    </style>
    <title>Mood Quest</title>
</head>

<body>
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <!-- Video Background (Optional) -->


    <!-- CRT Effects -->
    <div class="scanlines"></div>
    <div class="crt-flicker"></div>

    <!-- Game Elements in Background -->
    <div class="game-elements">     <svg class="game-element" style="top: 10%; left: 10%;" width="50" height="50" viewBox="0 0 24 24">
            <path fill="#00ffcc" d="M4,2H20A2,2 0 0,1 22,4V20A2,2 0 0,1 20,22H4A2,2 0 0,1 2,20V4A2,2 0 0,1 4,2M5,5V19H19V5H5Z" />
        </svg>
        <svg class="game-element" style="top: 30%; right: 15%;" width="60" height="60" viewBox="0 0 24 24">
            <path fill="#ffcc00" d="M12,20L7,15H12V20M12,4V9H7L12,4M13,9V4L18,9H13M13,15V20L18,15H13Z" />
        </svg>
        <svg class="game-element" style="bottom: 20%; left: 20%;" width="70" height="70" viewBox="0 0 24 24">
            <path fill="#ff6600" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z" />
        </svg>
    </div>

    <div class="home-container">
        <nav class="navbar">
            <h1 class="logo">Mood Quest</h1>
            <div class="links">
                <?php if ($_SESSION['loggedIn']) { ?>
                    <a href="profile.php" class="nav-link">
                        <i class="bi bi-person-circle custom-icon"></i> Hi, <?= $_SESSION['user_name']; ?>
                    </a>
                <?php } ?>
                <a href="scores.php" class="nav-link">
                    <i class="bi bi-trophy custom-icon"></i> Scores
                </a>
                <a href="../Controller/logout.php" class="nav-link">
                    <i class="bi bi-power custom-icon"></i> Logout
                </a>
            </div>
        </nav>
        <div class="landing-content">
            <div id="puzzle-animation" class="puzzle-icon"><img src="../Static Assets/images/Logo_final.png" alt=""></div>
            <h1 class="landing-title animate__animated animate__zoomIn">Welcome to Mood Quest</h1>
            <p class="tagline animate__animated animate__fadeInUp">Challenge your mind and conquer the puzzles!</p>
            <a href="howtoplay.php" class="cyber-button">
                <span class="cyber-button-text">Start Playing</span>
                <span class="cyber-button-glitch"></span>
                <span class="cyber-button-glow"></span>
            </a>
        </div>
    </div>

    <!-- Initialize Lottie Animation -->
    <script>
        lottie.loadAnimation({
            container: document.getElementById('puzzle-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'https://assets2.lottiefiles.com/packages/lf20_kv2n3gzz.json' // Replace with a gaming-themed Lottie animation
        });
    </script>

    <!-- Initialize Particles.js -->
    <script>
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 120,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: ["#00ffcc", "#ffcc00", "#ff6666", "#6633ff"]
                }, // Multi-color particles
                shape: {
                    type: ["circle", "triangle", "star", "polygon"],
                    polygon: {
                        nb_sides: 6
                    }
                }, // More varied shapes
                opacity: {
                    value: 0.6,
                    random: true
                },
                size: {
                    value: 5,
                    random: true
                },
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
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: true,
                        rotateX: 600,
                        rotateY: 1200
                    }
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "bubble"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    bubble: {
                        distance: 150,
                        size: 8,
                        duration: 2,
                        opacity: 0.8,
                        speed: 3
                    },
                    push: {
                        particles_nb: 4
                    }
                }
            },
            retina_detect: true
        });
    </script>

    <!-- GSAP Animations -->
    <script>
        // Staggered entrance animations
        gsap.from(".navbar", {
            y: -100,
            opacity: 0,
            duration: 1,
            ease: "power2.out"
        });
        gsap.from(".landing-title", {
            scale: 0,
            opacity: 0,
            duration: 1.5,
            delay: 0.5,
            ease: "elastic.out(1, 0.5)"
        });
        gsap.from(".tagline", {
            y: 50,
            opacity: 0,
            duration: 1,
            delay: 1,
            ease: "power2.out"
        });
        gsap.from(".play-button", {
            scale: 0,
            opacity: 0,
            duration: 1,
            delay: 1.5,
            ease: "back.out(1.7)"
        });

        // Mousemove parallax effect
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            gsap.to(".landing-content", {
                duration: 1,
                x: (x - 0.5) * 20,
                y: (y - 0.5) * 20,
                ease: "power1.out"
            });

            gsap.to(".game-elements svg", {
                duration: 2,
                x: (x - 0.5) * 40,
                y: (y - 0.5) * 40,
                rotation: (x - 0.5) * 10,
                ease: "power1.out",
                stagger: 0.1
            });
        });
    </script>
</body>

</html>