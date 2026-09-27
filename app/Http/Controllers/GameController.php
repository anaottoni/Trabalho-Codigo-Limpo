<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Category;
use App\Repositories\GameRepository;

class GameController extends Controller
{
    private GameRepository $repository;
    // regras e mensagens de validação usadas tanto na criação quanto na edição 

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    // exibe a página com o formulário de criação e a listagem de games
    public function index()
    {
        return view('games.index', [
            'games' => $this->repository->listAll(),
            'game'  => null, // null = formulário no modo "criar"
            'categories' => Category::all()
        ]);
    }

    // exibe a mesma página, mas com o formulário preenchido para edição
    public function edit(int $id)
    {
        $game = $this->repository->find($id);

        if (!$game) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }

        return view('games.index', [
            'games' => $this->repository->listAll(),
            'game'  => $game, // preenche o formulário no modo "editar"
            'categories' => Category::all()
        ]);
    }

    public function store(RegisterGameRequest $request)
    {
        $validatedData = $request->validated();

        if (!$this->repository->create($validatedData)){
            return redirect()->back()->withErrors([
                'Houve um erro ao criar o jogo. tente novamente'
            ]);
        }

        return redirect()->route('games.index')->with('success', 'Jogo criado com sucesso!');
    }

    public function update(UpdateGameRequest $request)
    {
        $validatedData = $request->validated();
        
        if (!$this->repository->update($validatedData, $validatedData['id'])){
            return redirect()->back()->withErrors([
                'Erro ao salvar dados do jogo'
            ]);
        }

        return redirect()->route('games.index')->with('success', 'Game atualizado com sucesso!');
    }

    public function delete(int $id)
    {
        if (!$this->repository->find($id)) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }

        $this->repository->delete($id);

        return redirect()->route('games.index')->with('success', 'Game deletado com sucesso!');
    }
}