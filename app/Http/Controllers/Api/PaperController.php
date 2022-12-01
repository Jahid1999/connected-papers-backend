<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\CreatePaperRequest;
use App\Models\Favourite;
use App\Models\Note;
use App\Models\Paper;
use App\Repositories\Interfaces\PaperRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     public function downloadPaper($user_id, $paper_id) {
        $paper = Paper::findOrFail($paper_id);
        $location = public_path('/files/users_'.$user_id.'/'. $paper->name . '.pdf');
        return response()->download($location);
    }


    public function getPapers() {
        $papers = Paper::where('is_public', 1)->get();
        return response()->json($papers, 200);
    }

    public function getSinglePaper($user_id, $paper_id){
        $paper = $this->paperRepository->getSinglePaper($user_id, $paper_id);

        return response()->json($paper, 200);
    }

    public function removePaper($paper_id){
        $paper = Paper::findOrFail($paper_id);
        $fav= Favourite::where('paper_id', $paper_id)->first();
        $note = Note::where('paper_id', $paper_id)->first();
        if($fav)
            $fav->delete();
        if($note)
            $note->delete();
        $paper->delete();

        return response()->json("Deleted", 200);
    }
}
