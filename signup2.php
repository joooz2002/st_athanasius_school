<?php
// signup.php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Register | St Athanasius School</title>
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
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 2px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 480px;
            border-radius: 24px;
            padding: 40px 38px;
            color: white;
            position: relative;
        }

        .sunset-tint {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.08) 0%, rgba(255, 165, 0, 0.05) 50%, transparent 100%);
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body class="text-white relative">
    <div class="sunset-tint"></div>

    <div class="glass">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="assets/images/st-athanasius-logo.png" 
                     alt="St Athanasius School Logo" 
                     class="w-24 h-24 rounded-2xl shadow-2xl border-2 border-white/50 object-contain bg-white/10 p-2"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="w-24 h-24 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/50 flex items-center justify-center shadow-xl hidden">
                    <span class="text-5xl font-bold text-white tracking-tighter">SA</span>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold tracking-tight">Create Account</h1>
            <p id="welcome-text" class="text-lg text-white/90 mt-2 min-h-[28px]"></p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-500/80 text-white p-4 rounded-2xl text-center mb-6">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="process_signup.php" method="POST" class="space-y-5" id="signupForm">
            <div>
                <label class="block text-sm mb-2 text-white/90">Full Name</label>
                <input type="text" name="fullname" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70" 
                       placeholder="John Smith">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90">Email Address</label>
                <input type="email" name="email" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70" 
                       placeholder="john@example.com">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90">Password</label>
                <input type="password" name="password" id="password" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70" 
                       placeholder="••••••••">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70" 
                       placeholder="••••••••">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90">Register As</label>
                <select name="role" required 
                        class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-2xl font-bold text-lg transition-all">
                CREATE ACCOUNT
            </button>
        </form>

        <p class="text-center mt-6 text-white/70">
            Already have an account? 
            <a href="login.php" class="text-yellow-300 hover:underline font-medium">Login Here</a>
        </p>
    </div>

    <script>
        const typewriter = new Typewriter(document.getElementById('welcome-text'), { loop: true, delay: 75 });
        typewriter
            .typeString('Join Our Family')
            .pauseFor(2800)
            .deleteAll()
            .typeString('Create your account')
            .pauseFor(2800)
            .deleteAll()
            .start();

        // Password match validation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            if (document.getElementById('password').value !== document.getElementById('confirm_password').value) {
                e.preventDefault();
                alert("❌ Passwords do not match!");
            }
        });
    </script>
</body>
</html>