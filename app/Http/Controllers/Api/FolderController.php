<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Folder\CreateFolderRequest;
use App\Repositories\Interfaces\FolderRepositoryInterface;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    private $folderRepository;

    /**
     * FolderController constructor.
     */
    public function __construct(FolderRepositoryInterface $folderRepository)
    {
        $this->folderRepository = $folderRepository;
    }
    public function createFolder(CreateFolderRequest $request) {
        $folder = $this->folderRepository->store($request->validated());
        return response()->json($folder, 201);
    }
    public function getEverythingOfFolder($folder_id){
        $folder = $this->folderRepository->getEverythingOfFolder($folder_id);
        return response()->json($folder, 200);
    }
}
