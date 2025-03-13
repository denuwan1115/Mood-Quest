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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Fonts (Gaming Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron&display=swap" rel="stylesheet">
    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- GSAP (GreenSock Animation Platform) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            background: linear-gradient(135deg, #1e1e2f, #2c2c54);
        }

        /* Particles.js Container */
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .main-container {
            position: relative;
            padding-top: 120px;
            /* Space for the fixed navbar */
            min-height: 100vh;
            width: 100%;
        }

        .navbar {
            position: fixed;
            /* Changed from absolute to fixed */
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: rgba(0, 0, 0, 0.8);
            border-bottom: 2px solid #00ffcc;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            z-index: 1000;
            /* Ensure navbar stays on top */
        }

        .logo {
            font-family: 'Press Start 2P', cursive;
            font-size: 2rem;
            /* Slightly reduced for better mobile display */
            color: #00ffcc;
            text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            animation: glow 1.5s ease-in-out infinite alternate;
            margin-bottom: 0;
            /* Reset default margin */
        }

        .links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            color: #00ffcc;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-shadow: 0 0 5px #00ffcc;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00, 0 0 20px #ffcc00;
            transform: scale(1.05);
        }

        .custom-icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .content-section {
            padding: 2rem 0;
        }

        .how-to-play-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .how-to-card {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #00ffcc;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            transition: all 0.3s ease;
            height: 100%;
            /* Ensure all cards have the same height */
        }

        .how-to-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.7);
        }

        .how-to-icon {
            font-size: 2.5rem;
            color: #00ffcc;
            text-shadow: 0 0 10px #00ffcc;
            margin-bottom: 1rem;
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            color: #ffcc00;
            text-shadow: 0 0 5px #ffcc00;
        }

        .card-text {
            color: #fff;
            font-size: 0.9rem;
        }

        .startBtn {
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            color: #1e1e2f;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px #ffcc00;
            text-decoration: none;
            animation: pulse 2s ease-in-out infinite;
            margin: 2rem auto;
            display: inline-block;
        }

        .startBtn:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00;
            transform: scale(1.05);
        }

        .game-modes {
            margin-top: 3rem;
        }

        .game-modes-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .game-mode-card {
            background: rgba(0, 0, 0, 0.8);
            border: 2px solid #00ffcc;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            transition: all 0.3s ease;
            height: 100%;
            /* Ensure all cards have the same height */
        }

        .game-mode-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.7);
        }

        .game-mode-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px;
        }

        .easy {
            color: #00ffcc;
        }

        .medium {
            color: #ffcc00;
        }

        .hard {
            color: #ff6666;
        }

        /* Improved responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 1rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .links {
                gap: 0.8rem;
            }

            .nav-link {
                font-size: 0.9rem;
            }

            .how-to-play-title,
            .game-modes-title {
                font-size: 1.3rem;
            }

            .startBtn {
                font-size: 1.2rem;
                padding: 12px 24px;
            }

            .how-to-icon,
            .game-mode-icon {
                font-size: 2rem;
            }
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px #00ffcc, 0 0 10px #00ffcc;
            }

            to {
                text-shadow: 0 0 10px #00ffcc, 0 0 20px #00ffcc;
            }
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

/* Fade-in animation */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply fade-in animation */
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
    
    /* Fade-in effect */
    opacity: 0;
    transform: translateY(20px);
    animation: fade-in 0.8s ease-in-out forwards;
}

.cyber-button:hover {
    background: linear-gradient(135deg, #ff6600, #ffcc00);
    box-shadow: 0 0 20px #ffcc00, 0 0 40px #ffcc00;
    transform: scale(1.05);
    color: #000;
}

/* Button text */
.cyber-button-text {
    position: relative;
    z-index: 10;
}

/* Glitch effect */
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

/* Glow effect */
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

/* Glitch animation */
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

/* Glow pulse animation */
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

    <!-- Fixed Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <h1 class="logo">Mood Quest</h1>
            <div class="links">
                <?php if ($_SESSION['loggedIn']) { ?>
                    <a href="profile.php" class="nav-link"><i class="bi bi-person custom-icon"></i> Hi, <?= $_SESSION['user_name']; ?></a>
                <?php } ?>
                <a href="scores.php" class="nav-link"><i class="bi bi-123 custom-icon"></i> Scores</a>
                <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div class="container">
            <!-- How to Play Section -->
            <section class="content-section">
                <h2 class="how-to-play-title text-center mb-4 animate__animated animate__zoomIn">How to Play</h2>
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <div class="card how-to-card text-center animate__animated animate__fadeInUp">
                            <div class="card-body">
                                <i class="bi bi-controller how-to-icon"></i>
                                <h5 class="card-title">Step 1</h5>
                                <p class="card-text">Choose your game mode and get ready to solve puzzles!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card how-to-card text-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                            <div class="card-body">
                                <i class="bi bi-play-circle how-to-icon"></i>
                                <h5 class="card-title">Step 2</h5>
                                <p class="card-text">Start solving puzzles within the given time limit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card how-to-card text-center animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                            <div class="card-body">
                                <i class="bi bi-stopwatch how-to-icon"></i>
                                <h5 class="card-title">Step 3</h5>
                                <p class="card-text">Earn points by solving puzzles as quickly as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card how-to-card text-center animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                            <div class="card-body">
                                <i class="bi bi-trophy how-to-icon"></i>
                                <h5 class="card-title">Step 4</h5>
                                <p class="card-text">Check your scores and challenge your friends!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="gameMode.php?new=true" class="cyber-button">
                        <span class="cyber-button-text">Start Playing</span>
                        <span class="cyber-button-glitch"></span>
                        <span class="cyber-button-glow"></span>
                    </a>
                </div>
            </section>

            <!-- Game Modes Section -->
            <section class="game-modes content-section">
                <h3 class="text-center game-modes-title animate__animated animate__zoomIn">Fine-Tune Your Brain with These Modes</h3>
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="card game-mode-card text-center animate__animated animate__fadeInUp">
                            <div class="card-body">
                                <i class="bi bi-emoji-smile-fill game-mode-icon easy"></i>
                                <h5 class="card-title">Relaxed Mode</h5>
                                <p class="card-text">Relax and solve puzzles with extended time limits and lower scores.</p>
                                <ul class="list-unstyled">
                                    <li><strong>Time Limit:</strong> 80 Seconds</li>
                                    <li><strong>Score Multiplier:</strong> +10</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card game-mode-card text-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                            <div class="card-body">
                                <i class="bi bi-gear-fill game-mode-icon medium"></i>
                                <h5 class="card-title">Focused Mode</h5>
                                <p class="card-text">Strike a balance with moderate time and fair scores.</p>
                                <ul class="list-unstyled">
                                    <li><strong>Time Limit:</strong> 60 Seconds</li>
                                    <li><strong>Score Multiplier:</strong> +5</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card game-mode-card text-center animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                            <div class="card-body">
                                <i class="bi bi-fire game-mode-icon hard"></i>
                                <h5 class="card-title">Extreme Mode</h5>
                                <p class="card-text">Challenge yourself with limited time and high scores!</p>
                                <ul class="list-unstyled">
                                    <li><strong>Time Limit:</strong> 45 Seconds</li>
                                    <li><strong>Score Multiplier:</strong> +2</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Initialize Particles.js -->
    <script>
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 100,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: ["#00ffcc", "#ffcc00", "#ff6666"]
                },
                shape: {
                    type: ["circle", "triangle", "star"]
                },
                opacity: {
                    value: 0.5,
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
                    speed: 3,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: {
                        enable: true,
                        mode: "repulse"
                    },
                    onclick: {
                        enable: true,
                        mode: "push"
                    },
                    resize: true
                },
                modes: {
                    repulse: {
                        distance: 100,
                        duration: 0.4
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
        // Wait for DOM to fully load
        document.addEventListener('DOMContentLoaded', function() {
            // Stagger the animations properly
            gsap.from(".navbar", {
                y: -100,
                opacity: 0,
                duration: 1,
                ease: "power2.out"
            });

            // Delay how-to cards animation to ensure they're visible
            setTimeout(function() {
                gsap.from(".how-to-card", {
                    y: 50,
                    opacity: 0,
                    duration: 0.7,
                    stagger: 0.15,
                    ease: "power2.out"
                });
            }, 500);

            // Further delay the button animation
            gsap.from(".startBtn", {
                scale: 0,
                opacity: 0,
                duration: 0.8,
                ease: "back.out(1.7)",
                delay: 1.2
            });

            // Further delay the game mode cards
            gsap.from(".game-mode-card", {
                y: 50,
                opacity: 0,
                duration: 0.7,
                stagger: 0.15,
                ease: "power2.out",
                delay: 1.5
            });
        });
    </script>
</body>

</html>