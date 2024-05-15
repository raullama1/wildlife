<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #2980b9;
            font-family: Arial, sans-serif;
        }

        .signup-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .signup-form {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            animation: slide-up 0.6s ease;
            transform-origin: top;
        }

        .signup-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2980b9;
            opacity: 0;
            transform: translateY(100px);
            animation: slide-down 0.6s ease 0.3s forwards;
        }

        .form-control {
            margin-bottom: 20px;
            border-radius: 4px;
            opacity: 0;
            transform: translateY(100px);
            animation: slide-up 0.6s ease 0.4s forwards;
        }

        .signup-btn {
            background: #2980b9;
            border: none;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
            opacity: 0;
            transform: translateY(100px);
            animation: slide-up 0.6s ease 0.5s forwards;
        }

        .login-link {
            text-align: center;
            opacity: 0;
            transform: translateY(100px);
            animation: slide-up 0.6s ease 0.6s forwards;
        }

        .login-link a {
            text-align: center;
            opacity: 0;
            transform: translateY(100px);
            animation: slide-up 0.6s ease 0.7s forwards;
        }

        
        .login-btn:hover,
        .signup-btn:hover {
            background: #6dd5fa;
        }

        @keyframes slide-up {
            0% {
                opacity: 0;
                transform: translateY(100px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-down {
            0% {
                opacity: 0;
                transform: translateY(-100px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0;
            animation: fade-in 0.6s ease 0.2s forwards;
        }
        
        @keyframes fade-in {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <img class="background-image" src="https://images.unsplash.com/photo-1487088678257-3a541e6e3922?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Background Image">
        <div class="signup-form">
            <h2>Sign Up</h2>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="signup" class="btn btn-primary btn-block signup-btn">Sign Up</button>
                </div>
                <div class="login-link">
                    Already have an account? <a href="index.php">Log In</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
