<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>VS Laundry</title>
   <link href="public/css/tailwind.css" rel="stylesheet">
   <style>
      .eye-icon {
         position: absolute;
         right: 10px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
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
      .toast-warning {
         background: yellow;
         color: black;
      }
      .toast-error {
         background: red;
      }
      .toast-success {
         background: green;
      }
   </style>
</head>
<body class="bg-white flex items-center justify-center h-screen">
   <div class="max-w-sm w-full items-center">
      <div class="flex justify-center mb-3">
         <img src="assets/img/laundry-logo-with-text-space-your-slogan_1447-1423.jpg" alt="Logo" class="w-[150px] h-auto">
      </div>
      <form id="loginForm" method="POST" action="login.php">
         <div class="relative mb-4">
            <input 
               id="username"
               name="username"
               class="w-full p-3 border border-gray-300 bg-blue-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
               type="text" 
               placeholder="Username"
            >
         </div>
         <div class="relative mb-6">
            <input 
               id="password"
               name="password"
               class="w-full p-3 border border-gray-300 bg-blue-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-12"
               type="password" 
               placeholder="Password"
            >
            <svg
               id="togglePassword"
               class="eye-icon w-6 h-6 text-gray-500"
               xmlns="http://www.w3.org/2000/svg"
               fill="none"
               viewBox="0 0 24 24"
               stroke="currentColor"
            >
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19c-5.523 0-10-4.477-10-10S6.477 1 12 1s10 4.477 10 10-4.477 10-10 10zm0-5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
            </svg>
         </div>
         <button 
            class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="submit"
         >
            Login
         </button>
      </form>

      <div class="text-center mt-[100px] text-gray-500 text-[12px]">
         Made with compassion by Jonathan Christiawan
      </div>
   </div>

   <!-- Toast Notifications -->
   <div id="toast-error" class="toast toast-error">
      Fill the username and password field
   </div>
   <div id="toast-warning" class="toast toast-warning">
      Warning, username or password wrong! Try again!
   </div>
   <div id="toast-success" class="toast toast-success">
      Successfully Login!
   </div>

   <script>
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      const loginForm = document.getElementById('loginForm');
      const toastError = document.getElementById('toast-error');
      const toastWarning = document.getElementById('toast-warning');
      const toastSuccess = document.getElementById('toast-success');

      togglePassword.addEventListener('click', () => {
         const type = passwordInput.type === 'password' ? 'text' : 'password';
         passwordInput.type = type;
         togglePassword.setAttribute('d', type === 'password' ? 
            'M12 19c-5.523 0-10-4.477-10-10S6.477 1 12 1s10 4.477 10 10-4.477 10-10 10zm0-5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z' :
            'M12 19c-5.523 0-10-4.477-10-10S6.477 1 12 1s10 4.477 10 10-4.477 10-10 10zm0-5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0 0a3 3 0 1 1 0-6 3 3 0 0 1 0 6z');
      });

      loginForm.addEventListener('submit', async (event) => {
         const username = document.getElementById('username').value.trim();
         const password = document.getElementById('password').value.trim();

         if (username === '' || password === '') {
            event.preventDefault(); // Prevent form submission
            toastError.style.display = 'block'; // Show error toast
            setTimeout(() => toastError.style.display = 'none', 3000); // Hide toast after 3 seconds
         } else {
            try {
               const response = await fetch('login.php', {
                  method: 'POST',
                  body: new URLSearchParams(new FormData(loginForm)),
                  headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                  }
               });

               const result = await response.text();
               console.log('Server response:', result); // Add this line to see server response in the console

               if (result.includes('Invalid username or password.')) {
                  event.preventDefault(); // Prevent form submission
                  toastWarning.style.display = 'block'; // Show warning toast
                  setTimeout(() => toastWarning.style.display = 'none', 3000); // Hide toast after 3 seconds
               } else if (result.includes('Successfully logged in')) {
                  event.preventDefault(); // Prevent form submission
                  toastSuccess.style.display = 'block'; // Show success toast
                  setTimeout(() => toastSuccess.style.display = 'none', 3000); // Hide toast after 3 seconds
                  // Optionally, redirect after successful login
                  setTimeout(() => window.location.href = 'dashboard.php', 3000); // Redirect after 3 seconds
               }
            } catch (error) {
               console.error('Error:', error);
            }
         }
      });
   </script>
</body>
</html>
