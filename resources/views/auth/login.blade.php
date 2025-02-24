<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main>
        <h1>Вход</h1>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Пароль:</label>
            <input type="password" name="password" required>
            <button type="submit">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="{{ route('register') }}">Зарегистрируйтесь</a></p>
    </main>

</body>
</html>
