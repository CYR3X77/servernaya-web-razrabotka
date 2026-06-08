<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello, World!</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #311b30;
            color: white;
        }

        .logo {
            height: 60px;
        }

        .header-title {
            flex: 1;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-right: 60px;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .dynamic-content {
            font-size: 32px;
            margin-bottom: 15px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

<header>
    
    <img src="https://mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg" alt="Логотип МосПолитеха" class="logo">

    <div class="header-title">
        Задание «Hello, World!»
    </div>
</header>

<main>
    <div class="dynamic-content">
        <?php
            echo "Hello, World!";
        ?>
    </div>

    <p>
        Текущее время:
        <?php
            date_default_timezone_set('Europe/Moscow');
            echo date('d.m.Y H:i:s');
        ?>
    </p>
</main>

<footer>
    задание для самостоятельной работы
</footer>

</body>
</html>