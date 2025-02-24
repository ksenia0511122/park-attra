<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Покупка билетов</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('layouts.tickets') <!-- Подключаем шапку для билетов -->

    <main>
        <h1>Афиша</h1>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.attractions.create') }}" class="btn btn-primary">Добавить аттракцион</a>
            @endif
        @endauth

        <div class="attractions-container">
            @foreach ($attractions as $attraction)
                <div class="attraction-card">
                    <img src="{{ asset('storage/' . ($attraction->image ?? 'default.jpg')) }}" alt="{{ $attraction->name }}">
                    <h3>{{ $attraction->name }}</h3>
                    <p class="price">200 ₽</p>
                    <div class="details">
                        <span>от 0 см</span>
                        <span>от {{ $attraction->tags->first()->name ?? 'N/A' }} лет</span>
                        <span>{{ $attraction->types->first()->name ?? 'N/A' }}</span>
                    </div>
                    <button class="btn-buy">Купить билет</button>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <form action="{{ route('admin.attractions.destroy', $attraction->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    </main>

</body>
</html>
