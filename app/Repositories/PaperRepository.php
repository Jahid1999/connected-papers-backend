<?php


namespace App\Repositories;

use App\Models\Paper;
use App\Models\User;
use App\Repositories\Interfaces\PaperRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class PaperRepository implements PaperRepositoryInterface
{
    public function store(array $request, ?UploadedFile $file){
        $newPaper = new Paper();

        $user = User::findOrFail($request['user_id']);
        $newPaper->user_id = $user->id;
        $newPaper->folder_id = $request['folder_id'];
        $newPaper->name = $request['name'];
        $newPaper->author = $request['author'];
        $newPaper->year = $request['year'];
        if($request['is_public'] == true)
            $newPaper->is_public = 1;

        $location = public_path('/files/user_' . $user->id .'/'. $request['name']);

        $file->move(public_path('/files/users_'.$user->id), $request['name'].'.pdf');

        $newPaper->file = $location;
        $newPaper->save();

        $user->total_doc_uploaded +=1;
        $user->save();

        return $newPaper;

    }

    public function getSinglePaper($user_id, $paper_id){
        $paper = Paper::where('user_id', $user_id)
            -> where('id', $paper_id)
            ->get();

        return $paper;
    }
}
