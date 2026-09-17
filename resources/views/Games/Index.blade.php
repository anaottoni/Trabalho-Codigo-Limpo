<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Games</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
            color: #222;
        }
        h1 {
            text-align: center;
        }
        form {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        .form-buttons {
            margin-top: 15px;
        }
        button, .btn {
            padding: 8px 16px;
            cursor: pointer;
        }
        .game-item {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
        }
        .game-item h3 {
            margin: 0 0 5px 0;
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
        }
        .alert-success {
            background: #d4edda;
        }
        .alert-error {
            background: #f8d7da;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

    <h1>Games</h1>

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

    <h2>Lista de games</h2>

    @forelse ($games as $item)
        <div class="game-item">
            <h3>{{ $item->name }}</h3>
            <p>{{ $item->description }}</p>
            <p><strong>Lançamento:</strong> {{ $item->release_date }}</p>

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