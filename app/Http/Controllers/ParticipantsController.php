<?php

namespace App\Http\Controllers;

use App\Models\Talks;
use App\Models\Speaker;
use App\Models\Event;
use App\Models\Participants;
use App\Models\Tag;
use App\Models\User;
use App\Models\Rating;
use App\Models\User_ratings;
use App\Services\ParticipantsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Utilities\GeneralUtility;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ParticipantsController extends Controller
{
    public $home = "/participants";

    /**
     * ParticipantsController constructor.
     *
     * @param TalksService $talksService
     */
    public function __construct(ParticipantsService $participantsService)
    {
        $this->participantsService = $participantsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('participants.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('participants.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Participants::create($this->validateParticipants());
        return redirect($this->home)->with('success', 'Participant Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $talk = Talks::with(['event'])->findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return view('errors.notfound');
        } catch (BadRequestHttpException $exception) {
            throw $exception;
        } catch (AccessDeniedHttpException $exception) {
            throw $exception;
        } catch (HttpException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            GeneralUtility::logException($exception, __FUNCTION__);
            // Throwing Internal Server Error Response In case of Unknown Errors.
            throw new HttpException(500, ErrorConstant::INTERNAL_ERR);
        }

        $data = $this->participantsService->getAllData($id,$talk->speaker_id);
        $data['talk'] = $talk;

        return view('participants.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $participant = Participants::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return view('errors.notfound');
        }
 
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Participants::whereId($id)->update($this->validateParticipants());

        return redirect($this->home)->with('success', 'Participant Updated Successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $participants = Participants::findOrFail($id);
            $participants->delete();
        } catch (ModelNotFoundException $exception) {
            return view('errors.notfound');
        } catch (BadRequestHttpException $exception) {
            throw $exception;
        } catch (AccessDeniedHttpException $exception) {
            throw $exception;
        } catch (HttpException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            GeneralUtility::logException($exception, __FUNCTION__);
            // Throwing Internal Server Error Response In case of Unknown Errors.
            throw new HttpException(500, ErrorConstant::INTERNAL_ERR);
        }

        return redirect($this->home)->with('success', 'Participant Deleted Successfully !!!');
    }

    /**
     * Load all participants from database
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function load_participant_talks()
    {
        $participant_id = (string)Auth::user()->id;
        $talks = Talks::with(['event'])->whereJsonContains('participants',$participant_id)->get();

        return response()->json($talks, 200);
    }

    /**
     * Add rating to talk
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function store_rating($id)
    {
        $validatedData = request()->validate([
            'rating_id' => 'required'
        ]);

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['talk_id'] = $id;

        User_ratings::create($validatedData);
        return redirect($this->home)->with('success', 'Rating Submitted Successfully !!!');
    }

    /**
     * Validating the Participant.
     *
     * @param  \App\Participants  $participants
     * @return \Illuminate\Http\Response
     */
    public function validateParticipants(){
        return request()->validate([
            'name' => 'required|unique:participants',
            'work_with' => 'required',
            'address' => 'required'
        ]);
    }
}
