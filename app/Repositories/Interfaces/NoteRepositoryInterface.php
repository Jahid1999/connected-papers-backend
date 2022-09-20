<?php


namespace App\Repositories\Interfaces;


interface NoteRepositoryInterface
{
    public function store(array $request);
    public function getNotesOfSinglePaper($paper_id);
}
