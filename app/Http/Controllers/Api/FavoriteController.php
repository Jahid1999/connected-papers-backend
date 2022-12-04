<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Graph;
use App\Models\Paper;
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

    public function search($query){
        $client = new \GuzzleHttp\Client();
        $resp = $client->get("https://serpapi.com/search.json?engine=google_scholar&q=${query}&api_key=704b6af03365473c7065b7df14d9d0cd95842350abd2dd745f7d51bbaee6d92f");

        return $resp->getBody();
    }

    public function generateGraph(){
        $graph = new Graph();
        $graph->paper_id = 17;

        $papers=['BSSE_1030.pdf', '1030_cv_Abdullah-Al-Jahid.pdf', 'CoCoNuT.pdf', 'FixMinerpdf.pdf', 'DeepFix.pdf','GenProg.pdf' , 'PAR.pdf' , 'DLFix.pdf'];
        $score = [0.1997368161405509, 0.2899368535510553, 0.9805168161405509, 0.9801368535510553, 0.9604810668052068, 0.9633309069903235, 0.9145520773143495, 0.4957995301927595];

        $graph->graph_data = json_encode(["papers"=>$papers, "scores" => $score, "source" => "TBar"]);

        $graph->save();

        return response()->json($graph, 201);
    }

    public function getGraph($file_name){
        $paper = Paper::where('name', $file_name)->firstOrFail();
        $graph = Graph::where('paper_id', $paper->id)->firstOrFail();

        $graph->graph_data = json_decode($graph->graph_data);

        return response()->json($graph, 200);
    }
}
