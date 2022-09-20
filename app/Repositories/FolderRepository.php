<?php


namespace App\Repositories;

use App\Models\Folder;
use App\Models\Paper;
use App\Models\User;
use App\Repositories\Interfaces\FolderRepositoryInterface;


class FolderRepository implements FolderRepositoryInterface
{
    public function store(array $request){
        $newFolder = new Folder();
        $user = User::findOrFail($request['user_id']);
        $newFolder->user_id = $user->id;
        $newFolder->name = $request['name'];
        if(isset($request['parent_id'])){
            $newFolder->parent_id = $request['parent_id'];
        }
        $newFolder->save();

        return $newFolder;
    }

    public function getEverythingOfFolder($folder_id)
    {
        // TODO: Implement getEverythingOfFolder() method.
        $folders = Folder::where('parent_id', $folder_id)->get();
        $files = Paper::where('folder_id', $folder_id)->get();
        return ['folders' => $folders,
                'files' => $files
            ];
    }
}
