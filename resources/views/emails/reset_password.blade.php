<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور لحسابك فى تطبيق حداثة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --hadathah-cyan: #E6E6FA;
            --hadathah-dark-cyan: #3D7EBB;
            --text-white: #FFFFFF;
            --bg-gradient-start: #4B0082;
            --bg-gradient-end: #8A2BE2;
            --shadow-color: rgba(0, 0, 0, 0.3);
            --button-gradient-start: #6A5ACD;
            --button-gradient-end: #483D8B;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to right, var(--bg-gradient-start), var(--bg-gradient-end));
            color: var(--text-white);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .active-button {
            background: linear-gradient(to right, var(--button-gradient-start), var(--button-gradient-end));
            color: var(--text-white);
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 6px var(--shadow-color);
        }

        .active-button:hover {
            background: linear-gradient(to right, var(--button-gradient-end), var(--button-gradient-start));
            transform: translateY(-2px);
        }

        .content {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 6px var(--shadow-color);
            color: #000;
        }

        h1 {
            margin-bottom: 20px;
            color: #000;
            text-shadow: 1px 1px 2px var(--shadow-color);
        }

        p {
            margin-bottom: 20px;
            color: #000;
            text-shadow: 1px 1px 2px var(--shadow-color);
        }

        .logo {
            height: 60px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <img src="https://api.hadathah.org/logo.png" alt="Hadathah Logo" class="logo">
        <h1>مرحبًا بك،</h1>
        <p>يمكنك إعادة تعيين كلمة المرور لحسابك بالضغط على زر تفعيل الحساب</p>
        <a href="{{ $resetUrl }}" class="active-button">إعادة تعيين كلمة المرور</a>
    </div>
</body>
</html>
