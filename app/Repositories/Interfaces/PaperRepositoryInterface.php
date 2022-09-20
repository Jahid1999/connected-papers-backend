<?php


namespace App\Repositories\Interfaces;


use Illuminate\Http\UploadedFile;

interface PaperRepositoryInterface
{
    public function store(array $request, ?UploadedFile $file);
}
