<?php

namespace App\Repositories;

use App\Models\Game;

class GameRepository{
    public function create(array $data){
        $game = new Game();
        $game->name = $data['name'];
        $game->description = $data['description'];
        $game->release_date = $data['release_date'];
        $game->rating = $data['rating'];
        $game->category_id = $data['category'];
        return $game->save();
    }

    public function update(array $data, int $id){
        $game = Game::find($id);

        if (!$game) {
            return redirect()->route('games.index')->with('error', 'Game não encontrado.');
        }
        
        $game->name = $data['name'];
        $game->description = $data['description'];
        $game->release_date = $data['release_date'];
        $game->rating = $data['rating'];
        $game->category_id = $data['category'];
        
        return $game->save();
    }

    public function delete (int $id){
        return Game::destroy($id);
    }

    public function find (int $id){
        return $game = Game::find($id);
    }

    public function listAll(){
        return Game::all();
    }
}