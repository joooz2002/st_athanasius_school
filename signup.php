<?php
session_start();
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: signup.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        header("Location: signup.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Email already exists";
        header("Location: signup.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Account created successfully!";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Signup failed";
        header("Location: signup.php");
    }
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
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 460px;           /* Closer to screenshot */
            border-radius: 16px;        /* Reduced radius */
            padding: 40px 35px;
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
            <!-- Centered Logo -->
            <div class="flex justify-center mb-5">
                <img src="assets/images/st-athanasius-logo.png" 
                     alt="St Athanasius School Logo" 
                     class="w-20 h-20 rounded-2xl shadow-2xl border-2 border-white/50 object-contain bg-white/10 p-2"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md border-2 border-white/50 flex items-center justify-center shadow-xl hidden">
                    <span class="text-5xl font-bold text-white tracking-tighter">SA</span>
                </div>
            </div>
            
            <h1 class="text-3xl font-bold tracking-tight">Create Account</h1>
            <p id="welcome-text" class="text-lg text-white/90 mt-1">Join Our Family</p>
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
                       placeholder="example@gmail.com">
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

            <!-- Role Dropdown -->
            <div class="relative">
                <label class="block text-sm mb-2 text-white/90">Register As</label>
                <input type="hidden" name="role" id="roleInput" value="student">

                <button type="button" onclick="toggleDropdown()" id="roleButton"
                        class="w-full px-5 py-4 rounded-2xl bg-white/20 border border-white/40 
                               text-left text-white flex justify-between items-center hover:bg-white/30 transition-all">
                    <span id="selectedRole" class="font-medium">Student</span>
                    <span class="text-xl transition-transform duration-200" id="arrow">▼</span>
                </button>

                <div id="dropdown" class="hidden absolute left-0 right-0 mt-2 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/30 overflow-hidden z-50 py-1">
                    <div onclick="selectRole('student')" class="px-5 py-3 hover:bg-blue-50 text-gray-800 cursor-pointer transition-colors font-medium">Student</div>
                    <div onclick="selectRole('teacher')" class="px-5 py-3 hover:bg-blue-50 text-gray-800 cursor-pointer transition-colors font-medium">Teacher</div>
                    <div onclick="selectRole('admin')" class="px-5 py-3 hover:bg-blue-50 text-gray-800 cursor-pointer transition-colors font-medium">Admin</div>
                </div>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-2xl font-bold text-lg transition-all shadow-lg">
                CREATE ACCOUNT
            </button>
        </form>

        <p class="text-center mt-6 text-white/70 text-sm">
            Already have an account? 
            <a href="login.php" class="text-yellow-300 hover:underline font-medium">Login Here</a>
        </p>
    </div>

    <script>
        // Typewriter Effect
        const typewriter = new Typewriter(document.getElementById('welcome-text'), { loop: true, delay: 75 });
        typewriter
            .typeString('Join Our Family')
            .pauseFor(2800)
            .deleteAll()
            .typeString('Create your account')
            .pauseFor(2800)
            .deleteAll()
            .start();

        // Dropdown Functions
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdown");
            const arrow = document.getElementById("arrow");
            dropdown.classList.toggle("hidden");
            arrow.style.transform = dropdown.classList.contains("hidden") ? "rotate(0deg)" : "rotate(180deg)";
        }

        function selectRole(role) {
            document.getElementById("roleInput").value = role;
            document.getElementById("selectedRole").innerText = role.charAt(0).toUpperCase() + role.slice(1);
            document.getElementById("dropdown").classList.add("hidden");
            document.getElementById("arrow").style.transform = "rotate(0deg)";
        }

        document.addEventListener("click", function(e) {
            if (!e.target.closest(".relative")) {
                document.getElementById("dropdown").classList.add("hidden");
                document.getElementById("arrow").style.transform = "rotate(0deg)";
            }
        });

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