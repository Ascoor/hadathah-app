<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفعيل حساب تطبيق حداثة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #F3F4F6; /* Light grey background for a subtle look */
            color: #333333; /* Dark grey text for readability */
            padding: 40px;
            text-align: center;
        }
        h1 {
            color: #003366; /* Dark blue for a professional look */
            margin-bottom: 24px;
        }
        p {
            color: #555555; /* Slightly lighter grey for less contrast */
            font-size: 16px;
        }
        a {
            display: inline-block;
            background-color: #4A90E2; /* A cheerful blue */
            color: #FFFFFF; /* White text for contrast */
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-family: 'Roboto', sans-serif; /* Secondary font for a modern look */
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }
        a:hover {
            background-color: #3D7EBB; /* A darker blue on hover */
        }
        .logo {
            width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <img src="https://api.hadathah.org/path_to_your_logo.png" alt="Hadathah Logo" class="logo">
    <h1>مرحبًا بك، {{ $user->name }}</h1>
    <p>نرجو منك تفعيل حسابك بالنقر على الرابط التالي:</p>
    <a href="{{ url('https://api.hadathah.org/activate/' . $user->activation_code) }}">تفعيل الحساب</a>
</body>
</html>
