<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback form</title>

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

        .form-container {
            width: 100%;
            max-width: 500px;
            background: #f5f5f5;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .checkbox-group {
            margin-top: 10px;
        }

        .checkbox-group label {
            font-weight: normal;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #8B0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #a00000;
        }

        .page-link {
            display: block;
            text-align: center;
            margin-top: 20px;
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
    <div class="form-container">

        <h2>Форма обратной связи</h2>

        <form action="https://httpbin.org/post" method="POST">

            <label for="name">Имя пользователя</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-mail пользователя</label>
            <input type="email" id="email" name="email" required>

            <label for="type">Тип обращения</label>
            <select id="type" name="type">
                <option value="Жалоба">Жалоба</option>
                <option value="Предложение">Предложение</option>
                <option value="Благодарность">Благодарность</option>
            </select>

            <label for="message">Текст обращения</label>
            <textarea id="message" name="message" required></textarea>

            <label>Вариант ответа</label>

            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="answer[]" value="SMS">
                    SMS
                </label>

                <label>
                    <input type="checkbox" name="answer[]" value="E-mail">
                    E-mail
                </label>
            </div>

            <button type="submit" class="btn">
                Отправить
            </button>

        </form>

        <a href="page2.php" class="page-link">
            Перейти на 2 страницу
        </a>

    </div>
</main>

<footer>
    задание для самостоятельной работы
</footer>

</body>
</html>