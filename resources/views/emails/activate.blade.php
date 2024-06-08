<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفعيل حساب تطبيق حداثة</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #5D1049;
        }
        p {
            color: #4A4A4A;
        }
        a {
            display: inline-block;
            background-color: #0A8F08;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a:hover {
            background-color: #0C6C1B;
        }
    </style>
</head>
<body>
    <h1> مرحبًا بك، {{ $user->name }}</h1>
    <p>نرجو منك تفعيل حسابك بالنقر على الرابط التالي:</p>
 <a href="{{ url('https://api.hadathah.org/activate/' . $user->activation_code) }}">تفعيل الحساب</a>
</body>
</html>
