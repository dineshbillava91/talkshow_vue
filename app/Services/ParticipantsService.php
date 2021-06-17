<?php
namespace App\Services;

use App\Models\Talks;
use App\Models\Rating;
use App\Models\Participants;
use App\Models\Tag;
use App\User;
use App\Models\User_ratings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParticipantsService{
    /**
     * Return all data required for participant talk display
     */
    public function getAllData($id, $speaker_id){
        $user_id = Auth::user()->id;

        $result['participants'] = User::where('role_id',2)->get();
        $result['tags'] = Tag::all();
        $result['ratings'] = Rating::all();
        $result['user_rating'] = User_ratings::where('user_id',$user_id)->where('talk_id',$id)->get();
        $result['recommended_talks'] = Talks::with(['event'])->where('speaker_id',$speaker_id)->whereJsonContains('participants',(string)$user_id)->where('id', '!=' , $id)->take(5)->get();
    
        return $result;
    }
}
?>