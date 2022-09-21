<?php


namespace App\Repositories\Interfaces;


interface FavoriteRepositoryInterface
{
    public function addToFavorite($user_id, $paper_id);
    public function removeFromFavorite($paper_id, $favorite_id);
}
