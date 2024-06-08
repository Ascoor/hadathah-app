<!DOCTYPE html>
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

        body {
            font-family: 'Cairo', sans-serif;
        }

        .active-button {
            background-color: var(--hadathah-cyan);
            color: var(--text-white);
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .active-button:hover {
            background-color: var(--hadathah-dark-cyan);
        }

        .background-gradient {
            background: linear-gradient(to right, var(--bg-gradient-start), var(--bg-gradient-end));
            color: var(--text-white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        .logo {
            height: 60px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="background-gradient">
        <div class="content">
            <img src="/logo.png" alt="Hadathah Logo" class="logo">
            <h1>مرحبًا بك، {{ $user->name }}</h1>
            <p>يمكنك تفعيل حسابك بالضغط على زر تفعيل الحساب</p>
            <a href="{{ url('https://api.hadathah.org/activate/' . $user->activation_code) }}" class="active-button">تفعيل الحساب</a>
        </div>
    </div>
</body>
</html>
