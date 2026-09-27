<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Category;
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
            'categories' => Category::all()
        ]);
    }

    public function edit(int $id)
    {
        $game = $this->repository->find($id);

        return view('games.index', [
            'games' => $this->repository->listAll(),
            'game'  => $game, 
            'categories' => Category::all()
        ]);
    }

    public function store(RegisterGameRequest $request)
    {
        $validatedData = $request->validated();

        $this->repository->create($validatedData);

        return redirect()->route('games.index')->with('success', 'Jogo criado com sucesso!');
    }

    public function update(UpdateGameRequest $request)
    {
        $validatedData = $request->validated();
        
        $this->repository->update($validatedData, $validatedData['id']);

        return redirect()->route('games.index')->with('success', 'Game atualizado com sucesso!');
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);

        return redirect()->route('games.index')->with('success', 'Game deletado com sucesso!');
    }
}