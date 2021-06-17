<?php
namespace App\Services;

use App\Models\Talks;
use App\Models\Speaker;
use App\Models\Event;
use App\Models\Participants;
use App\Models\Tag;
use App\User;
use Illuminate\Support\Facades\DB;

class TalksService{
    /**
     * Search talks using speaker and tags
     */
    public function search($speaker,$tag){
        $query = Talks::with(['speaker','event','user_ratings']);
        
        $query->leftJoin('user_ratings', 'talks.id', '=', 'user_ratings.talk_id');
        $query->leftJoin('rating', 'rating.id', '=', 'user_ratings.rating_id');

        if($speaker){ 
            $query->where('speaker_id',$speaker);
        }

        if($tag){
            $query->whereJsonContains('tags',(string)$tag);
        }

        $query->select('talks.*', DB::raw('AVG(rating.value) as rating'));
        $query->groupBy('talks.id');

        $result['talks'] = $query->get();
        $result['participants'] = User::where('role_id',2)->get();
        $result['tags'] = Tag::all();
        $result['speakers'] = Speaker::all();

        return $result;
    }

    /**
     * Return all data required for creting/editing talks
     */
    public function getNontalksData(){
        $result['participants'] = User::where('role_id',2)->get();
        $result['events'] = Event::all();
        $result['tags'] = Tag::all();
        $result['speakers'] = Speaker::all();

        return $result;
    }
}
?>