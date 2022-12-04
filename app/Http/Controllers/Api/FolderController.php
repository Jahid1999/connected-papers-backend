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
    public function getEverythingOfFolder($user_id, $folder_id){
        $folder = $this->folderRepository->getEverythingOfFolder($folder_id, $user_id);
        return response()->json($folder, 200);
    }

    public function parseFile(){
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile('/home/abdullah-al-jahid/Desktop/Codes/spl3/public/files/users_1/PAR-icse.2013.6606626.pdf');

        $text = $pdf->getText();
        return nl2br($text);
    }

    public function deleteFolder($folder_id){
        $folder = $this->folderRepository->deleteFolder($folder_id);
        return response()->json($folder, 200);
    }
}
