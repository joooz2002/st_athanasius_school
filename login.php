<?php
session_start();
require_once 'config/db.php';   // Make sure this path is correct

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } elseif ($_SESSION['role'] == 'teacher') {
        header("Location: teacher/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}
?>

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
        background: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.45)),
                    url('assets/images/bg pic.jpg') center/cover no-repeat fixed;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 3px solid rgba(255, 255, 255, 0.55);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.45);
        max-width: 480px;           /* ← Increased Width */
        width: 120%;
        border-radius: 34px;
        padding: 45px 40px;         /* Slightly more padding */
        color: white;
    }
</style>
<body class="text-white">

    <div class="glass">
      <!-- Clean Logo - Just the Image (Bigger) -->
<div class="text-center mb-8">
    <div class="flex justify-center mb-6">
        <img src="assets/images/st-athanasius-logo.png" 
             alt="St Athanasius School Logo" 
             class="w-36 h-36 object-contain drop-shadow-2xl">
    </div>
</div>

        <h1 class="text-3xl font-bold text-center">St Athanasius School</h1>
        <p id="welcome-text" class="text-center text-lg text-white/90 mt-2"></p>

        <!-- Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-500/80 text-white p-4 rounded-2xl text-center mb-6">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="process_login.php" method="POST" class="space-y-6 mt-8">
            <div>
                <label class="block text-sm mb-2 text-white/90">Username / Email</label>
                <input type="text" name="email" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70"
                       placeholder="example@gmail.com">
            </div>

            <div>
                <label class="block text-sm mb-2 text-white/90">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 focus:outline-none focus:border-white/80 text-white placeholder-white/70"
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
                    class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-2xl font-bold text-lg transition-all">
                LOGIN
            </button>
        </form>

        <p class="text-center mt-6 text-white/70">
            Don't have an account? 
            <a href="signup.php" class="text-yellow-300 hover:underline font-medium">Register Here</a>
        </p>
    </div>

    <script>
        const welcomeEl = document.getElementById('welcome-text');
        const typewriter = new Typewriter(welcomeEl, { loop: true, delay: 75 });
        typewriter
            .typeString('Welcome Back')
            .pauseFor(2500)
            .deleteAll()
            .typeString('Glad to see you again!')
            .pauseFor(2500)
            .deleteAll()
            .start();
    </script>
</body>
</html>