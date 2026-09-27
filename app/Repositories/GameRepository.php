<?php

namespace App\Repositories;

use App\Exceptions\GameNotFoundException;
use App\Models\Category;
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
        $game = $this->find($id);
 
        $game->name = $data['name'];
        $game->description = $data['description'];
        $game->release_date = $data['release_date'];
        $game->rating = $data['rating'];
        $game->category_id = $data['category'];
        
        return $game->save();
    }

    public function delete (int $id){
        $game = $this->find($id);
        
        return $game->delete();
    }

    public function find (int $id){
        $game = Game::find($id);

        if (!$game){
            throw new GameNotFoundException();
        }
        
        return $game;
    }

    public function listAll(){
        return Game::all();
    }

    public function getCategories (){
        return Category::all();
    }
}