<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Repositories\Interfaces\NoteRepositoryInterface;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    private $noteRepository;

    /**
     * FolderController constructor.
     */
    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function createNote(CreateNoteRequest $request){
        $note = $this->noteRepository->store($request->validated());

        return response()->json($note, 201);
    }

    public function getNotesOfSinglePaper($paper_id){
        $notes = $this->noteRepository->getNotesOfSinglePaper($paper_id);

        return response()->json($notes, 200);
    }
}
