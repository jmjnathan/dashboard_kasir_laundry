<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
   <link href="public/css/tailwind.css" rel="stylesheet">
   <style>
      .sidebar {
         width: 250px;
         height: 100%;
         background: white;
         position: fixed;
         top: 0;
         left: 0;
         bottom: 0;
         padding-top: 4rem; 
      }
      .main-content {
         margin-left: 250px;
         padding: 20px;
         margin-top: 4rem; 
      }
      .navbar {
         position: fixed;
         top: 0;
         left: 250px;
         right: 0;
         background: white;
         padding: 1rem;
         border-bottom: 1px solid #ddd;
         z-index: 1000; 
      }
      .toast {
         display: none;
         position: fixed;
         top: 20px;
         right: 20px;
         padding: 15px;
         border-radius: 5px;
         z-index: 1000;
         color: #fff;
         font-weight: bold;
      }
      .toast-success {
         background: green;
      }
   </style>
</head>
<body class="bg-gray-100 h-screen">
   <!-- Sidebar -->
   <div class="sidebar">
      <div class="p-4">
         <h1 class="text-xl font-bold mb-4">Menu</h1>
         <ul>
            <li><a href="dashboard_admin.php" class="block p-3 hover:bg-gray-200">Dashboard</a></li>
            <li><a href="layanan.php" class="block p-3 hover:bg-gray-200">Layanan</a></li>
            <li><a href="transaksi.php" class="block p-3 hover:bg-gray-200">Transaksi</a></li>
            <li><a href="logout.php" class="block p-3 hover:bg-gray-200">Logout</a></li>
         </ul>
      </div>
   </div>

   <!-- Navbar -->
   <div class="navbar">
      <div class="flex items-center justify-between">
         <div class="text-lg font-semibold">Welcome, <?php echo htmlspecialchars($name); ?></div>
         <a href="logout.php" class="text-blue-600 hover:underline">Logout</a>
      </div>
   </div>

   <!-- Main Content -->
   <div class="main-content">
      <div class="bg-EAEFF2 p-6 mt-6 rounded-lg">
         <h1 class="text-2xl font-bold">This is the Admin Dashboard</h1>
         <p>Welcome to the dashboard specifically for admin users.</p>
      </div>
   </div>

   <!-- Toast Notifications -->
   <div id="toast-success" class="toast toast-success">
      Successfully logged in!
   </div>

   <script>
      document.addEventListener('DOMContentLoaded', () => {
         const urlParams = new URLSearchParams(window.location.search);
         if (urlParams.has('success')) {
            const toastSuccess = document.getElementById('toast-success');
            if (toastSuccess) {
               toastSuccess.style.display = 'block';
               setTimeout(() => toastSuccess.style.display = 'none', 3000); 
         }
      });
   </script>
</body>
</html>
