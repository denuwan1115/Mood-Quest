<?php
include '../Controller/config.php';
include '../Controller/registerHandler.php';
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

        .fade-wrapper {
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
            justify-content: center;
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

        .regform-card {
            background: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 15px;
            border: 2px solid #00ffcc;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.5);
            max-width: 800px;
            width: 90%;
            animation: fadeInUp 1s ease-in-out;
        }

        .form-title {
            font-family: 'Press Start 2P', cursive;
            color: #ffcc00;
            text-shadow: 0 0 10px #ffcc00;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .regform-align {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .regform-group {
            position: relative;
            margin-bottom: 1.5rem;
            width: 48%;
        }

        .regform-group label {
            color: #00ffcc;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: block;
            text-align: left;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #00ffcc;
            border-radius: 10px;
            padding: 10px;
            color: #fff;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            box-shadow: 0 0 10px #00ffcc;
            background: rgba(255, 255, 255, 0.2);
        }

        .error {
            color: #ff6666;
            font-size: 0.9em;
            text-shadow: 0 0 5px #ff6666;
            display: block;
            text-align: left;
        }

        .register-btn, .reset-btn {
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
            margin: 0 10px;
        }

        .register-btn:hover, .reset-btn:hover {
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            box-shadow: 0 0 20px #ffcc00;
            transform: scale(1.05);
        }

        .already-account {
            color: #00ffcc;
            font-size: 1rem;
        }

        .login-link {
            color: #ffcc00;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            color: #ff6600;
            text-shadow: 0 0 10px #ffcc00;
        }

        .button-group {
            width: 100%;
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .regform-group {
                width: 100%;
            }

            .regform-card {
                max-width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
    <title>Mood Quest - Register</title>
</head>

<body>
    <!-- Particles.js Background -->
    <div id="particles-js"></div>

    <div class="fade-wrapper">
        <nav class="navbar">
            <h1 class="logo">Mood Quest</h1>
        </nav>

        <div class="regform-card mt-5">
            <h1 class="text-center form-title animate__animated animate__pulse animate__infinite">Create Your Profile</h1>
            <form id="registrationForm" class="regform-align" action="register.php" method="post">
                <div class="regform-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" class="input-field" id="fullName" name="fullName" placeholder="Enter Full Name" required>
                </div>
                <div class="regform-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="input-field" id="email" name="email" placeholder="Enter email" required>
                    <span id="emailError" class="error"></span>
                </div>
                <div class="regform-group">
                    <label for="password">Password</label>
                    <input type="password" class="input-field" id="password" name="password" placeholder="Enter password" required>
                    <span id="passwordError" class="error"></span>
                </div>
                <div class="regform-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="input-field" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    <span id="confirmPasswordError" class="error"></span>
                </div>
                <div class="button-group text-center">
                    <button class="reset-btn" type="reset">Reset</button>
                    <button class="register-btn" type="submit" name="register">Register</button>
                </div>
                <div class="text-center mt-3 w-100">
                    <span class="already-account">Already have an account? <a href="login.php" class="login-link">Log in here</a></span>
                </div>
            </form>
        </div>
    </div>

    <script src="../Static Assets/js/fade-effects.js"></script>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            let valid = true;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('confirmPassword').value;

            // Reset previous error messages
            document.getElementById('emailError').innerText = '';
            document.getElementById('passwordError').innerText = '';
            document.getElementById('confirmPasswordError').innerText = '';

            // Email validation
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').innerText = 'Please enter a valid email address.';
                valid = false;
            }

            // Password validation: minimum length and must include at least one uppercase letter
            const passwordRegex = /^(?=.*[A-Z]).{8,}$/;
            if (!passwordRegex.test(password)) {
                document.getElementById('passwordError').innerText = 'Password must be at least 8 characters long and include at least one uppercase letter.';
                valid = false;
            }

            // Confirm password validation
            if (password !== confirmPassword) {
                document.getElementById('confirmPasswordError').innerText = 'Passwords do not match.';
                valid = false;
            }

            // Prevent form submission if invalid
            if (!valid) {
                event.preventDefault();
            }
        });
    </script>

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