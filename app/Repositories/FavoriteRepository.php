<?php


namespace App\Repositories;

use App\Models\Favourite;
use App\Models\Folder;
use App\Models\Paper;
use App\Models\User;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;


class FavoriteRepository implements FavoriteRepositoryInterface
{

    public function addToFavorite($user_id, $paper_id)
    {
        // TODO: Implement addToFavorite() method.
        $paper = Paper::findOrFail($paper_id);

        $newFav = new Favourite();
        $newFav->user_id = $user_id;
        $newFav->paper_id = $paper_id;

        $newFav->save();

        return $paper;
    }
}
