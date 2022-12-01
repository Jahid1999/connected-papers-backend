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
        $paper->is_fav = 1;
        $paper->save();

        $newFav = new Favourite();
        $newFav->user_id = $user_id;
        $newFav->paper_id = $paper_id;

        $newFav->save();

        return $paper;
    }

    public function removeFromFavorites($user_id, $paper_id){
        $paper = Paper::findOrFail($paper_id);
        $paper->is_fav = 0;
        $paper->save();
        $fav = Favourite::where('paper_id', $paper_id)->firstOrFail();
        $fav->delete();

        return $fav;
    }

    public function removeFromFavorite($paper_id, $favorite_id)
    {
        // TODO: Implement removeFromFavorite() method.
        $paper = Paper::findOrFail($paper_id);
        $paper->is_fav = 0;
        $paper->save();
        $fav = Favourite::findOrFail($favorite_id);
        $fav->delete();

        return $fav;
    }

    public function getFavouriteByUserId($user_id)
    {
        // TODO: Implement getFavouriteByUserId() method.

        $user = User::findOrFail($user_id);
        $user->load('favorites', 'favorites.paper');
        return $user;
    }
}
