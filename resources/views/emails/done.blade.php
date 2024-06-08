
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
            color: var(--text-white);
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
.rectangle-1 {
  width: 2000px;
  height: 400px;
  background: #8E2DE2;
  background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);
  background: linear-gradient(to right, #4A00E0, #8E2DE2);
  transform-origin: 50% 150% 0;
  position: absolute;
  left: 0;
  z-index: 0;
  transform: scale(1) rotate(-10deg); }

.rectangle-2 {
  width: 2000px;
  height: 400px;
  background: #8E2DE2;
  background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);
  background: linear-gradient(to right, #4A00E0, #8E2DE2);
  transform-origin: 65% 100% 0;
  position: absolute;
  right: 0;
  z-index: 0;
  transform: scale(1) rotate(50deg); }

@keyframes fade-in-right {
  from {
    opacity: 0;
    transform: translateX(-100vw) rotate(-15deg); }
  to {
    opacity: 1;
    transform: translateX(0) rotate(-15deg); } }

@keyframes grow1 {
  from {
    opacity: 0;
    transform: scale(2) rotate(-10deg); }
  to {
    opacity: 1;
    transform: scale(1) rotate(-10deg); } }

@keyframes grow2 {
  from {
    opacity: 0;
    transform: scale(2) rotate(50deg); }
  to {
    opacity: 1;
    transform: scale(1) rotate(50deg); } }

@keyframes fadeInFromTop {
  from {
    opacity: 0;
    transform: translateY(-20px); }
  to {
    opacity: 1;
    transform: translateY(0); } }

.rectangle-1 {
  opacity: 0;
  animation: grow1 ease 1s forwards;
  box-shadow: 0px 20px 30px 0px rgba(9, 21, 54, 0.25) !important; }

.rectangle-2 {
  opacity: 0;
  animation: grow2 ease 1s forwards;
  box-shadow: 0px 20px 30px 0px rgba(9, 21, 54, 0.25) !important; }

.rectangle-transparent-1 {
  width: 500px;
  height: 500px;
  border: 15px solid rgba(255, 255, 255, 0.08);
  position: absolute;
  left: -5%;
  bottom: -10%;
  display: block;
  animation: floating-slow ease-in-out 12s infinite; }

.rectangle-transparent-2 {
  width: 600px;
  height: 600px;
  border: 15px solid rgba(255, 255, 255, 0.08);
  position: absolute;
  right: -10%;
  top: 5%;
  display: block;
  animation: floating-slow ease-in-out 12s infinite; }

.circle-1 {
  width: 50px;
  height: 50px;
  border: 2px solid #fff;
  position: absolute;
  display: block;
  border-radius: 50%;
  transform-origin: 50% 50%;
  left: 5%;
  top: 50%;
  animation: fadeInFromTop .5s linear forwards, floating ease 4s infinite; }

.circle-2 {
  width: 70px;
  height: 70px;
  top: 20%;
  left: 83%;
  border: 2px solid #fff;
  position: absolute;
  display: block;
  border-radius: 50%;
  transform-origin: 50% 50%;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 4s infinite; }

.circle-3 {
  top: 80%;
  right: 25%;
  width: 40px;
  height: 40px;
  border: 2px solid #fff;
  position: absolute;
  display: block;
  border-radius: 50%;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 4s infinite; }

@keyframes floating {
  0% {
    transform: translate(0%, 0%) rotate(25deg); }
  25% {
    transform: translate(5%, 15%) rotate(25deg); }
  50% {
    transform: translate(10%, 5%) rotate(25deg); }
  75% {
    transform: translate(0%, 15%) rotate(25deg); }
  100% {
    transform: translate(0%, 0%) rotate(25deg); } }

@keyframes floating-slow {
  0% {
    transform: translate(0%, 0%) rotate(25deg); }
  25% {
    transform: translate(1%, 3%) rotate(25deg); }
  50% {
    transform: translate(2%, 1%) rotate(25deg); }
  75% {
    transform: translate(0%, 3%) rotate(25deg); }
  100% {
    transform: translate(0%, 0%) rotate(25deg); } }

.triangle {
  position: absolute; }

.triangle-1 {
  right: 0;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 6s infinite; }
  .triangle-1 img {
    height: 50px;
    width: 50px;
    transform: rotate(30deg); }

.triangle-2 {
  top: 30%;
  left: 20%;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 8s infinite; }
  .triangle-2 img {
    width: 75px;
    height: 75px;
    transform: rotate(15deg); }

.triangle-3 {
  top: 80%;
  left: 15%;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 10s infinite; }
  .triangle-3 img {
    width: 45px;
    height: 45px;
    transform: rotate(40deg); }

.triangle-4 {
  top: 60%;
  right: 15%;
  animation: fadeInFromTop .5s linear forwards, floating ease-in-out 5s infinite; }
  .triangle-4 img {
    width: 45px;
    height: 45px;
    transform: rotate(-40deg); }
/* في ملف CSS الخاص بك، أضف هذه الأنماط */
.glass-effect {
  backdrop-filter: blur(10px);
  background-color: rgba(255, 255, 255, 0.75);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.18);
}

/*=====  End of FORM RECTANGLE ETC  ======*/

.jumbotron h1 {
  animation: fadeInFromTop 1s ease-out forwards;
}

/*####################### End of Text Style for App ########################*/
.text-shadow-md {
  text-shadow: 0 2px 4px rgba(235, 27, 75, 0.904); /* Adjust the color and blur radius as needed */
}

    </style>
</head>
<body>
<div class='relative w-full h-screen overflow-hidden bg-cover bg-center'>
  <div class='min-h-screen flex flex-col items-center justify-center'>
    <div class='absolute inset-0 bg-gradient-to-r from-pink-500 to-blue-600 opacity-90'></div>
    
    <!-- Main content area with higher z-index -->
    <div class='z-50 flex flex-col items-center justify-center w-full px-4'>
      <div class='flex justify-center items-center text-white space-x-4 mb-10'>
        <img src="/logo.png" alt="Hadathah Logo" class="logo rounded-full h-24 w-24 md:h-32 md:w-32">
        <h1 class="text-4xl md:text-6xl lg:text-8xl font-bold" style="text-shadow: 2px 2px 16px rgba(0,0,0,0.5);">
          Hadathah<sup class="text-2xl md:text-4xl">&reg;</sup>
        </h1>
      </div>
      <div class='relative mx-auto p-4 w-full md:max-w-2xl lg:max-w-3xl bg-white bg-opacity-90 rounded-xl shadow-xl'>
        <div class='flex flex-col md:flex-row items-center justify-around'>
          <div class='md:w-1/2 p-4 bg-white rounded-lg shadow-inner text-center'>
            <h1>مرحبًا بك،</h1>
            <p>نرجو منك تفعيل حسابك بالنقر على الرابط التالي:</p>
           
    <button class="active-button">تفعيل الحساب</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Decorative elements with lower z-index -->
    <div class='absolute w-full h-full top-0 left-0 z-10'>
      <div class='hidden md:block rectangle-2'></div>
      <div class='hidden lg:block rectangle-1'></div>
      <div class='hidden sm:block rectangle-transparent-1'></div>
      <div class='rectangle-transparent-2'></div>
      <div class='circle-1'></div>
      <div class='hidden sm:block circle-2'></div>
      <div class='circle-3'></div>
      <div class='hidden md:block triangle triangle-1'>
        <img src='/obj_triangle.png' alt='Triangle 1' />
      </div>
      <div class='hidden lg:block triangle triangle-2'>
        <img src='/obj_triangle.png' alt='Triangle 2' />
      </div>
      <div class='triangle triangle-3'></div>
      <div class='hidden xl:block triangle triangle-4'>
        <img src='/obj_triangle.png' alt='Triangle 4' />
      </div>
    </div>
  </div>
</div>




</body>
</html>
