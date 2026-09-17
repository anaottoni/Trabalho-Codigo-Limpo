<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    // regras e mensagens de validação usadas tanto na criação quanto na edição
    private array $rules = [
        'name'         => 'required|string|max:255',
        'description'  => 'required|string|max:500',
        'release_date' => 'required|date',
    ];

    private array $messages = [
        'name.required' => 'O nome do jogo é obrigatório.',
        'name.string' => 'O nome do jogo deve ser uma string válida.',
        'name.max' => 'O nome do jogo deve ter no máximo 255 caracteres.',
        'description.required' => 'A descrição do jogo é obrigatória.',
        'description.string' => 'A descrição deve ser uma string válida.',
        'description.max' => 'A descrição deve ter no máximo 500 caracteres.',
        'release_date.required' => 'A data de lançamento é obrigatória.',
        'release_date.date' => 'A data de lançamento deve ser uma data válida.',
    ];

    // exibe a página com o formulário de criação e a listagem de games
    public function index()
    {
        return view('games.index', [
            'games' => Game::all(),
            'game'  => null, // null = formulário no modo "criar"
        ]);
    }

    // exibe a mesma página, mas com o formulário preenchido para edição
    public function edit(int $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }

        return view('games.index', [
            'games' => Game::all(),
            'game'  => $game, // preenche o formulário no modo "editar"
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->route('games.index')
                ->withErrors($validator)
                ->withInput();
        }

        $game = new Game();
        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->release_date = $request->input('release_date');
        $game->save();

        return redirect()->route('games.index')->with('success', 'Game criado com sucesso!');
    }

    public function update(Request $request, int $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }

        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            return redirect()->route('games.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $game->name = $request->input('name');
        $game->description = $request->input('description');
        $game->release_date = $request->input('release_date');
        $game->save();

        return redirect()->route('games.index')->with('success', 'Game atualizado com sucesso!');
    }

    public function delete(int $id)
    {
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }

        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deletado com sucesso!');
    }
}