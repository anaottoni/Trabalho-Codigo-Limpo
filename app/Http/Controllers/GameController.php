<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Repositories\GameRepository;

class GameController extends Controller
{
    private GameRepository $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('games.index', [
            'games' => $this->repository->listAll(),
            'game'  => null, 
            'categories' => $this->repository->getCategories()
        ]);
    }

    public function edit(int $id)
    {
        $game = $this->repository->find($id);

        return view('games.index', [
            'games' => $this->repository->listAll(),
            'game'  => $game, 
            'categories' => $this->repository->getCategories()
        ]);
    }

    public function store(RegisterGameRequest $request)
    {
        $validatedData = $request->validated();

        $this->repository->create($validatedData);

        return redirect()->route('games.index')->with('success', 'Jogo criado com sucesso!');
    }

    public function update(UpdateGameRequest $request, int $id)
    {
        $validatedData = $request->validated();
        
        $this->repository->update($validatedData, $id);

        return redirect()->route('games.index')->with('success', 'Game atualizado com sucesso!');
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);

        return redirect()->route('games.index')->with('success', 'Game deletado com sucesso!');
    }
}