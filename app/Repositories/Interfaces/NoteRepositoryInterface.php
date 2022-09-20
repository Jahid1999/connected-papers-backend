<?php


namespace App\Repositories\Interfaces;


interface NoteRepositoryInterface
{
    public function store(array $request);
    public function update(array $request);
    public function getNotesOfSinglePaper($paper_id);
    public function deleteNote($note_id);
}
