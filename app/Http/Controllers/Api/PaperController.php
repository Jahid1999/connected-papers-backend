<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\CreatePaperRequest;
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
    }
}
