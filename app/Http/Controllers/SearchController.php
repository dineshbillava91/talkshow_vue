<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Talks;
use App\Models\Event;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * SearchController constructor.
     *
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('speaker.top_speaker');
    }
    
    /**
     * Display a top speakers from datatbase.
     *
     * @return \Illuminate\Http\Response
     */
    public function top_speaker()
    {
        $search_type = request('search_type');

        if($search_type){
            $talks = $this->searchService->topSpeaker($search_type);

            return response()->json($talks, 200);
        } else {
            return response()->json(array(), 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sameday_talks()
    {
        return view('speaker.sameday_talks');
    }

    /**
     * Display a sameday talks from datatbase.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_sameday_talks()
    {
        $talks = $this->searchService->samedayTalks();

        return response()->json($talks, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function event_talks()
    {
        return view('event.search');
    }

    /**
     * Display total talks per event from datatbase.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_event_talks()
    {
        $talks = $this->searchService->eventTalks();;

        return response()->json($talks, 200);
    }
}
