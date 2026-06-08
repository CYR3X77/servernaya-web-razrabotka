<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 2</title>

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
            background: #8B0000;
            color: white;
            padding: 15px 30px;
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
            padding: 40px 20px;
        }

        .content {
            width: 100%;
            max-width: 700px;
        }

        textarea {
            width: 100%;
            height: 350px;
            padding: 15px;
            resize: none;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #8B0000;
            font-weight: bold;
        }

        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

<header>
    <img
        src="https://mospolytech.ru/local/templates/main/dist/img/logos/mospolytech-logo-white.svg"
        alt="Логотип МосПолитеха"
        class="logo"
    >

    <div class="header-title">
        Feedback form
    </div>
</header>

<main>
    <div class="content">

        <textarea readonly>
<?php
$headers = get_headers("https://httpbin.org");

foreach ($headers as $header) {
    echo $header . PHP_EOL;
}
?>
        </textarea>

        <a href="index.php" class="back-link">
            Вернуться на 1 страницу
        </a>

    </div>
</main>

<footer>
    задание для самостоятельно работы
</footer>

</body>
</html>