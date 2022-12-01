<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\UploadedFile;

interface PaperRepositoryInterface
{
    public function store(array $request, ?UploadedFile $file);
    public function getSinglePaper($user_id, $paper_id);
}
