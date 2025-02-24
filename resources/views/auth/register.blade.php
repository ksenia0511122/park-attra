<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<main>
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <label>Имя:</label>
        <input type="text" name="name" value="{{ old('name') }}" required pattern="[А-ЯЁ][а-яё]+" title="Имя должно начинаться с заглавной буквы и содержать только буквы.">

        <label>Фамилия:</label>
        <input type="text" name="surname" value="{{ old('surname') }}" required pattern="[А-ЯЁ][а-яё]+" title="Фамилия должна начинаться с заглавной буквы и содержать только буквы.">

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Телефон:</label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+7(___)___-__-__" required>

        <label>Пароль:</label>
        <input type="password" name="password" required title="Пароль должен содержать минимум 6 символов, включая хотя бы одну букву и одну цифру.">

        <button type="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войдите</a></p>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let phoneInput = document.getElementById("phone");

        phoneInput.addEventListener("input", function() {
            let numbers = this.value.replace(/\D/g, "");
            if (numbers.length > 11) numbers = numbers.slice(0, 11);

            let formatted = "+7 ";
            if (numbers.length > 1) formatted += "(" + numbers.slice(1, 4);
            if (numbers.length > 4) formatted += ") " + numbers.slice(4, 7);
            if (numbers.length > 7) formatted += "-" + numbers.slice(7, 9);
            if (numbers.length > 9) formatted += "-" + numbers.slice(9, 11);

            this.value = formatted;
        });
    });
</script>

</body>
</html>

