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
}
