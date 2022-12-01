<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    private $favoriteRepository;

    /**
     * FavoriteController constructor.
     */
    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function addToFavorite($user_id, $paper_id){
        $paper = $this->favoriteRepository->addToFavorite($user_id, $paper_id);

        return response()->json($paper, 200);
    }
    public function removeFromFavorites($user_id, $paper_id){
        $paper = $this->favoriteRepository->removeFromFavorites($user_id, $paper_id);

        return response()->json($paper, 200);
    }
    public function removeFromFavorite($paper_id, $favorite_id){
        $paper = $this->favoriteRepository->removeFromFavorite($paper_id, $favorite_id);

        return response()->json($paper, 200);
    }

    public function getFavouriteByUserId($user_id) {
        $papers = $this->favoriteRepository->getFavouriteByUserId($user_id);

        return response()->json($papers, 200);
    }
}
