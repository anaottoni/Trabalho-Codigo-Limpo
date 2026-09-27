<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <link rel="icon" href="{{ asset('images/flower.png')}}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <h1>Jogos</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form action="{{ $game ? route('games.update', $game->id) : route('games.store') }}" method="POST">
        @csrf
        @if ($game)
            @method('PUT')
        @endif

        <label for="name">Nome</label>
        <input type="text" id="name" name="name" value="{{ old('name', $game->name ?? '') }}" required>

        <label for="description">Descrição</label>
        <textarea id="description" name="description" rows="3" required>{{ old('description', $game->description ?? '') }}</textarea>

        <label for="release_date">Data de lançamento</label>
        <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $game->release_date ?? '') }}" required>

        <label for="category">Categoria</label>
        <select name="category" id="category"> 
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category', $game->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="rating">Nota</label>
        <select name="rating" id="rating"> 
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" @selected(old('rating', $game->rating ?? '') == $i)>
                    {{ $i }}
                </option>
            @endfor
        </select>

        @foreach ($errors->all() as $error)
            <div class="error">{{ $error }}</div>
        @endforeach

        <div class="form-buttons">
            <button type="submit">{{ $game ? 'Atualizar game' : 'Criar game' }}</button>
            @if ($game)
                <a href="{{ route('games.index') }}" class="btn">Cancelar edição</a>
            @endif
        </div>
    </form>

    <h2>Lista de Jogos</h2>

    @forelse ($games as $item)
        <div class="game-item">
            <h3>{{ $item->name }}</h3>
            <p><strong>{{ $item->category->name}}</strong></p>
            <p>{{ $item->description }}</p>
            <p><strong>Lançamento:</strong> {{ $item->release_date }}</p>
            <p><strong>Nota:</strong> {{ $item->rating }}</p>

            <div class="game-actions">
                <a href="{{ route('games.edit', $item->id) }}" class="btn">Editar</a>

                <form action="{{ route('games.delete', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este game?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar</button>
                </form>
            </div>
        </div>
    @empty
        <p>Nenhum jogo cadastrado.</p>
    @endforelse

</body>
</html>