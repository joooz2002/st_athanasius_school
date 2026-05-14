<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | St Athanasius School</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/typewriter-effect@2.18.0/dist/core.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.35)),
                        url('assets/images/bg pic.jpg') center/cover no-repeat fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            width: 100%;
            max-width: 440px;           /* ← Made wider */
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 40px rgba(228, 58, 58, 0.89);
            overflow: hidden;
            padding: 35px 40px;         /* ← Adjusted padding */
            color: white;
        }

        .logo {
            width: 85px;
            height: 85px;
            display: block;
            margin: 0 auto 15px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.6);
        }

        h1 {
            text-align: center;
            font-size: 27px;
            margin-bottom: 6px;
        }

        p.subtitle {
            text-align: center;
            margin-bottom: 30px;
            opacity: 0.9;
            font-size: 15.5px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 15px;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 15px 16px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            color: white;
            font-size: 16px;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.75);
        }

        input:focus {
            outline: none;
            border-color: #f4b400;
            box-shadow: 0 0 0 3px rgba(244, 180, 0, 0.2);
        }

        .extra {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0 25px 0;
            font-size: 14.5px;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn:hover {
            background: linear-gradient(135deg, #2a5298, #1e3c72);
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
        }

        .footer-links a {
            color: #f4b400;
            text-decoration: none;
        }

        .error {
            background: rgba(220, 53, 69, 0.85);
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="text-white relative">
    <div class="sunset-tint"></div>

    <div class="glass p-10 rounded-3xl w-full max-w-md mx-4 relative z-10">
        <div class="text-center mb-8">
            <!-- Logo with fallback -->
            <div class="flex justify-center mb-4">
                <img src="assets/images/st-athanasius-logo.png" 
                     alt="St Athanasius School Logo" 
                     class="w-24 h-24 rounded-2xl shadow-2xl border-2 border-white/40 object-contain bg-white/10 p-2 logo-container"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                
                <!-- Fallback if logo image fails to load -->
                <div class="w-24 h-24 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/40 flex items-center justify-center shadow-xl hidden">
                    <span class="text-5xl font-bold text-white tracking-tighter">SA</span>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold tracking-tight">St Athanasius School</h1>
            <p id="welcome-text" class="text-lg text-white/90 mt-2 min-h-[28px]"></p>
        </div>

        <form id="loginForm" method="POST" class="space-y-6">
            <div>
                <label class="block text-sm mb-2 text-white/90" for="email">Username / Email</label>
                <input type="text" 
                       id="email"
                       name="email" 
                       required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/30 focus:outline-none focus:border-white/70 transition-all text-white placeholder-white/60"
                       placeholder="jack@gmail.com">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90" for="password">Password</label>
                <input type="password" 
                       id="password"
                       name="password" 
                       required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/30 focus:outline-none focus:border-white/70 transition-all text-white placeholder-white/60"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 accent-blue-600">
                    <span class="text-white/90">Remember Me</span>
                </label>
                <a href="#" class="text-yellow-300 hover:underline">Forgot Password?</a>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-2xl font-bold text-lg transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                LOGIN
            </button>
        </form>

        <p class="text-center mt-6 text-white/70">
            Don't have an account? 
            <a href="register.php" class="text-yellow-300 hover:underline font-medium">Register</a>
        </p>
    </div>

    <script>
        // Typewriter Effect
        const welcomeEl = document.getElementById('welcome-text');
        const typewriter = new Typewriter(welcomeEl, { loop: true, delay: 75 });

        typewriter
            .typeString('Welcome Back')
            .pauseFor(2800)
            .deleteAll()
            .typeString('Glad to see you again!')
            .pauseFor(2800)
            .deleteAll()
            .start();

        // Form demo
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button');
            const originalText = btn.textContent;
            
            btn.textContent = 'LOGGING IN...';
            btn.disabled = true;

            setTimeout(() => {
                alert('Login successful! ✨');
                btn.textContent = originalText;
                btn.disabled = false;
            }, 1400);
        });
    </script>
</body>
</html>