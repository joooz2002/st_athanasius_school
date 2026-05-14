<?php 
session_start();

// ✅ Change this line if you still have include error
include('../config/db.php');     // Try this first
// include('../db.php');        // Uncomment if above doesn't work

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - St Athanasius School</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background-image: url('../assets/images/bg pic.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }
    .overlay {
      background: rgba(15, 23, 42, 0.88);
    }
    .glass {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .sidebar-item {
      transition: all 0.3s ease;
    }
    .sidebar-item:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateX(8px);
    }
    .active {
      background: rgba(59, 130, 246, 0.9) !important;
      border-left: 4px solid #3b82f6;
    }
  </style>
</head>
<body class="min-h-screen text-white">

<div class="flex h-screen">

  <!-- SIDEBAR -->
  <div class="w-72 glass border-r border-white/10 flex flex-col">
    
    <!-- Logo -->
    <div class="p-6 border-b border-white/10">
      <div class="flex items-center gap-3">
       <img src="../assets/images/st-athanasius-logo.png" 
     alt="Logo" 
     class="w-16 h-16 object-contain">
        <div>
          <h2 class="text-2xl font-bold">St Athanasius</h2>
          <p class="text-slate-400 text-sm">Theology School</p>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
      <a href="dashboard.php" class="sidebar-item active flex items-center gap-3 px-5 py-3 rounded-xl text-white">
        <i class="fas fa-home w-5"></i> Overview
      </a>
      <a href="users.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-users w-5"></i> User Management
      </a>
      <a href="courses.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-book w-5"></i> Courses & Lessons
      </a>
      <a href="bible.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-bible w-5"></i> Bible & Doctrine
      </a>
      <a href="quizzes.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-question-circle w-5"></i> Exams & Quizzes
      </a>
      <a href="progress.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-chart-bar w-5"></i> Progress & Analytics
      </a>
      <a href="announcements.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-bullhorn w-5"></i> Announcements
      </a>
      <a href="content.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-folder-open w-5"></i> Content Management
      </a>
      <a href="logs.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-shield-alt w-5"></i> Security & Logs
      </a>
      <a href="settings.php" class="sidebar-item flex items-center gap-3 px-5 py-3 rounded-xl">
        <i class="fas fa-cog w-5"></i> Settings
      </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-white/10">
      <a href="../logout.php" 
         class="flex items-center gap-3 px-5 py-3 rounded-xl text-red-400 hover:bg-red-500/20 transition-colors">
        <i class="fas fa-sign-out-alt"></i> 
        Logout
      </a>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="flex-1 overflow-auto">
    <div class="overlay min-h-screen p-8">
      
      <!-- Top Bar -->
      <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold">Admin Control Center</h1>
        <div class="flex items-center gap-4">
          <span class="text-slate-300">Welcome, <strong><?php echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); ?></strong></span>
          <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center font-bold border border-white/30">
            <?php echo strtoupper(substr($_SESSION['name'] ?? 'A', 0, 1)); ?>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass rounded-2xl p-6">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-slate-300">Total Students</p>
              <h3 class="text-5xl font-bold mt-2">248</h3>
              <p class="text-emerald-400 text-sm mt-1">+18 this week</p>
            </div>
            <i class="fas fa-users text-5xl text-white/30"></i>
          </div>
        </div>

        <div class="glass rounded-2xl p-6">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-slate-300">Active Courses</p>
              <h3 class="text-5xl font-bold mt-2">24</h3>
            </div>
            <i class="fas fa-book text-5xl text-white/30"></i>
          </div>
        </div>

        <div class="glass rounded-2xl p-6">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-slate-300">New Signups</p>
              <h3 class="text-5xl font-bold mt-2">12</h3>
            </div>
            <i class="fas fa-user-plus text-5xl text-white/30"></i>
          </div>
        </div>

        <div class="glass rounded-2xl p-6">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-slate-300">Pending Approvals</p>
              <h3 class="text-5xl font-bold mt-2 text-amber-400">7</h3>
            </div>
            <i class="fas fa-bell text-5xl text-white/30"></i>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="mt-10 glass rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-5 flex items-center gap-2">
          <i class="fas fa-clock"></i> Recent Activity
        </h2>
        <div class="space-y-4 text-slate-200">
          <div class="flex items-center gap-4 bg-white/5 p-4 rounded-xl">
            <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center">✓</div>
            <div class="flex-1">
              <p><strong>John Mutua</strong> completed <strong>Dogma Lesson 5</strong></p>
            </div>
            <span class="text-sm text-slate-400">2 hours ago</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>