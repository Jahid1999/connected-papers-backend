<?php


namespace App\Repositories\Interfaces;


interface FavoriteRepositoryInterface
{
    public function addToFavorite($user_id, $paper_id);
    public function removeFromFavorites($user_id, $paper_id);
    public function removeFromFavorite($paper_id, $favorite_id);
    public function getFavouriteByUserId($user_id);
}
