<?php


namespace App\Repositories;

use App\Models\Folder;
use App\Models\Note;
use App\Models\Paper;
use App\Models\User;
use App\Repositories\Interfaces\NoteRepositoryInterface;


class NoteRepository implements NoteRepositoryInterface
{
    public function store(array $request){
        $newNote = new Note();

        $user = User::findOrFail($request['user_id']);
        $paper = Paper::findOrFail($request['paper_id']);

        $newNote->user_id = $user->id;
        $newNote->paper_id = $paper->id;
        $newNote->note = $request['note'];

        $newNote->save();

        return $newNote;
    }

    public function getNotesOfSinglePaper($paper_id)
    {
        // TODO: Implement getNotesOfSinglePaper() method.
        $notes = Note::where('paper_id', $paper_id)->get();

        return $notes;
    }

    public function update(array $request)
    {
        // TODO: Implement update() method.

        $note = Note::findOrFail($request['id']);

        $note->note = $request['note'];
        $note->save();
        return $note;
    }

    public function deleteNote($note_id)
    {
        // TODO: Implement deleteNote() method.
        $note = Note::findOrFail($note_id);
        $note->delete();

        return "Note Deleted Successfully!";
    }
}
