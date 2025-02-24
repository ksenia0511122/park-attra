<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('layouts.main') <!-- Подключаем главную шапку -->

    <main>
        <h1>Добро пожаловать в наш парк!</h1>
        <p>Здесь будет информация о парке развлечений.</p>
    </main>

</body>
</html>
