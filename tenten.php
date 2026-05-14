<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | St Athanasius School</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/typewriter-effect@2.18.0/dist/core.js"></script>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.22), rgba(0, 0, 0, 0.28)),
                        url('assets/images/bg pic.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .glass {
            background: rgba(255, 255, 255, 0.06);     /* Very transparent */
            backdrop-filter: blur(8px);                /* Minimal blur */
            -webkit-backdrop-filter: blur(8px);
            
            border: 2px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
            
            width: 100%;
            max-width: 440px;
            border-radius: 24px;
            padding: 40px 38px;
            color: white;
            position: relative;
        }

        .sunset-tint {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, 
                rgba(255, 215, 0, 0.08) 0%, 
                rgba(255, 165, 0, 0.05) 50%, 
                transparent 100%);
            pointer-events: none;
            z-index: -1;
        }

        input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
        }

        #welcome-text::after {
            content: "|";
            animation: blink 0.85s infinite;
            color: #fcd34d;
        }

        @keyframes blink {
            50% { opacity: 0; }
        }
    </style>
</head>
<body class="text-white relative">
    <div class="sunset-tint"></div>

    <div class="glass">
        <div class="text-center mb-8">
            <!-- Logo with fallback -->
            <div class="flex justify-center mb-4">
                <img src="assets/images/st-athanasius-logo.png" 
                     alt="St Athanasius School Logo" 
                     class="w-24 h-24 rounded-2xl shadow-2xl border-2 border-white/50 object-contain bg-white/10 p-2"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                
                <!-- Fallback -->
                <div class="w-24 h-24 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/50 flex items-center justify-center shadow-xl hidden">
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
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 transition-all text-white placeholder-white/70"
                       placeholder="jack@gmail.com">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90" for="password">Password</label>
                <input type="password" 
                       id="password"
                       name="password" 
                       required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 transition-all text-white placeholder-white/70"
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