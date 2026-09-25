<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
            color: #0A3323;
            background-color: #F7F4D5;
        }
        h1, h2 {
            text-align: center;
            color: #0A3323;
        }
        form {
            background: #D3968C;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            color: #0A3323;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #0A3323;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
            border: 0px;
            border-radius: 4px;
            background-color: #faf9f0;
            color: #0A3323;
        }
        .form-buttons {
            margin-top: 15px;
        }
        button, .btn {
            padding: 8px 16px;
            cursor: pointer;
            background-color: #105666;
            color: #F7F4D5;
            border: none;
            border-radius: 4px;
        }
        .game-item {
            background: #839958;
            color: #F7F4D5;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
        }
        .game-item h3 {
            margin: 0 0 5px 0;
            color: #0A3323;
        }
        .game-actions {
            margin-top: 8px;
        }
        .game-actions form {
            display: inline;
            background: none;
            padding: 0;
        }
        .alert {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            color: #ffffff;
        }
        .alert-success {
            background: #839958;
        }
        .alert-error {
            background: #D3968C;
        }
        .error {
            color: #0A3323;
            font-size: 0.9em;
            font-weight: bold;
        }
        a{
            text-decoration: none;
        }
    </style>
    <link rel="icon" href="{{ asset('images/flower.png')}}">
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

        <label for="rating">Nota</label>
        <select name="rating" id="rating"> 
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
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
        <p>Nenhum game cadastrado.</p>
    @endforelse

</body>
</html>