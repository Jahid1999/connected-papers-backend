<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\CreatePaperRequest;
use App\Models\Paper;
use App\Repositories\Interfaces\PaperRepositoryInterface;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    private $paperRepository;

    /**
     * PaperController constructor.
     */
    public function __construct(PaperRepositoryInterface $paperRepository)
    {
        $this->paperRepository = $paperRepository;
    }

    public function storePapers(CreatePaperRequest $request){
        $paper = $this->paperRepository->store($request->validated(), $request->file('file'));

        return response()->json($paper, 201);
    }

    public function getPaper($user_id, $paper_id) {
        $paper = Paper::findOrFail($paper_id);
        $location = public_path('/files/users_'.$user_id.'/'. $paper->name . '.pdf');
        return response()->file($location);
    }

    public function getSinglePaper($user_id, $paper_id){
        $paper = $this->paperRepository->getSinglePaper($user_id, $paper_id);

        return response()->json($paper, 200);
    }
}
