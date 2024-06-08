<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفعيل حساب تطبيق حداثة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">


    <style>
        :root {
            --hadathah-cyan: #4A90E2;
            --hadathah-dark-cyan: #3D7EBB;
            --text-white: #FFFFFF;
            --bg-gradient-start: #4A00E0;
            --bg-gradient-end: #8E2DE2;
        }

        .background-gradient {
            background: linear-gradient(to right, var(--bg-gradient-start), var(--bg-gradient-end));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .active-button {
            background-color: var(--hadathah-cyan);
            color: var(--text-white);
            padding: 12px 24px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px; /* Adjusted for better readability */
        }

        .active-button:hover {
            background-color: var(--hadathah-dark-cyan);
        }
        /* Additional CSS might go here */
        .logo {
            height: 120px; /* Adjust logo size */
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
<div class='background-gradient'>
    <!-- Main content area with higher z-index -->
    <div class='z-50 flex flex-col items-center justify-center mt-10 w-full px-4'>
      <div class='flex justify-center items-center text-white space-x-4 mb-10'>
        <h1 class="text-4xl md:text-6xl lg:text-8xl font-bold" style="text-shadow: 2px 2px 16px rgba(0,0,0,0.5);">
          Hadathah<sup class="text-2xl md:text-4xl">&reg;</sup>
        </h1>
      </div>
      <div class='relative mx-auto p-4 w-full md:max-w-2xl lg:max-w-3xl bg-white bg-opacity-90 rounded-xl shadow-xl'>
        <div class='flex flex-col md:flex-row items-center justify-around'>
          <div class='md:w-1/2 p-4 rounded-lg shadow-inner text-center'>
          <h1 class="text-2xl md:text-2xl lg:text-4xl mb-4 font-bold">مرحبًا بك، {{ $user->name }}</h1>
                    <p class="text-xl mb-4">يمكنك تفعيل حسابك بالضغط على زر تفعيل الحساب</p>  

          <a href="{{ url('https://api.hadathah.org/activate/' . $user->activation_code) }}" class="active-button inline-block">تفعيل الحساب</a>
        </div>
      </div>
    </div>
</div>


</div>




</body>
</html>
