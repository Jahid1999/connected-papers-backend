<?php


namespace App\Repositories;

use App\Models\Paper;
use App\Models\User;
use App\Repositories\Interfaces\PaperRepositoryInterface;
use Carbon\Carbon;

class PaperRepository implements PaperRepositoryInterface
{
    public function store(array $request){
        $newPaper = new Paper();

        $user = User::findOrFail($request['user_id']);
        $newPaper->user_id = $user->id;
        $newPaper->name = $request['name'];
        $newPaper->author = $request['author'];
        $newPaper->year = Carbon::parse($request['year'])->setTimezone('Asia/Dhaka')->year;


//        if ($request['photo']) {
//            if($request['photo']  != $client->photo) {
//                $filename = random_string(5) . time() . '.' . explode(';', explode('/', $request['photo'])[1])[0];
//                $location = public_path('/images/clients/' . $filename);
//
//                Image::make($request['photo'])->save($location);
//                $client->photo = $filename;
//            }
//
//        }
    }
}
