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
        $newPaper->year = Carbon::parse($request['year'])->setTimezone('Asia/Dhaka')->year;

        $location = public_path('/files/user_' . $user->id .'/'. $request['name']);

        $file->move(public_path('/files/users_'.$user->id), $request['name'].'.pdf');

        $newPaper->file = $location;
        $newPaper->save();

        return $newPaper;

    }
}
