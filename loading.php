<?php
session_start();

// Debugging role
var_dump($_SESSION['role']);

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['role'])) {
   header("Location: index.php");
   exit();
}

// Determine the dashboard page based on user role
$redirectPage = ($_SESSION['role'] === 'super_admin') ? 'dashboard_super_admin.php' : 'dashboard_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Loading...</title>
   <link href="public/css/tailwind.css" rel="stylesheet">
   <style>
      .loading-overlay {
         display: flex;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.5);
         color: white;
         text-align: center;
         justify-content: center;
         align-items: center;
         z-index: 1000;
      }
      .spinner {
         border: 8px solid rgba(0,0,0,0.1);
         border-left: 8px solid #fff;
         border-radius: 50%;
         width: 50px;
         height: 50px;
         animation: spin 1s linear infinite;
         margin: auto;
      }
      @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
      }
   </style>
</head>
<body>
   <div class="loading-overlay">
      <div class="spinner"></div>
   </div>

   <script>
      // Redirect to the appropriate dashboard page after 3 seconds
      setTimeout(() => {
         window.location.href = '<?php echo $redirectPage; ?>';
      }, 3000);
   </script>
</body>
</html>
