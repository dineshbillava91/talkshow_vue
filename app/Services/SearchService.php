<?php
namespace App\Services;

use App\Models\Talks;
use Illuminate\Support\Facades\DB;

class SearchService{
    /**
     * Display top speakers based on talks and rating.
     */
    public function topSpeaker($search_type){
        if($search_type == 1){ 
            $query = Talks::with(['speaker']);
            $query->select('talks.name','speaker_id',DB::raw('COUNT(speaker_id) as total_talks'));
            $query->groupBy('speaker_id');
            $query->orderBy('total_talks', 'DESC');
            $query->take('5');
        } else {
            $query = Talks::with(['speaker','user_ratings']);
            
            $query->join('user_ratings', 'talks.id', '=', 'user_ratings.talk_id');
            $query->join('rating', 'rating.id', '=', 'user_ratings.rating_id');

            $query->select('talks.name','speaker_id', DB::raw('ROUND(AVG(rating.value), 1) as rating'));
            $query->groupBy('speaker_id');
            $query->orderBy('rating','desc');
            $query->take('5');
        }

        return $query->get();
    }

    /**
     * Display all sameday talks.
     */
    public function samedayTalks(){
        $query = Talks::with(['speaker']);
        $query->select('speaker_id',DB::raw('date(created_at) as date'),DB::raw('COUNT(DISTINCT event_id) as total_events'));
        $query->groupBy('speaker_id',DB::raw('date(created_at)'));
        $query->orderBy('total_events', 'DESC');

        return $query->get();
    }

    /**
     * Display total talks per event from datatbase.
     */
    public function eventTalks(){
        $query = Talks::with(['event']);
        $query->select('talks.id','talks.event_id', DB::raw('COUNT(id) as total_talks'));
        $query->groupBy('event_id');
        $query->orderBy('total_talks', 'DESC');

        return $query->get();
    }
}
?>