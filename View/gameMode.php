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
    <title>Mood Quest</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Google Fonts (Gaming Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Orbitron&display=swap" rel="stylesheet">

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
        }

        .fade-wrapper {
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

        .container {
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

        .index-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            animation: glow 1.5s ease-in-out infinite alternate;
        }

        .difficulty-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .difficulty-btn {
            display: inline-block;
            padding: 15px 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
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
            transition: all 0.3s ease;
            animation: pulse 2s ease-in-out infinite;
        }

        .difficulty-btn:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00, 0 0 40px #ffcc00;
            transform: scale(1.05);
            color: #000;
        }

        .difficulty-icon {
            margin-right: 0.5rem;
            font-size: 1.5rem;
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

        /* Joke Modal Styles */
        .joke-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .joke-content {
            width: 80%;
            max-width: 600px;
            background: rgba(30, 15, 77, 0.95);
            border: 2px solid #00ffcc;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.7);
            padding: 2rem;
            text-align: center;
            animation: fadeInUp 0.5s ease-in-out;
        }

        .joke-title {
            font-family: 'Press Start 2P', cursive;
            color: #00ffcc;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            text-shadow: 0 0 10px #00ffcc;
        }

        .joke-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 2rem;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }

        .joke-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .joke-btn {
            padding: 10px 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .play-btn {
            background: linear-gradient(135deg, #00ccff, #00ffcc);
            color: #1e0f4d;
            border: 2px solid #00ffcc;
            box-shadow: 0 0 10px rgba(0, 255, 204, 0.7);
        }

        .play-btn:hover {
            background: linear-gradient(135deg, #00ffcc, #00ccff);
            box-shadow: 0 0 15px rgba(0, 255, 204, 0.9);
            transform: scale(1.05);
        }

        .new-joke-btn {
            background: linear-gradient(135deg, #ffcc00, #ff6600);
            color: #1e0f4d;
            border: 2px solid #ff6600;
            box-shadow: 0 0 10px rgba(255, 204, 0, 0.7);
        }

        .new-joke-btn:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 15px rgba(255, 204, 0, 0.9);
            transform: scale(1.05);
        }

        .joke-loader {
            display: none;
            width: 50px;
            height: 50px;
            border: 5px solid rgba(0, 255, 204, 0.3);
            border-radius: 50%;
            border-top-color: #00ffcc;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="scanlines"></div>
    <div class="crt-flicker"></div>

    <div class="fade-wrapper">
        <div class="image-container">
            <nav class="navbar">
                <h1 class="logo">Mood Quest</h1>
                <div class="links">
                    <a href="bestScored.php" class="nav-link"><i class="bi bi-shift-fill custom-icon"></i> BEST SCORED!</a>
                    <a href="index.php" class="nav-link"><i class="bi bi-house custom-icon"></i> Home</a>
                    <a href="../Controller/logout.php" class="nav-link"><i class="bi bi-power custom-icon"></i> Logout</a>
                </div>
            </nav>

            <div class="container">
                <div class="content">
                    <h2 class="index-title">Choose Your Difficulty</h2>
                    <div class="difficulty-buttons">
                        <button class="difficulty-btn" id="easyBtn">
                            <i class="bi bi-emoji-smile difficulty-icon"></i>
                            Relax
                        </button>
                        <button class="difficulty-btn" id="mediumBtn">
                            <i class="bi bi-emoji-neutral difficulty-icon"></i>
                            Focus
                        </button>
                        <button class="difficulty-btn" id="hardBtn">
                            <i class="bi bi-emoji-angry difficulty-icon"></i>
                            Extreme
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Joke Modal -->
    <div class="joke-modal" id="jokeModal">
        <div class="joke-content">
            <h3 class="joke-title" id="jokeTitle">Loading Joke...</h3>
            <div class="joke-loader" id="jokeLoader"></div>
            <div class="joke-text" id="jokeText">Finding a funny joke for you...</div>
            <div class="joke-buttons">
                <button class="joke-btn play-btn" id="playGameBtn">
                    <i class="bi bi-controller"></i> Play Game
                </button>
                <button class="joke-btn new-joke-btn" id="newJokeBtn">
                    <i class="bi bi-arrow-repeat"></i> New Joke
                </button>
            </div>
        </div>
    </div>

    <!-- Particles.js -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Lottie Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Static Assets/js/fade-effects.js"></script>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#00ffcc'
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 0,
                        color: '#000000'
                    },
                },
                opacity: {
                    value: 0.5,
                    random: false,
                    anim: {
                        enable: false
                    }
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#00ffcc',
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
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
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

        // Variables for game mode
        let selectedMode = '';
        let timeForMode = 0;
        let modePage = '';

        // Joke API related functions
        function showJokeModal(mode) {
            document.getElementById('jokeModal').style.display = 'flex';
            document.getElementById('jokeLoader').style.display = 'block';

            // Update title based on selected mode
            let jokeTitle = document.getElementById('jokeTitle');
            if (mode === 'easy') {
                jokeTitle.textContent = "Relax Mode Joke";
                selectedMode = 'Relax';
                timeForMode = 80;
                modePage = 'relaxedMode.php';
            } else if (mode === 'medium') {
                jokeTitle.textContent = "Focus Mode Joke";
                selectedMode = 'Focus';
                timeForMode = 60;
                modePage = 'focusedMode.php';
            } else {
                jokeTitle.textContent = "Extreme Mode Joke";
                selectedMode = 'Extreme';
                timeForMode = 45;
                modePage = 'extremeMode.php';
            }

            fetchJoke(mode);
        }

        function closeJokeModal() {
            document.getElementById('jokeModal').style.display = 'none';
        }

        function fetchJoke(mode) {
    document.getElementById('jokeLoader').style.display = 'block';
    document.getElementById('jokeText').textContent = "Finding a funny joke for you...";
    
    // Different joke types based on difficulty
    let jokeCategory = 'Any'; // Default to any category
    let jokeEmoji = '😄'; // Default emoji
    
    if (mode === 'easy') {
        jokeCategory = 'Miscellaneous,Pun';
        jokeEmoji = '😊'; // Happy emoji for easy mode
    } else if (mode === 'medium') {
        jokeCategory = 'Programming';
        jokeEmoji = '🤔'; // Thinking emoji for programming jokes
    } else {
        jokeCategory = 'Pun,Spooky';
        jokeEmoji = '👻'; // Spooky emoji for hard mode
    }
    
    // JokeAPI endpoint - use appropriate format with blacklist flags
    fetch(`https://v2.jokeapi.dev/joke/${jokeCategory}?blacklistFlags=nsfw,religious,political,racist,sexist,explicit&type=single`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('jokeLoader').style.display = 'none';
            
            if (data.error) {
                document.getElementById('jokeText').innerHTML = `${jokeEmoji} Oops! Couldn't fetch a joke. Try again? ${jokeEmoji}`;
                console.error('Joke API error:', data.error);
            } else {
                // Add emojis before and after the joke text
                document.getElementById('jokeText').innerHTML = `${jokeEmoji} ${data.joke || "Couldn't find a joke. Try again?"} ${jokeEmoji}`;
            }
        })
        .catch(error => {
            document.getElementById('jokeLoader').style.display = 'none';
            document.getElementById('jokeText').innerHTML = `😕 Oops! Something went wrong. Try again? 😕`;
            console.error('Error fetching joke:', error);
        });
}

        // Event listeners for difficulty buttons
        document.getElementById('easyBtn').addEventListener('click', () => {
            showJokeModal('easy');
        });

        document.getElementById('mediumBtn').addEventListener('click', () => {
            showJokeModal('medium');
        });

        document.getElementById('hardBtn').addEventListener('click', () => {
            showJokeModal('hard');
        });

        // Event listener for "Play Game" button
        document.getElementById('playGameBtn').addEventListener('click', () => {
            // Store game settings in localStorage as per original code
            localStorage.setItem('timeLeft', timeForMode);
            localStorage.setItem('difficulty', selectedMode);

            // Redirect to the respective game page
            window.location.href = modePage;

            // Close the modal
            closeJokeModal();
        });

        // Event listener for "New Joke" button
        document.getElementById('newJokeBtn').addEventListener('click', () => {
            // Determine which mode is currently selected based on title
            let jokeTitle = document.getElementById('jokeTitle').textContent;
            let mode = 'general';

            if (jokeTitle.includes('Easy')) {
                mode = 'easy';
            } else if (jokeTitle.includes('Medium')) {
                mode = 'medium';
            } else {
                mode = 'hard';
            }

            // Fetch a new joke
            fetchJoke(mode);
        });

        // GSAP animations (unchanged from original code)
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