<?php


namespace App\Repositories\Interfaces;


interface FolderRepositoryInterface
{
    public function store(array $request);
    public function getEverythingOfFolder($folder_id, $user_id);
}
